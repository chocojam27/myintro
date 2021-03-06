@extends('admin.default')
@section('title', 'Subscriptions')
@section('page-header')
Subscriptions <small>{{ trans('app.manage') }}</small>
@endsection
@section('content')
    @if ($response??'')
        <table class="table table-striped " width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td>Profile ID:</td>
                    <td>{{$response['PROFILEID']}}</td>
                </tr>
                <tr>
                    <td>Profile Status:</td>
                    <td>{{$response['STATUS']}}</td>
                </tr>
                <tr>
                    <td>Subscriber Name:</td>
                    <td>{{$response['SUBSCRIBERNAME']}}</td>
                </tr>
                <tr>
                    <td>Start Date:</td>
                    <td>{{$response['PROFILESTARTDATE']}}</td>
                </tr>
                <tr>
                    <td>Last Payment Date:</td>
                    <td>{{$response['LASTPAYMENTDATE']}}</td>
                </tr>
                @if ($response['STATUS'] != 'Cancelled')
                    <tr>
                        <td>Next Billing Date:</td>
                        <td>{{$response['NEXTBILLINGDATE']}}</td>
                    </tr>
                @endif

                <tr>
                    <td>Regular Amount:</td>
                    <td>{{$response['REGULARAMT']}}</td>
                </tr>
                <tr>
                    <td>Completed Cycle:</td>
                    <td>{{$response['NUMCYCLESCOMPLETED']}}</td>
                </tr>
            </tbody>
        </table>
    @else
        <table class="table table-striped " width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td>Name:</td>
                    <td>{{$datas->user->name.' '.$datas->user->surname }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{$datas->user->email}}</td>
                </tr>
                <tr>
                    <td>Subscription:</td>
                    <td>{{$datas->subscription_type?'PRO':'Free'}}</td>
                </tr>
                <tr>
                    <td>Start Date:</td>
                    <td>{{$datas->created_at}}</td>
                </tr>
            </tbody>
        </table>
    @endif
    <a href="{{route(ADMIN . '.subscriptions')}}" class="btn btn-primary">Back</a>
@endsection
