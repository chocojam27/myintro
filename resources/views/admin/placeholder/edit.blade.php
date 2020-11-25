@extends('admin.default')
@section('title', 'Edit User')
@section('page-header')
	User <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['Backend\PlaceHoldersController@update', $item->id],
			'method' => 'put',
			'files' => true
		])
	!!}

		@include('admin.placeholder.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

	{!! Form::close() !!}

@stop
