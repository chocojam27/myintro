@extends('admin.default')
@section('title', 'Subscriptions')
@section('page-header')
Subscriptions <small>{{ trans('app.manage') }}</small>
@endsection
@section('content')
    {!! Form::model($datas, [
        'action' => ['Backend\SubscriptionController@update','id'=>$datas['PROFILEID']],
        'method' => 'post'
    ])
    !!}

    @include('admin.subscription.form')

    <button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
    <a href="{{route(ADMIN . '.subscriptions')}}" class="btn btn-primary">Back</a>
    {!! Form::close() !!}

@endsection
