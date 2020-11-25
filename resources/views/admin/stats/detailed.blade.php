@extends('admin.default')
@section('title', 'Statistics')
@section('page-header')
    Statistics <small>{{ trans('app.manage') }}</small>
@endsection
@section('content')
    {{-- <div class="mB-20">
        <a href="{{ route(ADMIN . '.users.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div> --}}
    <h2 class="text-center py-3">Views</h2>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Page Name</th>
                    <th>Number of Views</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($views as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        @if ($item->pages)
                            <td>{{ $item->pages->page_template_name}}</td>
                        @else
                            <td>Profile Page</td>
                        @endif
                        <td>{{ $item->views}}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" title="Details" class="btn btn-primary btn-sm"><span class="ti-more"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{route('inner.page',['id' => $item->user->profile->url, 'innerId' => $item->pages->url??''])}}" target="_blank" title="Go to page" class="btn btn-primary btn-sm"><span class="ti-new-window"></span></a>
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
                    <th>Page Name</th>
                    <th>Number of Views</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
