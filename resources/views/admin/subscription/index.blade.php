@extends('admin.default')
@section('title', 'Subscriptions')
@section('page-header')
Subscriptions <small>{{ trans('app.manage') }}</small>
@endsection
@section('content')
    {{-- <div class="mB-20">
        <a href="{{ route(ADMIN . '.users.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div> --}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subscription Type</th>
                    <th>Start Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->subscription->subscription_type?'Pro':'Free' }}</td>
                        <td>{{ $item->subscription->start_date??$item->subscription->start_date?:$item->subscription->created_at }}</td>
                        <td>
                            <ul class="list-inline">
                                {{-- <li class="list-inline-item">
                                    <a href="{{ route('paypal.express-checkout', ['recurring' => true, 'user_id' => $item->id]) }}" title="Add" class="btn btn-primary btn-sm"><span class="ti-plus"></span></a>
                                </li> --}}
                                <li class="list-inline-item">
                                    <a href="{{route(ADMIN . '.subscriptions.details',['id' => $item->subscription->invoice->recurring_id??'','sub_id' => $item->subscription->id??''])}}" title="Details" class="btn btn-primary btn-sm"><span class="ti-receipt"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{route(ADMIN . '.subscriptions.edit',['id' => $item->subscription->invoice->recurring_id??'','sub_id' => $item->subscription->id??''])}}" title="Update" class="btn btn-primary btn-sm"><span class="ti-pencil-alt"></span></a>
                                </li>
                                {{-- <li class="list-inline-item">
                                    <a href="" title="View" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                                </li> --}}
                                <li class="list-inline-item">
                                    <a href="{{route(ADMIN . '.subscriptions.cancel',['id' => $item->subscription->invoice->recurring_id??'','user_id' => $item->id])}}" title="Cancel" class="btn btn-danger btn-sm"><span class="ti-close"></span></a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subscription Type</th>
                    <th>Start Date</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
