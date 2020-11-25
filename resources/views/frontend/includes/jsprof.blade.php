<script src="{{asset('profilecss/js/app.js')}}"></script>
<script src="{{asset('profilecss/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('profilecss/js/ckeditor/custom/init.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')
