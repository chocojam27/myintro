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
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-4"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="view-tab" data-toggle="tab" href="#view" role="tab" aria-controls="view" aria-selected="true">Views</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="click-tab" data-toggle="tab" href="#click" role="tab" aria-controls="click" aria-selected="false">Clicks</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="view" role="tabpanel" aria-labelledby="view-tab">
                        <div class="pt-20">
                            <h2 class="text-center py-3">Views</h2>
                            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile Pages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="url-tab" data-toggle="tab" href="#url" role="tab" aria-controls="url" aria-selected="false">Generated URLs</a>
                                    </li>
                                </ul>
                                <div class="tab-content" >
                                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="pt-20">
                                            <div class="bgc-white py-4 mB-20">
                                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Number of Views</th>
                                                            {{-- <th>Actions</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($profile as $item)
                                                            <tr>
                                                                <td>{{$item->user->name.' '.$item->user->surname}}</td>
                                                                <td>{{$item->user->email}}</td>
                                                                <td>{{$item->views->where('genPage_id',null)->count()}}</td>
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="url" role="tabpanel" aria-labelledby="url-tab">
                                        <div class="pt-20">
                                            <div class="bgc-white py-4 mB-20">
                                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Page Name</th>
                                                            <th>Number of Views</th>
                                                            {{-- <th>Actions</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($URL as $item)
                                                            <tr>
                                                                <td>{{$item->user->name.' '.$item->user->surname}}</td>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->views->count()}}</td>
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="click" role="tabpanel" aria-labelledby="click-tab">
                        <div class="pt-20">
                            <h2 class="text-center py-3">Clicks</h2>
                            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="click-profile-tab" data-toggle="tab" href="#click-profile" role="tab" aria-controls="click-profile" aria-selected="true">Profile Pages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="click-url-tab" data-toggle="tab" href="#click-url" role="tab" aria-controls="click-url" aria-selected="false">Generated URLs</a>
                                    </li>
                                </ul>
                                <div class="tab-content" >
                                    <div class="tab-pane fade show active" id="click-profile" role="tabpanel" aria-labelledby="click-profile-tab">
                                        <div class="pt-20">
                                            <div class="bgc-white py-4 mB-20">
                                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>URL Clicks</th>
                                                            <th>Social Link Clicks</th>
                                                            <th>Contact Button Clicks</th>
                                                            {{-- <th>Actions</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($profile as $item)
                                                            {{-- @if ($profile->clicks) --}}
                                                                <tr>
                                                                    <td>{{$item->user->name.' '.$item->user->surname}}</td>
                                                                    <td>{{$item->user->email}}</td>
                                                                    <td>{{$item->clicks->where('url',1)->count()}}</td>
                                                                    <td>{{$item->clicks->where('social',1)->count()}}</td>
                                                                    <td>{{$item->clicks->where('contact',1)->count()}}</td>
                                                                    {{-- <td></td> --}}
                                                                </tr>
                                                            {{-- @endif --}}
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="click-url" role="tabpanel" aria-labelledby="click-url-tab">
                                        <div class="pt-20">
                                            <div class="bgc-white py-4 mB-20">
                                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Page Name</th>
                                                            <th>Number of Views</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($URL as $item)
                                                            <tr>
                                                                <td>{{$item->user->name.' '.$item->user->surname}}</td>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->views->count()}}</td>
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
