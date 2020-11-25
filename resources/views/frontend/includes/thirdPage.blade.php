
<input type="text" name="newGenTemplateid" hidden value="{{$pageTemplateDetails->id??''}}">
<input type="text" name="urlId" hidden value="{{$genPage->id??''}}">
<div class="GenerateForm">
    <div class="text-center hideOnscs">
        <h2>Generate URL</h2>
        <p>Create the name for your URL</p>
    </div>
    <input type="text" class="form-control hideOnscs" name='urlName' placeholder="Name of Url" value="{{$genPage??''?$genPage->name:''}}">
</div>
<div class="text-center hideOnscs">
    <h2>Placeholder</h2>
    <p>Fill placeholders that will be used in this template</p>
</div>
<div class="placeholder p-1">
    <div class="switcher row">
        <h5 class="col-md-8">Activate custom Placeholder</h5>
        <div class="col-md-4 text-right">
            <label class="switch" id="onOffPh">
                <input type="checkbox" {{$user_subs->subscription->subscription_type?:'disabled'}} name="custom_placeholder" value="true">
                <span class="slider round" data-toggle="tooltip" data-placement="bottom"
                title="{{$user_subs->subscription->subscription_type?'This is a this will activate custom place holder, it will look like thing below':'This is a Pro Feature'}}"></span>
            </label>
        </div>
    </div>
</div>
<div class="GenerateForm">
    <div class="hideOnscs">
        <div class="pholderForm" id="f1">
            <input type="hidden" name="newT_placeholder_ids">
            @if($profile_placeholders??'')
                <input type="hidden" name="newT_profile_placeholder_id" value="">
                @php
                    $ntphId = explode(',',$profile_placeholders->placeholder_IDs);
                    $ntphVals = explode(',',$profile_placeholders->placeholder_contents);
                @endphp
                @foreach ($ntphVals as $key => $ntplaceHolderVal)
                <div class="form-inline justify-content-center">
                    <select disabled name="newT_placeholder_id" class="form-control">
                        @foreach ($ntplaceholders as $k => $ntplaceholder)
                            @if ($ntphId[$key] == $ntplaceholder->id)
                                <option value="{{$ntplaceholder->id}}">{{$ntplaceholder->format}}</option>
                            @php
                                unset($ntplaceholders[$k]);
                            @endphp
                            @else
                                {{-- <option value="{{$ntplaceholder->id}}">{{$ntplaceholder->format}}</option> --}}
                            @endif
                        @endforeach
                    </select>
                    <input class="form-control" type="text" name="newT_placeholder_value[]" placeholder="Type Here" value="{{$ntplaceHolderVal}}">
                    <a class="form-control btn-ntplaceholder"><i class="fa fa-minus"></i></a>
                </div>
                @endforeach
            @else
                <input type="hidden" name="newT_profile_placeholder_id" value="">
                @php
                    $ntphId = explode(',',$genPage->placeholder_ids);
                    $ntphVals = explode(',',$genPage->placeholder_values);
                @endphp
                @foreach ($ntphVals as $key => $ntplaceHolderVal)
                <div class="form-inline justify-content-center">
                    <select disabled name="newT_placeholder_id" class="form-control">
                        @foreach ($ntplaceholders as $k => $ntplaceholder)
                            @if ($ntphId[$key] == $ntplaceholder->id)
                                <option value="{{$ntplaceholder->id}}">{{$ntplaceholder->format}}</option>
                            @php
                                unset($ntplaceholders[$k]);
                            @endphp
                            @else
                                {{-- <option value="{{$ntplaceholder->id}}">{{$ntplaceholder->format}}</option> --}}
                            @endif
                        @endforeach
                    </select>
                    <input class="form-control" type="text" name="newT_placeholder_value[]" placeholder="Type Here" value="{{$ntplaceHolderVal}}">
                    <a class="form-control btn-ntplaceholder"><i class="fa fa-minus"></i></a>
                </div>
                @endforeach
            @endif
            <div class="form-inline justify-content-center">
                <select class="form-control" name="newT_placeholder_id">
                    @foreach ($ntplaceholders as $placeholder)
                        <option value="{{$placeholder->id}}">{{$placeholder->format}}</option>
                    @endforeach
                </select>
                <input class="form-control" type="text" name="newT_placeholder_value[]" placeholder="Type Here">
                <a class="form-control btn-ntplaceholder"><i class="fa fa-plus"></i></a>
            </div>
            <div class="appendGenerateHere">
            </div>
        </div>
        <div class="pholderForm" id="f2" style="display:none">
            <h5 >Custom Placeholder</h5>
            <div class="appendOtherPh">
                <input type="hidden" name="ntPlaceholder_names">
                <input type="hidden" name="ntPlaceholder_formats">
                <span class="invalid-feedback" role="alert">
                    <strong>The image field is required.</strong>
                </span>
                @if ($other_placeholders)
                    <input type="hidden" name="other_placeholders_id" value="{{$other_placeholders->id}}">
                    @php
                        $oPhFormat = explode(',',$other_placeholders->format);
                        $oPhdesc = explode(',',$other_placeholders->description);
                    @endphp
                    @foreach ($oPhdesc as $key => $desc)
                    <div class="form-inline justify-content-center">
                        <input disabled class="form-control" type="text" name="ntPlaceholder_name" value="{{$desc}}">
                        <input disabled class="form-control" type="text" name="ntPlaceholder_format" value="{{$oPhFormat[$key]}}">
                        <a class="form-control btn-ntplaceholder"><i class="fa fa-minus"></i></a>
                    </div>
                    @endforeach
                @endif
                <div class="form-inline justify-content-center">
                    <input class="form-control" type="text" name="ntPlaceholder_name" placeholder="Name of the Placeholder">
                    <input class="form-control" type="text" name="ntPlaceholder_format" placeholder="%Example%">
                    <a class="form-control btn-ntplaceholder"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <input type="submit" href='#' class="saveGenerate" value="Save and Generate URL">
    </div>
    <div id="showOnGenerate" style="display:none">
        <h2 class="text-center">Generated URL</h2>
        <input type="text" class="form-control urlHere" disabled>
        <div class="form-inline">
            <a class="btnPink pageURLcopy" href="">Copy</a>
            <a target="_blank" class="btnPink pageURLview" href="">Preview</a>
            <a class="btnPink oneAsback" href="">Go Back</a>
        </div>
    </div>
</div>

