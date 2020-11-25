@extends('admin.default')
@section('title', 'Placeholders')
@section('page-header')
Placeholders <small>{{ trans('app.manage') }}</small>
@endsection
@section('content')
<div class="mB-20">
        <a href="{{ route(ADMIN . '.placeholders.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Format</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.placeholders.edit', $item->id) }}">{{ $item->format }}</a></td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.placeholders.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.placeholders.destroy', $item->id),
                                        'method' => 'DELETE',
                                        ])
                                    !!}
                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Format</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
