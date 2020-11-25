@extends('admin.default')
@section('title', 'Users')
@section('page-header')
    Users <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')
    <div class="mB-20">
        <a href="{{ route(ADMIN . '.users.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.users.edit', $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->blocked?'Blocked':'Active' }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.users.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.users.destroy', $item->id),
                                        'method' => 'DELETE',
                                        ])
                                    !!}
                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>
                                    {!! Form::close() !!}
                                </li>
                                <li class="list-inline-item">
                                    @if ($item->blocked)
                                        {!! Form::open([
                                            'url'  => route(ADMIN . '.users.block', $item->id),
                                            'method' => 'post',
                                            ])
                                        !!}
                                            <button class="btn btn-success btn-sm" title="Unblock"><i class="ti-na"></i></button>
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open([
                                            'url'  => route(ADMIN . '.users.block', $item->id),
                                            'method' => 'post',
                                            ])
                                        !!}
                                            <button class="btn btn-danger btn-sm" title="Block"><i class="ti-na"></i></button>
                                        {!! Form::close() !!}
                                    @endif
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
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
