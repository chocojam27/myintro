@extends('admin.default')
@section('title', 'Contents')
@section('page-header')
	Content Management <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="bgc-white bd bdrs-3 p-20 mB-20">
			<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>Name</th>
					<th>Last Updated</th>
					<th>Action</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<th>Name</th>
					<th>Last Updated</th>
					<th>Action</th>
				</tr>
				</tfoot>
				<tbody>
					@forelse($pages as $value)
					<tr>
						<td>{{ $value->name }} {{ $value->name != 'Subscription' ? 'Page' : '' }}</td>
						<td>{{ Carbon\Carbon::parse($value->created_at)->format('Y/m/d h:m A') }}</td>
						<td><!-- Example split danger button -->
							<button type="button" class="btn btn-secondary btn-sm" onclick="window.location='{{URL('admin/content-management/'.Crypt::encrypt($value->id).'/edit')}}'">Edit</button>
							{{-- <button type="button" class="btn btn-secondary btn-sm" onclick="window.location='{{URL('admin/content-management/add')}}'">Add</button> --}}
						</td>
					</tr>
					@empty
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
