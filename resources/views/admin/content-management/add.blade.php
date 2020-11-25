@extends('layouts.app')
@section('title', 'Add Content')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">This is where you can add a new content</h3>
                                <ul class="panel-controls">
                                    <li data-toggle="tooltip" data-placement="left" title="Back">
                                        <a href="{!! URL('admin/content-management') !!}"><span class="fa fa-backward"></span></a>
                                    </li>
                                </ul>
                            </div>
                            <form id="cms-form">
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <label class="col-md-1 control-label">Page</label>
                                        <div class="col-md-11">
                                            <select class="form-control select" name="page_dropdown">
                                                <option value="custom_page">New Page</option>
                                                @foreach($pages as $value)
                                                    <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix" id="page_name_display">
                                        <label class="col-md-1 col-xs-12 control-label">Page Name</label>
                                        <div class="col-md-11 col-xs-12">
                                            <input type="text" class="form-control" name="page_name"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="parent-display">
                                        <div class="children-display">
                                            <div class="form-group clearfix">
                                                <label class="col-md-1 control-label">Section</label>
                                                <div class="col-md-11">
                                                    <select class="form-control select" name="section">
                                                        @foreach($sections as $value)
                                                            <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-md-1 control-label">Field Type</label>
                                                <div class="col-md-11">
                                                    <select class="form-control select" name="field_type">
                                                        <option value="text">Text</option>
                                                        <option value="number">Number</option>
                                                        <option value="textarea">Textarea</option>
                                                        <option value="image">Image</option>
                                                        <option value="file">File</option>
                                                        <option value="video">Video</option>
                                                        <option value="wysiwyg_basic">Wysiwyg Basic</option>
                                                        <option value="wysiwyg_full">Wysiwyg Full</option>
                                                        <option value="repeater">Repeater</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-md-1 col-xs-12 control-label">Field Name</label>
                                                <div class="col-md-11 col-xs-12">
                                                    <input type="text" class="form-control" name="field_name"/>
                                                </div>
                                            </div>
                                            <div id="repeater_header_display"></div>
                                            <div id="repeater_content_display" style="margin-bottom:15px;"></div>
                                            <div id="repeater_footer_display" class="mB-20 col-md-12"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="col-sm-12">
                                            <button class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                {!! csrf_field() !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.4/sweetalert2.min.js"></script>
    <script type="text/javascript">
        // Dropdown page trigger
        $(document).on("change","select[name='page_dropdown']",function(){
            if($(this).val() != 'custom_page'){
                $("#page_name_display").hide()
            }
            else{
                $("#page_name_display").show()
            }
        });
        // Field type dropdown trigger
        $(document).on("change","select[name='field_type']",function(){
            $("#repeater_header_display").empty();
            $("#repeater_content_display").empty();
            $("#repeater_footer_display").empty();
            if($(this).val() == 'repeater'){
                $("#repeater_header_display").append("<hr>");
                $("#repeater_content_display").append(
                                                "<div class='form-group repeater-parent'>"+
                                                    "<div class='col-md-12 col-xs-12 text-right mB-20'>"+
                                                        "<a class='btn btn-info btn-rounded remove-repeater' style='padding:0px 3px;'><i class='ti-close'></i></a>"+
                                                    "</div>"+
                                                    "<div class='clearfix'></div>"+
                                                    "<div class='container'>"+
                                                        "<div class='row'>"+
                                                            "<label class='col-md-4 form-group' style='line-height: 35px;'>Field Type</label>"+
                                                            "<div class='col-md-8 form-group'>"+
                                                                "<select class='form-control select' name='repeater_field_type[]'>"+
                                                                    "<option value='text'>Text</option>"+
                                                                    "<option value='number'>Number</option>"+
                                                                    "<option value='textarea'>Textarea</option>"+
                                                                    "<option value='image'>Image</option>"+
                                                                    "<option value='file'>File</option>"+
                                                                    "<option value='video'>Video</option>"+
                                                                    "<option value='wysiwyg_basic'>Wysiwyg Basic</option>"+
                                                                    "<option value='wysiwyg_full'>Wysiwyg Full</option>"+
                                                                "</select>"+
                                                            "</div>"+
                                                            "<label class='col-md-4 form-group' style='line-height: 35px;'>Field Name</label>"+
                                                            "<div class='col-md-8 col-xs-12 form-group'>"+
                                                                "<input type='text' class='form-control' name='repeater_field_name[]'/>"+
                                                            "</div>"+
                                                        "</div>"+
                                                    "</div>"+
                                                "</div>"
                                            );
                $("#repeater_footer_display").append("<a id='add-repeater-field' class='btn btn-info' style='width: 100%;'>Click here to add another repeater field</a>");
            }
        });
        // Add another repeater field
        $(document).on("click","#add-repeater-field",function(){
            $("#repeater_content_display").append(
                                                "<div class='form-group repeater-parent'>"+
                                                    "<div class='col-md-12 col-xs-12 text-right mB-20'>"+
                                                        "<a class='btn btn-info btn-rounded remove-repeater' style='padding:0px 3px;'><i class='ti-close'></i></a>"+
                                                    "</div>"+
                                                    "<div class='clearfix'></div>"+
                                                    "<div class='container'>"+
                                                        "<div class='row'>"+
                                                            "<label class='col-md-4 form-group' style='line-height: 35px;'>Field Type</label>"+
                                                            "<div class='col-md-8 form-group'>"+
                                                                "<select class='form-control select' name='repeater_field_type[]'>"+
                                                                    "<option value='text'>Text</option>"+
                                                                    "<option value='number'>Number</option>"+
                                                                    "<option value='textarea'>Textarea</option>"+
                                                                    "<option value='image'>Image</option>"+
                                                                    "<option value='file'>File</option>"+
                                                                    "<option value='video'>Video</option>"+
                                                                    "<option value='wysiwyg_basic'>Wysiwyg Basic</option>"+
                                                                    "<option value='wysiwyg_full'>Wysiwyg Full</option>"+
                                                                "</select>"+
                                                            "</div>"+
                                                            "<label class='col-md-4 form-group' style='line-height: 35px;'>Field Name</label>"+
                                                            "<div class='col-md-8 col-xs-12 form-group'>"+
                                                                "<input type='text' class='form-control' name='repeater_field_name[]'/>"+
                                                            "</div>"+
                                                        "</div>"+
                                                    "</div>"+
                                                "</div>"
                                                );
        });
        // Delete the selected repeater field
        $(document).on("click",".remove-repeater",function(){
            $(this).parents(".repeater-parent").remove();
        });
        // Submit all the data
        $("#cms-form").on("submit", function(e){
            $.ajax({
                'url'      : "../content-management",
                'method'   : 'post',
                'dataType' : 'json',
                'data'     : $(this).serialize(),
                success    : function(data){
                    if(data.result == 'success'){
                        Swal({
                            title: 'Good Job!',
                            text: "Content has been added.",
                            type: 'success',
                        }).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }
                        })
                    }
                    else{
                        $.each(data.errors, function (index, value) {
                            console.log('index: '+index+' value: '+value);
                        });
                        swal(
                            "Action failed!",
                            "Please check your inputs or connection and try again.",
                            "error"
                        )
                    }
                }
            });
            return false;
        });
    </script>
@stop
