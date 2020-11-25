@extends('admin.default')
@section('title', 'Subscriptions')
@section('page-header')
Subscriptions <small>{{ trans('app.manage') }}</small>
@endsection
@section('content')
    {!! Form::model($datas, [
        'action' => ['Backend\SubscriptionController@update','sub_id' => $datas->id],
        'method' => 'post'
    ])
    !!}

    <div class="row mB-40">
        <div class="col-sm-8">
            <div class="bgc-white p-20 bd">
                {!! Form::myInput('text', 'id', 'Subscription ID:' ,array('disabled')) !!}
                {!! Form::label('subscription_type', 'Subscription Type:') !!}
                {!! Form::select('subscription_type', array('0' => 'Free', '1' => 'Pro'), '0', array('class' => 'form-control mb-3')) !!}
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
    <a href="{{route(ADMIN . '.subscriptions')}}" class="btn btn-primary">Back</a>
    {!! Form::close() !!}

@endsection
