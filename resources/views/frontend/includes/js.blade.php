
<script src="{{asset('frontend/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('frontend/js/ckeditor/custom/init.js')}}"></script>
        <!-- javascript -->
     

        <!-- javascript -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/jquery.easing.min.js')}}"></script>
        <script src="{{asset('js/scrollspy.min.js')}}"></script>
        <!-- SLIDER -->
        <script src="{{asset('js/owl.carousel.min.js')}} "></script>
        <script src="{{asset('js/owl.init.js')}} "></script>
        <!-- Main Js -->
        <script src="{{asset('js/app.js')}}"></script>
 <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('js/magnific.init.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')
