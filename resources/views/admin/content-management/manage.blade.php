@extends('admin.default')
@section('title','Edit '.$page_data->self_data->name.($page_data->self_data->name != 'Subscription' ? ' Page' : ''))
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.12.2/ui/trumbowyg.min.css" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row gap-20 masonry pos-r" style="overflow: initial!important;height: 1000px!important">
    <div class="masonry-sizer col-md-4"></div>
    <div class="masonry-item col-md-8 offset-md-2">
        <div class="bgc-white p-20 bd" style="float:left;width:100%;">
            {!! Form::model($page_data, [
                'action' => ['Backend\ContentManagementController@update', Crypt::encrypt($page_data->self_data->id)],
                'method' => 'put',
                'files' => true,
                'class' => 'form-horizontal'
                ])
            !!}
                <h4 class="c-grey-900">{{$page_data->self_data->name}} {{$page_data->self_data->name != 'Subscription' ? 'Page' : ''}} Content</h4>
            <div class="mT-10">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach($page_data->page_section as $key => $value)
                        <li class="nav-item"><a class="nav-link {!! $key == 0 ? 'active' : '' !!}" data-toggle="tab" href="#tab-{!! $value->name !!}" role="tab" aria-controls="{!! $value->name !!}" aria-selected="true">{!! $value->name !!}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content mT-20" id="myTabContent">
                    <?php $section_array    = []; ?>
                    <?php $section_distinct = 0; ?>
                    <?php $section_count    = count($page_data->page_content)-1; ?>
                    <?php $section_name     = ''; ?>
                    @foreach($page_data->page_content as $key => $value)
                    @if(!in_array($value->name, $section_array))
                            <?php $section_array[] = $value->name; ?>
                            @if($section_name != $value->name && $section_name != '' || $section_count == $key)
                                </div>
                            @else
                                <?php $section_count++; ?>
                            @endif
                            <div class="tab-pane fade {!! $key == 0 ? 'show active' : '' !!}" id="tab-{!! $value->name !!}">
                        @else
                            <?php $section_name = $value->name; ?>
                        @endif
                        @if($value->field_type == 'text')
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label" for="name">{!! $value->field_name !!}</label>
                                <div class="col-md-12 col-xs-12">
                                    <input type="text" name="field_{!!$value->id!!}" class="form-control" value="{!! $value->content !!}">
                                </div>
                                <div class="col-md-12 col-xs-12 invalid-feedback" id="field_{!!$value->id!!}"></div>
                            </div>
                        @elseif($value->field_type == 'number')
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label" for="name">{!! $value->field_name !!}</label>
                                <div class="col-md-12 col-xs-12">
                                    <input type="number" name="field_{!!$value->id!!}" class="form-control" min="0" step=".01" value="{!! $value->content !!}">
                                </div>
                                <div class="col-md-12 col-xs-12 invalid-feedback" id="field_{!!$value->id!!}"></div>
                            </div>
                        @elseif($value->field_type == 'textarea')
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label" for="name">{!! $value->field_name !!}</label>
                                <div class="col-md-12 col-xs-12">
                                    <textarea class="form-control" rows="5" name="field_{!!$value->id!!}">{!! $value->content !!}</textarea>
                                </div>
                                <div class="col-md-12 col-xs-12 invalid-feedback" id="field_{!!$value->id!!}"></div>
                            </div>
                        @elseif($value->field_type == 'image')
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label" for="image">{!! $value->field_name !!}</label>
                                <div class="col-md-12 col-xs-12 image-preview" id="image-preview-{{$key}}" style="border-radius: 2px;width: 100%;height: 250px; background: url({{asset($value->content)}});background-size: contain;background-position: center center;background-repeat: no-repeat;">
                                    <label for="image-upload-{{$key}}" id="image-label-{{$key}}">Choose Image</label>
                                    <input type="file" name="field_{!!$value->id!!}" id="image-upload-{{$key}}" />
                                </div>
                            </div>
                        @elseif($value->field_type == 'file')
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">{!! $value->field_name !!}</label>
                                <div class="col-md-12 col-xs-12">
                                    <input type="file" class="file-simple file_{!!$value->id!!}" data-file='file_{!!$value->id!!}' name="field_{!!$value->id!!}" data-value="{!! $value->content !!}">
                                </div>
                            </div>
                        @elseif($value->field_type == 'video')
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">{!! $value->field_name !!}</label>
                                <div class="col-md-12 col-xs-12">
                                    <input type="file" class="file-simple-video file_{!!$value->id!!}" data-file='file_{!!$value->id!!}' name="field_{!!$value->id!!}" data-value="{!! $value->content !!}">
                                </div>
                            </div>
                        @elseif($value->field_type == 'wysiwyg_basic' || $value->field_type == 'wysiwyg_full')
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">{!! $value->field_name !!}</label>
                                <div class="col-md-12 col-xs-12">
                                <textarea class="form-control trumbowygWysiwyg" data-svg-path="{{ asset('backend/icons.svg') }}" rows="5" name="field_{!!$value->id!!}">{!! $value->content !!}</textarea>
                                </div>
                            </div>
                        @elseif($value->field_type == 'repeater')
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">{!! $value->field_name !!}</h3>
                                            <ul class="panel-controls">
                                                <li data-toggle="tooltip" data-placement="left" title="Add" style="cursor:pointer">
                                                    <a class="add-repeater-field"><span class="fa fa-plus"></span></a>
                                                </li>
                                            </ul>
                                            <input type="hidden" name="field_id" value="{{$value->id}}">
                                        </div>
                                        <div class="panel-body">
                                            <div class="repeater_display_{!!$value->id!!}">
                                                @if($value->content != '')
                                                    @foreach(unserialize(base64_decode($value->content)) as $k => $v)
                                                        <div class="repeater-children repeater-children-{!!$value->id!!} repeater-children-{!!$value->id.'-'.$k!!}" data-key="{!!$k!!}" data-check='old'>
                                                            @foreach($v as $vk => $mv)
                                                                @if($vk == 0)
                                                                    <div class="col-md-1" style="position:absolute;right:0;">
                                                                        <a class='btn btn-info btn-rounded remove-repeater' data-id="{!!$value->id!!}" style='padding:0px 3px;'><i class='glyphicon glyphicon-remove'></i></a>
                                                                    </div>
                                                                @endif
                                                                <?php $field_name = 'field_repeater_'.str_replace('-','',App\Models\Helper::seoUrl($mv['field_name'])).'_'.$value->id; ?>
                                                                <div class="form-group clearfix">
                                                                    <label class="col-md-1 col-xs-12 control-label">{!! $mv['field_name'] !!}</label>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        @if($mv['field_type'] == 'text')
                                                                            <input type="text" class="form-control" name="{!!$field_name!!}[]" value="{!! htmlentities($mv['field_value']) !!}">
                                                                        @elseif($mv['field_type'] == 'number')
                                                                            <input type="number" class="form-control" name="{!!$field_name!!}[]" min="0" step=".01" value="{!! $mv['field_value'] !!}">
                                                                        @elseif($mv['field_type'] == 'textarea')
                                                                            <textarea class="form-control" rows="5" name="{!!$field_name!!}[]">{!! $mv['field_value'] !!}</textarea>
                                                                        @elseif($mv['field_type'] == 'image')
                                                                            @if($mv['field_name'] != '')
                                                                                <input type="file" class="file-simple file_{!!$field_name.$k!!}" data-file='file_{!!$field_name.$k!!}' accept="image/jpg,image/png,image/gif" name="{!!$field_name!!}[]" data-value="{!! $mv['field_value'] !!}">
                                                                            @else
                                                                                <input type="file" class="file-simple file_{!!$field_name.$k!!}" data-file='file_{!!$field_name.$k!!}' accept="image/jpg,image/png,image/gif" name="{!!$field_name!!}[]" data-value="uploads/others/no_image.jpg">
                                                                            @endif
                                                                        @elseif($mv['field_type'] == 'file')
                                                                            @if($mv['field_name'] != '')
                                                                                @php
                                                                                    $file_count = count($mv['field_value']);
                                                                                    $data_value = '';
                                                                                @endphp
                                                                                @if (is_array($mv['field_value']))
                                                                                    @foreach ($mv['field_value'] as $key => $item)
                                                                                        @php
                                                                                            $data_value .= "data-value".$key."='".$item."' ";
                                                                                        @endphp
                                                                                    @endforeach
                                                                                @else
                                                                                    @php
                                                                                        $data_value = "data-value0='".$mv["field_value"]."'";
                                                                                    @endphp
                                                                                @endif
                                                                                <input type="file" class="file-simple-multiple file_{!!$field_name.$k!!}" data-file='file_{!!$field_name.$k!!}' name="{!!$field_name!!}[{!!$k!!}][]" {!!$data_value!!} multiple>
                                                                            @else
                                                                                <input type="file" class="file-simple-multiple file_{!!$field_name.$k!!}" data-file='file_{!!$field_name.$k!!}' name="{!!$field_name!!}[{!!$k!!}][]" data-value="uploads/others/no_image.jpg" multiple>
                                                                            @endif
                                                                        @elseif($mv['field_type'] == 'video')
                                                                            @if($mv['field_name'] != '')
                                                                                <input type="file" class="file-simple-video file_{!!$field_name.$k!!}" data-file='file_{!!$field_name.$k!!}' name="{!!$field_name!!}[]" data-value="{!! $mv['field_value'] !!}">
                                                                            @else
                                                                                <input type="file" class="file-simple-video file_{!!$field_name.$k!!}" data-file='file_{!!$field_name.$k!!}' name="{!!$field_name!!}[]" data-value="uploads/others/no_image.jpg">
                                                                            @endif
                                                                        @elseif($mv['field_type'] == 'wysiwyg_basic')
                                                                            <textarea data-svg-path="{{ asset('backend/icons.svg') }}" class="form-control trumbowygWysiwyg" rows="5" name="{!!$field_name!!}[]">{!! $mv['field_value'] !!}</textarea>
                                                                        @elseif($mv['field_type'] == 'wysiwyg_full')
                                                                            <textarea data-svg-path="{{ asset('backend/icons.svg') }}" class="form-control trumbowygWysiwyg" rows="5" name="{!!$field_name!!}[]">{!! $mv['field_value'] !!}</textarea>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <input type="hidden" name="repeater_total_{!!$value->id!!}" value="@if($value->content != '') {!! count(unserialize(base64_decode($value->content))) !!} @else 0 @endif">
                                                <h5 class="note_{!!$value->id!!} {!! $value->content != '' ? (empty(unserialize(base64_decode($value->content))) ? '' : 'hide') : '' !!}"><i>Nothing to display, click the button on the upper right to add a content.</i></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary submit-challenge">Save Changes</button>
                {!!csrf_field()!!}
            </div>
        {!! Form::close() !!}
    </div>
    </div>
</div>
@stop
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js" integrity="sha256-tW5LzEC7QjhG0CiAvxlseMTs2qJS7u3DRPauDjFJ3zo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{asset('backend/js/piexif.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.12.2/trumbowyg.min.js"></script>
<script>
    // File input display
    if($(".file-simple").length > 0){
        // This is for the new added fields
        $(".file-simple-default").fileinput({
                showUpload  : false,
                showCaption : false,
                browseClass : "btn btn-info",
                showRemove  : false,
                showClose   : false,
                initialPreview: [

                                ],
                initialPreviewConfig: 	[{
                                            width: 'auto',
                                            height: 'auto'
                                        }],
                previewconfiguration :  {
                                            previewAsData: false,
                                            image: 	{
                                                        width: "auto",
                                                        height: 'auto'
                                                    }
                                        }
        });
        // This is for the existing fields
        $('.file-simple').each(function(){
            var file = "<img src='{!!asset('/')!!}"+$(this).data('value')+"' class='file-preview-image' style='width:100%'>"
            $("."+$(this).data('file')).fileinput({
                    showUpload  : false,
                    showCaption : false,
                    browseClass : "btn btn-info",
                    showRemove  : false,
                    showClose   : false,
                    initialPreview: [ file ],
                    initialPreviewConfig: 	[{
                                                width: 'auto',
                                                height: 'auto'
                                            }],
                    allowedFileTypes     : ["image"],
                    allowedFileExtensions: ["jpg", "png", "gif"],
                    previewconfiguration :  {
                                                previewAsData: false,
                                                image: 	{
                                                            width: "auto",
                                                            height: 'auto'
                                                        }
                                            }
            });
        });
    }
    if($(".file-simple-multiple").length > 0){
        // This is for the new added fields
        $(".file-simple-default").fileinput({
                showUpload  : false,
                showCaption : false,
                browseClass : "btn btn-info",
                showRemove  : false,
                showClose   : false,
                initialPreview: [

                                ],
                initialPreviewConfig: 	[{
                                            width: 'auto',
                                            height: 'auto'
                                        }],
                previewconfiguration :  {
                                            previewAsData: false,
                                            image: 	{
                                                        width: "auto",
                                                        height: 'auto'
                                                    }
                                        }
        });
        // This is for the existing fields
        $('.file-simple-multiple').each(function(){
            var arrayHere = [];
            @isset($file_count)
                @for ($i = 0; $i < $file_count; $i++)
            var file{!!$i!!} = "<img src='{!!asset('/')!!}"+$(this).data('value{!!$i!!}')+"' class='file-preview-image' style='width:100%'>";
                arrayHere.push(file{!!$i!!});
                @endfor
            @endisset
            $("."+$(this).data('file')).fileinput({
                    showUpload  : false,
                    showCaption : false,
                    browseClass : "btn btn-info",
                    showRemove  : false,
                    showClose   : false,
                    initialPreview: arrayHere,
                    initialPreviewConfig: 	[{
                                                width: 'auto',
                                                height: 'auto'
                                            }],
                    allowedFileTypes     : ["image"],
                    allowedFileExtensions: ["jpg", "png", "gif"],
                    previewconfiguration :  {
                                                previewAsData: false,
                                                image: 	{
                                                            width: "auto",
                                                            height: 'auto'
                                                        }
                                            }
            });
        });
        $(".file-simple-multiple").change(function(){
            $(this).find('input.pang_test').val(0);
        });
    }
    if($(".file-simple-video").length > 0){
        // This is for the new added fields
        $(".file-simple-default").fileinput({
                showUpload  : false,
                showCaption : false,
                browseClass : "btn btn-info",
                showRemove  : false,
                showClose   : false,
                initialPreview: [
                                ],
                initialPreviewConfig: 	[{
                                            width: 'auto',
                                            height: 'auto'
                                        }],
                previewconfiguration :  {
                                            previewAsData: false,
                                            image: 	{
                                                        width: "auto",
                                                        height: 'auto'
                                                    }
                                        }
        });
        // This is for the existing fields
        $('.file-simple-video').each(function(){
            var file = "<video class='kv-preview-data file-preview-video' controls='' style='width:100%;'><source src='{!!asset('/')!!}"+$(this).data('value')+"' type='video/"+$(this).data('value').split('.').pop()+"'></video>"
            $("."+$(this).data('file')).fileinput({
                    showUpload  : false,
                    showCaption : false,
                    browseClass : "btn btn-info",
                    showRemove  : false,
                    showClose   : false,
                    initialPreview: [ file ],
                    initialPreviewConfig: 	[{
                                                width: 'auto',
                                                height: 'auto'
                                            }],
                    allowedFileTypes     : ["video"],
                    allowedFileExtensions: ["mp4", "webm", "ogg"],
                    previewconfiguration :  {
                                                previewAsData: false,
                                                image: 	{
                                                            width: "auto",
                                                            height: 'auto'
                                                        }
                                            }
            });
        });
    }
    // Remove close button
    $(".fileinput-remove").remove();
    // Add another repeater field
    $(document).on("click",".add-repeater-field",function(){
        var thisButton = $(this);
        $.ajax({
            'url'      : "{!! URL('admin/content-management/repeater-fields?id='.Crypt::encrypt($page_data->self_data['id'])) !!}&field_id="+thisButton.parent().parent().next().val(),
            'method'   : 'get',
            success    : function(response){
                if(response.result == 'success'){
                    // Add the content
                    $(".repeater_display_"+response.id).append(response.content);
                    $(".note_"+response.id).addClass('hide');
                    var total = $("input[name='repeater_total_"+response.id+"'").val();
                    $("input[name='repeater_total_"+response.id+"'").val(parseInt(total)+1);
                    $("html, body").animate({ scrollTop: $('.repeater-children-'+response.id+':last').offset().top},500);
                    thisButton.hide();
                }
                else{
                    swal("Action failed", "Please check your inputs or connection and try again.", "error");
                }
            },
            beforeSend : function(){
                $('#loader').removeClass('fadeOut');
                $('#loader').addClass('fadeIn');
            },
            complete   : function(){
                $('#loader').removeClass('fadeIn');
                $('#loader').addClass('fadeOut');
            }
        });
        return false;
    });
    // Remove repeater field
    $(document).on("click",".remove-repeater",function(){
        key   = $(this).parents('.repeater-children').data('key');
        check = $(this).parents('.repeater-children').data('check');
        // Remove the main children
        $($(this).parents('.repeater-children-'+$(this).data('id')+'-'+key)).remove();
        // Count all the children and remove if match
        if($('.repeater-children-'+$(this).data('id')).length == 0){
            $(".note_"+$(this).data('id')).removeClass('hide');
        }
        var total = $("input[name='repeater_total_"+$(this).data('id')+"'").val();
        $("input[name='repeater_total_"+$(this).data('id')+"'").val(parseInt(total)-1);
        if (check == 'old') {
            // Remove from the database
            $.ajax({
                'url'      : "{!! URL('admin/content-management/remove-repeater-fields') !!}",
                'method'   : 'get',
                'dataType' : 'json',
                'data'     : { key : key, id : $(this).data('id') },
                success    : function(response){
                    if(response.result == 'success'){
                        location.reload();
                    }
                    else{
                        swal("Action failed", "Please check your inputs or connection and try again.", "error");
                    }
                },
                beforeSend : function(){
                    $('#loader').removeClass('fadeOut');
                    $('#loader').addClass('fadeIn');
                },
                complete   : function(){
                    $('#loader').removeClass('fadeIn');
                    $('#loader').addClass('fadeOut');
                }
            });
            return false;
        }
    });
    $('footer').remove();
    $.trumbowyg.svgPath = $('.trumbowygWysiwyg').data('svg-path');
    $('.trumbowygWysiwyg').trumbowyg();
</script>
@stop
