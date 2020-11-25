<div class="sidebar">
	<div class="sidebar-inner">
		<!-- ### $Sidebar Header ### -->
		<div class="sidebar-logo">
			<div class="peers ai-c fxw-nw">
				<div class="peer peer-greed">
					<a class='sidebar-link td-n' href="{{ url('/') }}">
						<div class="peers ai-c fxw-nw">
							<div class="peer" style="width:100%">
								<div class="logo" style="position: relative;width: 100%">
									<img src="{{asset('images/logo.png')}}" alt="" style="margin: auto;top: 0;bottom: 0;left: 0;right: 0;position: absolute;">
								</div>
							</div>
							{{-- <div class="peer peer-greed">
								<h5 class="lh-1 mB-0 logo-text">{{config('app.name', 'Laravel')}}</h5>
							</div> --}}
						</div>
					</a>
				</div>
				<div class="peer">
					<div class="mobile-toggle sidebar-toggle">
						<a href="" class="td-n">
							<i class="ti-arrow-circle-left"></i>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- ### $Sidebar Menu ### -->
		<ul class="sidebar-menu scrollable pos-r">
			@include('admin.partials.menu')
		</ul>
	</div>
</div>
