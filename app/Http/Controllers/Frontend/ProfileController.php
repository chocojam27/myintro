<?php

namespace App\Http\Controllers\Frontend;

use Str, Auth, File, View;
use App\Http\Controllers\Frontend\PaypalController;
use App\Models\Profile;
use App\Models\Views;
use App\Models\Placeholder;
use Illuminate\Http\Request;
use App\Models\PlaceholderUser;
use App\Models\OtherPlaceholder;
use App\Http\Controllers\Controller;
use App\Models\Clicks;
use App\Models\GeneratedPage;
use App\Models\PageTemplate;
use App\Models\profile_placeholder;
use App\Models\Subscription;
use App\User;

class ProfileController extends Controller
{
    /**
     *----------------------------------------------------
     *-------------------- Profile Functions
     *----------------------------------------------------
     */
        public function getProfile(){
            $this->data['placeholders'] = Placeholder::all();
            $this->data['ntplaceholders'] = Placeholder::all();
            $this->data['genURL'] = GeneratedPage::where('user_id',Auth::user()->id)->get();
            $this->data['other_placeholders'] = OtherPlaceholder::where('user_id', Auth::user()->id)->first();
            $this->data['profile'] = Profile::with(['views','clicks' => function($q){
                                    $q->where('genPage_id', null);
                                }])->where('user_id',Auth::user()->id)->first();
            $this->data['profile_placeholders'] = profile_placeholder::where('user_id', Auth::user()->id)->first();
            $this->data['page_templates'] = PageTemplate::where('user_id', Auth::user()->id)->get();
            $this->data['user_subs'] = User::where('id',Auth::user()->id)->with(['subscription.invoice' => function($q){
                $q->where('cancelled_date', null);
            }])->first();
            return view('frontend.profile.index', $this->data);
        }

        public function getProfilePage(Request $request, $id ,$innerId = null){
            if($innerId!=null){
                $genPage = GeneratedPage::where('url',$innerId)->first();
                $inner = PageTemplate::find($genPage->page_id);
                $profile = Profile::where('url', $id)->first();
                $placeh= Placeholder::all();
                if($inner){
                    $this->data['innerPage'] = $inner;
                    $this->data['user'] = $profile;
                    $this->data['placeholders'] = $placeh;
                    $this->data['genPage'] = $genPage;
                    return view('frontend.generated.single', $this->data);
                }else{
                    return abort(404);
                }
            }else{
                $profile = Profile::where('url', $id)->first();
                $subscription = Subscription::where('user_id', Auth::user()->id??'')->first();
                if($profile){
                    $this->data['innerPage'] = [];
                    $this->data['user'] = $profile;
                    $this->data['subscription'] = $subscription;
                    return view('frontend.templates.'.$profile->template, $this->data);
                }else{
                    return abort(404);
                }
            }
        }

        public function postProfilePage(Request $request, $id){
            $profile = Profile::findOrFail($id);
            if($request->type == 'social_media_links'){
                $request->merge([
                    'social_url' => array_filter($request->social_url),
                ]);
                $this->validate($request, [
                    'social_provider'    => 'required|array|min:1',
                    'social_url'         => 'required|array|min:1',
                ]);
            }elseif ($request->type == 'profile_picture') {
                if($request->has('image')){
                    if($request->image->getClientOriginalName() != $profile->image){
                        $path = public_path('uploads/avatar/'.$profile->user_id.'/'.$profile->image);
                        if(File::exists($path)) {
                            File::delete($path);
                        }
                    }
                }
            }elseif ($request->type == 'theme') {
                if(empty(array_filter($request->except('type')))){
                    return response()->json(["result" => 'nothing']);
                }else{
                    if($request->theme_color || $request->theme_button){
                        $request->merge([
                            'theme' => array_filter($request->except('type', 'template')),
                        ]);
                    }
                }
            }elseif ($request->type == 'bio') {
                $this->validate($request, [
                    'bio' => 'required|string',
                ]);
            }elseif($request->type == 'videos'){
                $request->merge([
                    'videos' => array_filter($request->except('type')),
                ]);
            }
            try {
                $profile->update($request->all());
                if(empty($profile->getChanges())){
                    return response()->json(["result" => 'nothing']);
                }
            } catch (\Throwable $th) {
                throw $th;
            } return response()->json(["result" => 'success']);
        }

        public function postProfile(Request $request){

            $socialProvider = explode(',', $request->social_provider);
            if(count(array_filter($request->social_url)) != count($socialProvider)){
                array_pop($socialProvider);
            }
            $request->merge([
                'social_provider' => $socialProvider,
                'social_url' => array_filter($request->social_url),
            ]);
            if(!$request->add_video){
                $request->merge([
                    'add_video' => null,
                ]);
            }else{}
            if(!$request->add_contact){
                $request->merge([
                    'add_contact' => null
                ]);
            }else{}
            if(!$request->add_extra_url){
                $request->merge([
                    'add_extra_url' => null
                ]);
            }else{}
            // dd($request->all());
            if($request->has('id')){
                $this->validate($request, Profile::rules(true, $request->id));
                try {
                    $profile = Profile::findOrFail($request->id);
                    if($request->has('image')){
                        if($request->image->getClientOriginalName() != $profile->image){
                            $path = public_path('uploads/avatar/'.$profile->user_id.'/'.$profile->image);
                            if(File::exists($path)) {
                                File::delete($path);
                            }
                        }
                    }
                    $profile->update($request->all());
                } catch (\Throwable $th) {
                    throw $th;
                } return response()->json(["result" => 'success']);
            }else{
                $this->validate($request, Profile::rules());
                try {
                    Profile::create($request->all());
                } catch (\Throwable $th) {
                    throw $th;
                } return response()->json(["result" => 'success']);
            }
        }

        public function getLoadTemplate(Request $request, $id){

            if($request->has('iframe') && $request->iframe == 'true'){
                if(Str::contains($id, 'free-')){
                    if($request->has('url')){
                        $this->data['user'] = Profile::where('url', $request->url)->first();
                        return view('frontend.templates.'.$id, $this->data);
                    } return view('frontend.templates.'.$id);
                }
            } return redirect('/');
        }

        public function getAppendTemplate(Request $request){
            if(Str::contains($request->id, 'free-')){
                $this->data['user'] = Profile::where('url', $request->url)->first();
                $content = View::make('frontend.templates.includes.append.'.$request->id, $this->data)->render();

                return response()->json(["result" => 'success', "html" => $content]);
            }
        }
    /**--profile end--*/

    /**
     *----------------------------------------------------
     *-------------------- Page Template Functions
     *----------------------------------------------------
     */

        public function getProfileInvoice()
        {
            $user = Auth::user();
            if($user->subscription->invoices->count()!=0){
                $this->data['invoice'] = $user->subscription->invoices;
                $dataHtml = view('frontend.includes.invoiceModal', $this->data)->render();
                return response()->json([ "result" => 'success',"html" =>  $dataHtml]);
            }else{
                $result = array([
                    'result' => 'error',
                    'type' => 'error',
                    'title' => 'Oops...',
                    'message' => 'Password not Match!',
                ]);
                return response()->json(["result" => $result]);
            }
        }

        public function getPaypalProfile(Request $request)
        {
            $user = Auth::user();
            if(Auth::user()->subscription->subscription_type){
                $details = new PaypalController();
                $this->data['response'] = $details->getPaymentProfile($request->id);
                // dd($this->data['response'] );
                $dataHtml = view('frontend.includes.paypalModal', $this->data)->render();
                return response()->json([ "result" => 'success',"html" =>  $dataHtml]);
            }else{
                $result = array([
                    'result' => 'error',
                    'type' => 'error',
                    'title' => 'Oops...',
                    'message' => 'Password not Match!',
                ]);
                return response()->json(["result" => $result]);
            }
        }

        public function postSavePlaceholder(Request $request)
        {
            // ifs
                $cpholderFormats = array_filter(explode(',', $request->placeholder_formats));
                $cpholderNames = array_filter(explode(',', $request->placeholder_names));
                if(count($cpholderFormats) != count($cpholderNames)){
                    array_pop($cpholderFormats);
                }
                $pholderIds = explode(',', $request->placeholder_ids);
                if(count(array_filter($request->placeholder_value)) != count($pholderIds)){
                    array_pop($pholderIds);
                }
                $request->merge([
                    'placeholder_ids' => $pholderIds,
                    'placeholder_value' => array_filter($request->placeholder_value),
                    'placeholder_formats' => $cpholderFormats,
                    'placeholder_names' => implode(',',$cpholderNames),
                ]);
                $newOtherPlaceHolderId = null;
            //

            if($request->has('profile_placeholder_id')){
                try {
                    $pph = profile_placeholder::findOrFail($request->profile_placeholder_id);
                    $pph->user_id = Auth::user()->id;
                    $pph->placeholder_IDs = implode(',',$request->placeholder_ids);
                    $pph->placeholder_contents = implode(',',$request->placeholder_value);
                    $pph->save();

                    if($request->placeholder_names!=null && $request->placeholder_formats!=null){
                        if($request->has('other_placeholders_id')){
                            $this->validate($request, OtherPlaceholder::rules());
                            try {
                                $newOtherPlaceHolder = OtherPlaceholder::findOrFail($request->other_placeholders_id);
                                $newOther_array = array(
                                    'user_id'      => Auth::user()->id,
                                    'format'       => implode(',',$request->placeholder_formats),
                                    'description'  => $request->placeholder_names,
                                );
                                $newOtherPlaceHolder->update($newOther_array);
                            } catch (\Throwable $th) {
                                throw $th;
                            } $newOtherPlaceHolderId = $newOtherPlaceHolder->id;
                        }else{
                            $this->validate($request, OtherPlaceholder::rules());
                            try {
                                $newOtherPlaceHolder = OtherPlaceholder::create([
                                    'user_id'      => Auth::user()->id,
                                    'format'       => $request->placeholder_formats,
                                    'description'  => $request->placeholder_names,
                                ]);
                            } catch (\Throwable $th) {
                                throw $th;
                            } $newOtherPlaceHolderId = $newOtherPlaceHolder->id;
                        }
                    }

                    $placeholder_user = PlaceholderUser::where('user_id',Auth::user()->id)->where('placeholder_id',$pph->id);
                    $placeholder_array = array(
                        'user_id'               => $pph->user_id,
                        'placeholder_id'       => $pph->id,
                        'other_placeholder_id'  => $newOtherPlaceHolderId,
                    );
                    $placeholder_user->update($placeholder_array);

                } catch (\Throwable $th) {
                    throw $th;
                } return response()->json(["result" => 'success']);
            }else{
                // $this->validate($request, Profile::rules());
                try {
                    $newPlaceHolder = profile_placeholder::create([
                        'user_id'               => Auth::user()->id,
                        'placeholder_IDs'       => implode(',',$request->placeholder_ids),
                        'placeholder_contents'  => implode(',',$request->placeholder_value),
                    ]);

                    if($request->placeholder_names!=null && $request->placeholder_formats!=null){
                        if($request->has('other_placeholders_id')){
                            // $this->validate($request, Profile::rules(true, $request->id));
                            try {
                                $newOtherPlaceHolder = OtherPlaceholder::findOrFail($request->other_placeholders_id);
                                $newOther_array = array(
                                    'user_id'      => Auth::user()->id,
                                    'format'       => $request->placeholder_formats,
                                    'description'  => $request->placeholder_names,
                                );
                                $newOtherPlaceHolder->update($newOther_array);
                            } catch (\Throwable $th) {
                                throw $th;
                            } $newOtherPlaceHolderId = $newOtherPlaceHolder->id;
                        }else{
                            // $this->validate($request, Profile::rules());
                            try {
                                $newOtherPlaceHolder = OtherPlaceholder::create([
                                    'user_id'      => Auth::user()->id,
                                    'format'       => $request->placeholder_formats,
                                    'description'  => $request->placeholder_names,
                                ]);
                            } catch (\Throwable $th) {
                                throw $th;
                            } $newOtherPlaceHolderId = $newOtherPlaceHolder->id;
                        }
                    }

                    $placeholder_user = new PlaceholderUser();
                    $placeholder_user->user_id = $newPlaceHolder->user_id;
                    $placeholder_user->placeholder_id = $newPlaceHolder->id;
                    $placeholder_user->other_placeholder_id = $newOtherPlaceHolderId;
                    $placeholder_user->save();
                } catch (\Throwable $th) {
                    throw $th;
                } return response()->json(["result" => 'success']);
            }
        }

        public function postPageTemplate(Request $request)
        {
            // dd($request->all());
            // manipulate request
                $theUrl = '';
                $generatedPage = '';
                $pageCount = GeneratedPage::where('page_id', $request->pageTemplateid)->get()->count();
                $subscription = Subscription::where('user_id',Auth::user()->id)->first();
                $subType = $subscription->subscription_type;
                if($subType){
                    $checkMax = true;
                }else{
                    $checkMax = $pageCount <= 30;
                }
                $profile = Profile::find($request->profileID);
                // ifs
                    if($request->newT_placeholder_value){
                        $ntpholderval = array_filter($request->newT_placeholder_value);
                        $ntpholderNames = array_filter(explode(',', $request->newT_placeholder_ids));
                        if(count($ntpholderval) != count($ntpholderNames)){
                            array_pop($ntpholderNames);
                        }
                        $request->merge([
                            'newT_placeholder_value' => implode(',',$ntpholderval),
                            'newT_placeholder_ids' => implode(',',$ntpholderNames),
                        ]);
                    }
                //
                // $this->validate($request, Profile::rules());
            if($request->pageTemplateid){
                try {
                    $page = $this->templatePageFunction($request,true);
                    if($request->urlName){
                        if($checkMax){
                            $this->validate($request, GeneratedPage::rules());
                            $generatedPage = GeneratedPage::create([
                                'name'                  => $request->urlName,
                                'user_id'               => $page->user_id,
                                'page_id'               => $page->id,
                                'url'                   => Str::random(10),
                                'placeholder_ids'       => $request->newT_placeholder_ids,
                                'placeholder_values'    => $request->newT_placeholder_value,
                            ]);
                            $theUrl = $request->getSchemeAndHttpHost().'/'.$profile->url.'/'.$generatedPage->url;
                            $result = array([
                                'result' => 'success',
                                'type' => 'succes',
                                'title' => 'Success',
                                'message' => 'Template Page Updated and URL Succesfully Saved!',
                            ]);
                            return response()->json(["result" => $result , "PageURL" => $theUrl]);
                        } else{
                            $result = array([
                                'result' => 'update',
                                'type' => 'warning',
                                'title' => 'Max',
                                'message' => 'Template Page Updated but the URL maximum limit is reached !',
                            ]);
                            return response()->json(["result" => $result]);
                        }
                    }
                    if($page && (!$request->urlName && !$generatedPage)){
                        $result = array([
                            'result' => 'update',
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Page Successfully Updated!',
                        ]);
                        return response()->json(["result" => $result , "PageURL" => $theUrl]);
                    }
                    if(!$page){
                        $result = array([
                            'result' => 'error',
                            'type' => 'error',
                            'title' => 'Oops...',
                            'message' => 'Something went wrong!',
                        ]);
                        return response()->json(["result" => $result]);
                    }
                }
                catch (\Throwable $th) {
                    throw $th;
                }
            }else if ($request->newGenTemplateid){
                $page= PageTemplate::findOrFail($request->newGenTemplateid);
                $this->validate($request, GeneratedPage::rules());
                $generatedPage = GeneratedPage::create([
                    'name'                  => $request->urlName,
                    'user_id'               => $page->user_id,
                    'page_id'               => $page->id,
                    'url'                   => Str::random(10),
                    'placeholder_ids'       => $request->newT_placeholder_ids,
                    'placeholder_values'    => $request->newT_placeholder_value,
                ]);
                $theUrl = $request->getSchemeAndHttpHost().'/'.$profile->url.'/'.$generatedPage->url;
                $result = array([
                    'result' => 'success',
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'URL Succesfully Saved!',
                ]);
                return response()->json(["result" => $result , "PageURL" => $theUrl]);
                if(!$page && !$generatedPage){
                    $result = array([
                        'result' => 'error',
                        'type' => 'error',
                        'title' => 'Oops...',
                        'message' => 'Something went wrong!',
                    ]);
                    return response()->json(["result" => $result]);
                }
            }else if($request->urlId){
                try{
                    $this->validate($request, GeneratedPage::rules());
                    $generatedPage = GeneratedPage::findOrFail($request->urlId);
                    $generatedPage->name = $request->urlName;
                    $generatedPage->placeholder_ids  = $request->newT_placeholder_ids;
                    $generatedPage->placeholder_values  = $request->newT_placeholder_value;
                    $generatedPage->save();
                    if($generatedPage){
                        $theUrl = $request->getSchemeAndHttpHost().'/'.$profile->url.'/'.$generatedPage->url;
                        $result = array([
                            'result' => 'success',
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'URL Succesfully Updated!',
                        ]);
                        return response()->json(["result" => $result , "PageURL" => $theUrl]);
                    }else{
                        $result = array([
                            'result' => 'error',
                            'type' => 'error',
                            'title' => 'Oops...',
                            'message' => 'Something went wrong!',
                        ]);
                        return response()->json(["result" => $result]);
                    }
                }catch (\Throwable $th){
                    return $th;
                }
            }else{
                try {
                    $page = $this->templatePageFunction($request);
                    if($request->urlName){
                        $this->validate($request, GeneratedPage::rules());
                        $generatedPage = GeneratedPage::create([
                            'name'                  => $request->urlName,
                            'user_id'               => $page->user_id,
                            'page_id'               => $page->id,
                            'url'                   => Str::random(10),
                            'placeholder_ids'       => $request->newT_placeholder_ids,
                            'placeholder_values'    => $request->newT_placeholder_value,
                        ]);
                        $theUrl = $request->server->get('HTTP_ORIGIN').'/'.$profile->url.'/'.$generatedPage->url;
                    }
                    $result = array([
                        'result' => 'success',
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Page and URL Succesfully Saved!',
                    ]);
                    return response()->json(["result" => $result , "PageURL" => $theUrl]);
                }
                catch (\Throwable $th) {
                    throw $th;
                }
                if(!$page){
                    $result = array([
                        'result' => 'error',
                        'type' => 'error',
                        'title' => 'Oops...',
                        'message' => 'Something went wrong!',
                    ]);
                    return response()->json(["result" => $result]);
                }
            }
        }

        public function getGeneratedPage(Request $request)
        {
            $this->data['profile'] = Profile::where('user_id', Auth::user()->id)->first();
            $this->data['generatedURLs'] = GeneratedPage::where('page_id', $request->pageid)->get();
            if($request->pageid){
                $htmls = view('frontend.includes.urlModal', $this->data)->render();
                return response()->json(['result'=> 'success',"html" =>  $htmls]);
            }else{
                if(!$this->data['generatedURLs']){
                    return response()->json(['result'=>'error','title'=>'Oopss...!','message' => 'There is no URL in this Page Template!']);
                }else{
                    return response()->json(['result'=>'error','title'=>'Oopss...!','message' => 'Something Went Wrong, Please Try Again!']);
                }
            }
        }

        public function getPageForm(Request $request)
        {
            // dd($request->all());
            $this->data['ntplaceholders'] = Placeholder::all();
            if($request->step == 1){
                $this->data['pageTemplateDetails'] = PageTemplate::where('user_id', Auth::user()->id)
                                                ->where('id',$request->id)
                                                ->first();
                $htmls = view('frontend.includes.secondPage', $this->data)->render();
                return response()->json(["step" => $request->step , "html" =>  $htmls]);
            }else if($request->step == 2 || ($request->generate)){
                if($request->pageid){
                    $this->data['pageTemplateDetails'] = PageTemplate::where('user_id', Auth::user()->id)
                                    ->where('id',$request->pageid)
                                    ->first();
                    $this->data['placeholders'] = Placeholder::all();
                    $this->data['ntplaceholders'] = Placeholder::all();
                    $this->data['profile_placeholders'] = profile_placeholder::where('user_id', Auth::user()->id)->first();
                    $htmls = view('frontend.includes.thirdPage', $this->data)->render();
                    return response()->json(["step" => $request->step , "html" =>  $htmls]);
                }else if($request->generate){
                    $this->data['pageTemplateDetails'] = PageTemplate::where('user_id', Auth::user()->id)
                                    ->where('id',$request->id)
                                    ->first();
                    $this->data['placeholders'] = Placeholder::all();
                    $this->data['ntplaceholders'] = Placeholder::all();
                    $this->data['user_subs'] = User::where('id',Auth::user()->id)->with(['subscription.invoice' => function($q){
                        $q->where('cancelled_date', null);
                    }])->first();
                    $this->data['other_placeholders'] = OtherPlaceholder::where('user_id', Auth::user()->id)->first();
                    $this->data['profile_placeholders'] = profile_placeholder::where('user_id', Auth::user()->id)->first();
                    $htmls = view('frontend.includes.thirdPage', $this->data)->render();
                    return response()->json(["generate" => true ,"step" => 2 , "html" =>  $htmls]);
                }else if($request->urlid){
                    $this->data['genPage'] = GeneratedPage::find($request->urlid);
                    $this->data['placeholders'] = Placeholder::all();
                    $this->data['ntplaceholders'] = Placeholder::all();
                    $this->data['user_subs'] = User::where('id',Auth::user()->id)->with(['subscription.invoice' => function($q){
                        $q->where('cancelled_date', null);
                    }])->first();
                    $this->data['other_placeholders'] = OtherPlaceholder::where('user_id', Auth::user()->id)->first();
                    $htmls = view('frontend.includes.thirdPage', $this->data)->render();
                    return response()->json(["step" => 2 , "html" =>  $htmls]);
                }else{
                    $this->data['placeholders'] = Placeholder::all();
                    $this->data['ntplaceholders'] = Placeholder::all();
                    $this->data['profile_placeholders'] = profile_placeholder::where('user_id', Auth::user()->id)->first();
                    $this->data['user_subs'] = User::where('id',Auth::user()->id)->with(['subscription.invoice' => function($q){
                        $q->where('cancelled_date', null);
                    }])->first();
                    $this->data['other_placeholders'] = OtherPlaceholder::where('user_id', Auth::user()->id)->first();
                    $htmls = view('frontend.includes.thirdPage', $this->data)->render();
                    return response()->json(["step" => $request->step , "html" =>  $htmls]);
                }

            }else{
            }
        }

        public function postView(Request $request)
        {
            // dd($request->all());
            if($request->page_id){
                $view = Views::create([
                    'genPage_id'       => $request->page_id,
                    'profile_id'    => $request->profile_id,
                    'ips'           => $request->getClientIp(),
                ]);
            }else{
                $view = Views::create([
                    'profile_id'    => $request->profile_id,
                    'ips'           => $request->getClientIp(),
                ]);
            }
            if($view){
                return response()->json(["result" => 'success']);
            }
        }

        public function postClick(Request $request)
        {
            $url = 0;
            $contact = 0;
            $social = 0;
            if($request->type == 1){
                $social = 1;
            }else if($request->type == 2){
                $contact = 1;
            }else{
                $url = 1;
            }
            if($request->page_id){
                $click = Clicks::create([
                    'url'           => $url,
                    'contact'       => $contact,
                    'social'        => $social,
                    'page_id'       => $request->page_id,
                    'profile_id'    => $request->profile_id,
                    'ips'           => $request->getClientIp(),
                ]);
                $click = Clicks::create([
                    'url'           => $url,
                    'contact'       => $contact,
                    'social'        => $social,
                    'profile_id'    => $request->profile_id,
                    'ips'           => $request->getClientIp(),
                ]);
            }
            if($click){
                return response()->json(["result" => 'success']);
            }
        }

        public function updateCredential(Request $request)
        {
            $user = User::find(Auth::user()->id);
            $validator = $this->validate($request,[
                            'email'    => 'string|email|max:255',
                            'newPassword' => 'required|string|min:8',
                        ]);
            if($validator){
                if($request->newPassword == $request->conPassword){
                    if($user->email != $request->email){
                        $user->email = $request->email;
                    }
                    $user->password =$request->newPassword;
                    $user->save();
                    if($user){
                        $result = array([
                            'result' => 'success',
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Credentials Successfuly Updated',
                        ]);
                        return response()->json(["result" => $result]);
                    }
                }else{
                    $result = array([
                        'result' => 'error',
                        'type' => 'error',
                        'title' => 'Oops...',
                        'message' => 'Password not Match!',
                    ]);
                    return response()->json(["result" => $result]);
                }
            }
        }

        public function deletePage(Request $request)
        {
            $thePage = PageTemplate::findOrFail($request->id);
            $theUrl = GeneratedPage::where('page_id',$request->id)->get();
            foreach($theUrl as $generated){
                $genPageview = Views::where('genPage_id',$generated->id);
                $genPageclick = Clicks::where('genPage_id',$generated->id);
                $genPageview->delete();
                $genPageclick->delete();
                $generated->delete();
            }
            // Views::where('genPage_id',$request->id)->get()->delete();
            // Clicks::where('genPage_id',$request->id)->get()->delete();
            $thePage->delete();

            if($thePage){
                return response()->json(["result" => 'success']);
            }
        }


        // functions
            public function templatePageFunction($data,$update=false,$delete=false)
            {
                $this->validate($data, PageTemplate::rules());
                if($update){
                    $page = PageTemplate::findOrFail($data->pageTemplateid);
                    $page->page_template_name = $data->templateName;
                    $page->tag = $data->templateTag;
                    $page->full_name = $data->fullName;
                    $page->main_content = $data->mainContent;
                    $page->save();
                    return ($page);
                }else{
                    return $page = PageTemplate::create([
                        'user_id'               => Auth::user()->id,
                        'page_template_name'    => $data->templateName,
                        'tag'                   => $data->templateTag,
                        'full_name'             => $data->fullName,
                        'main_content'          => $data->mainContent,
                    ]);
                }
            }
        //end functions
    /**--Page Template end--*/

    /**
     *----------------------------------------------------
     *-------------------- Generated Page Functions
     *----------------------------------------------------
     */
        public function deleteGenerated(Request $request)
        {
            $theUrl = GeneratedPage::where('id',$request->id)->first();
            $genPageview = Views::where('genPage_id',$theUrl->id);
            $genPageclick = Clicks::where('genPage_id',$theUrl->id);
            $genPageview->delete();
            $genPageclick->delete();
            $theUrl->delete();
            if($theUrl){
                return response()->json(["result" => 'success']);
            }
        }


    /**-- Generated Page Functions end--*/
 }
