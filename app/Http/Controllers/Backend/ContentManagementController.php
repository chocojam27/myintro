<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Validators;
use App\Models\Page\Page;
use App\Models\Page\PageSection;
use App\Models\Page\PageContent;
use App\Models\Helper;

use View, Crypt;

class ContentManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pages'] = Page::orderBy('name','asc')->get();
        return view('admin.content-management.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pages']    = Page::orderBy('name','asc')->get();
        $this->data['sections'] = PageSection::orderBy('created_at','desc')->get();
        return view('admin.content-management.add',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Send all the request to validate
        $validator = Validators::backendValidate($request,"cms_custom_add");
        // Check the validator if there's no error
        if ($validator === true) {
            if ($request->page_dropdown == 'custom_page') {
                // Create and get the page id
                $page_id = Page::addData($request);
            } else {
                $page_id = $request->page_dropdown;
            }
            // Create a content
            PageContent::addData($page_id,$request);
            return response()->json(["result" => 'success']);
        } return response()->json(["result" => 'failed','errors'=>$validator->errors()->messages()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['page_data'] = Page::getData(Crypt::decrypt($id));
        if ($this->data['page_data']) {
            return view('admin.content-management.manage',$this->data);
        } return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->id = Crypt::decrypt($id);
        PageContent::updateData($request);
        session()->flash('success', 'Content has been updated.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRepeaterFields(Request $request)
    {
        $this->data['page_data'] = Page::getData(Crypt::decrypt($request->id));
        $this->data['page_data'] = $this->data['page_data']->page_content;
        foreach ($this->data['page_data'] as $key => $value) {
            if($value->id == $request->field_id){
                $this->data['page_data'] = $value;
                break;
            }
        }
        // $this->data['page_data'] = unserialize(base64_decode($request->json));
        // Get the html file
        $content = View::make('admin.content-management.includes.append.edit-page-repeater-content',$this->data)->render();
        return response()->json([
                                    'result'  => 'success',
                                    'content' => $content,
                                    'id'      => $this->data['page_data']->id
                                ]);
    }

    public function getRemoveRepeaterFields(Request $request)
    {
        PageContent::deleteRepeater($request);
        return response()->json(['result'  => 'success']);
    }
}
