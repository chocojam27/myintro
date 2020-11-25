@if (Session::has('errors'))
    <div class="col-md-8 offset-md-2 alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <ul class="list-unstyled">
        @foreach (Session::get('errors')->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


@if (Session::has('warning'))
    <div class="col-md-8 offset-md-2 alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('warning')}}
    </div>
@endif


@if (Session::has('info'))
    <div class="col-md-8 offset-md-2 alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('info')}}
    </div>
@endif


@if (Session::has('success'))
    <div class="col-md-8 offset-md-2 alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('success')}}
    </div>
@endif