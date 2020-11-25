@extends('frontend.templates.layouts.default')
@section('content')
{{-- @dd(); --}}
@php
// dd($innerPage);
$pHolderIds = explode(',',$genPage->placeholder_ids);
$pHolderVals = explode(',',$genPage->placeholder_values);
$patterns = array();
$replacements = array();
@endphp
@foreach ($pHolderIds as $index => $placeHolder)
    @php
        $patterns[$index] = '/'.$placeholders->find($placeHolder)->format.'/';
    @endphp
@endforeach
@foreach ($pHolderVals as $index => $pHolderValue)
    @php
        $replacements[$index] = $pHolderValue;
    @endphp
@endforeach

    {!!   preg_replace($patterns, $replacements,  $innerPage->main_content ) !!}


@endsection
