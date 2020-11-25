<div class="repeater-children repeater-children-{!!$page_data->id!!} repeater-children-{!!$page_data->id.'-'.date('His', strtotime($page_data->created_at))!!}" data-key="{!!date('His', strtotime($page_data->created_at))!!}" data-check='new'>
	@foreach(unserialize($page_data->repeater_fields) as $key => $value)
		@if($key == 0)
			<div class="col-md-1" style="position:absolute;right:0;">
				<a class='btn btn-info btn-rounded remove-repeater' data-id="{!!$page_data->id!!}" style='padding:0px 3px;'><i class='ti-close'></i></a>
			</div>
		@endif
		<?php $field_name = 'field_repeater_'.str_replace('-','',App\Models\Helper::seoUrl($value['field_name'])).'_'.$page_data->id; ?>
		<div class="form-group clearfix">
			<label class="col-md-1 col-xs-12 control-label">{!! $value['field_name'] !!}</label>
	        <div class="col-md-12 col-xs-12">
	        	@if($value['field_type'] == 'text')
					<input type="text" class="form-control" name="{!!$field_name!!}[]">
	        	@elseif($value['field_type'] == 'number')
                    <input type="number" class="form-control" name="{!!$field_name!!}[]" min="0" step=".01">
	        	@elseif($value['field_type'] == 'textarea')
					<textarea class="form-control" rows="5" name="{!!$field_name!!}[]"></textarea>
	        	@elseif($value['field_type'] == 'image')
					<input type="file" class="file-simple file-simple-default-second" accept="image/jpg,image/png,image/gif" name="{!!$field_name!!}[]">
				@elseif($value['field_type'] == 'file')
				@php
					if(!unserialize(base64_decode($page_data->content))){
						$count = 0;
					}else{
						$count = count(unserialize(base64_decode($page_data->content)));
					}
				@endphp
					<input type="file" class="file-simple-multiple file-simple-default-second" name="{!!$field_name!!}[{!!$count!!}][]" multiple>
				@elseif($value['field_type'] == 'wysiwyg_basic')
					<textarea class="form-control trumbowygWysiwyg-second" data-svg-path="{{ asset('backend/icons.svg') }}" rows="5" name="{!!$field_name!!}[]"></textarea>
				@elseif($value['field_type'] == 'wysiwyg_full')
					<textarea class="form-control trumbowygWysiwyg-second" data-svg-path="{{ asset('backend/icons.svg') }}" rows="5" name="{!!$field_name!!}[]"></textarea>
	        	@endif
	        </div>
		 </div>
	@endforeach
</div>
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
<script type="text/javascript">
	// This is for the new added fields
	$(".file-simple-default-second").fileinput({
	        showUpload  : false,
	        showCaption : false,
	        browseClass : "btn btn-info",
	        showRemove  : false,
	        showClose   : false,
	        initialPreview: [

	        				],
        	initialPreviewConfig: 	[{
							            width: '500px'
							        }],
	        allowedFileTypes     : ["image"],
	        allowedFileExtensions: ["jpg", "png", "gif"],
	        previewconfiguration :  {
	        							previewAsData: false,
							            image: 	{
							            			width: "100%"
							            		}
							        }
	});
	$.trumbowyg.svgPath = $('.trumbowygWysiwyg-second').data('svg-path');
    $('.trumbowygWysiwyg-second').trumbowyg();
</script>
