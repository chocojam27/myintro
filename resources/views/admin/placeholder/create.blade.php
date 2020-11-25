@extends('admin.default')
@section('title', 'Create User')
@section('page-header')
	User <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['Backend\PlaceHoldersController@store'],
			'files' => true
		])
	!!}

		@include('admin.placeholder.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

@stop
