@extends('layouts.default1')
@section('title','Profile')
@section('css')
<style>
    .section-create-page-tab .container .tab-content .tab-pane .thirdPage .GenerateForm select.form-control {
        min-width: 320px;
    }
    .section-create-page-tab .container .tab-content .tab-pane .secondPage {
        width: 80%;
    }
    .editTemplateTab{
        width: 80%;
        margin: 0 auto;
        padding: 50px 0px;
    }
    .section-create-page-tab .container .tab-content .tab-pane .thirdPage {
        max-width: 90%;
    }
    .ckeditor-container {
        width: 80%;
        margin: 0 auto;
        margin-bottom: 30px;
    }
    .saveGenerate {
        cursor: pointer;
    }
    span.hint {
        position: absolute;
        font-family: Montserrat-Regular;
        color: #9a9a9a;
        top: 10px;
        left: 18px;
        font-size: 25px;
    }
    .hint-pl {
        padding-left: 194px!important;
    }
    .btn-placeholder {
        cursor: pointer;
    }
    #profileBio textarea {
        resize:vertical;
        min-height:200px;
    }
    .item-theme.active > div{
        background:linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(36,54,208,0.6558998599439776) 0%);
        border-radius: 5px;
    }
    .item-theme i {
        display: none;
    }
    .item-theme.active i {
        display: inline-block;
        font-size: 100px;
        color: #fff;
    }
    .item-theme iframe {
        position: absolute;
        top: -340px;
        left: -469px;
        width: calc(100% * 4.5);
        height: calc(100% * 4.5);
        transform: scale(0.22);
    }
    .upload-pic .profile.error {
        -webkit-box-shadow: 0 0 4px 1px red;
        box-shadow: 0 0 4px 1px red;
        border-radius: 5px;
    }
    .upload-pic .profile.error .invalid-feedback,
    #template.error .invalid-feedback,
    #socials.error .invalid-feedback {
        display: block;
        padding-top: 10px;
    }
    .section-create-page-tab .container .tab-content .tab-pane .placeholder .phForm form input.form-control,
    .section-create-page-tab .container .tab-content .tab-pane .phForm .form-inline select.form-control {
        height: 65px;
    }
    .section-create-page-tab .container .tab-content .tab-pane .phForm .form-inline select.form-control {
        width: 25%;
        border-radius: 20px;
        font-family: Montserrat-Medium;
        margin: 10px;
        padding: 20px;
    }
    #appendHere .form-inline {
        padding: 10px 0;
    }
    .placeholder .saver input[type=submit] {
        width: 295px!important;
        font-size: 18px;
        font-family: Montserrat-Medium;
        background-color: #53ba58;
        color: #fff;
        padding: 16px 20px;
        margin: 0 auto;
        border-radius: 20px;
        cursor: pointer;
    }
    .tab-pane .stats{
        width: 90%;
        margin: 0 auto;
    }
    .tab-pane .stats .tableHolder{
        padding: 20px 0px;
    }
    .tab-pane .stats .statBtn div{
       border: 1px solid #c046e3;
       padding: 10px 20px;
       border-radius: 10px;
    }
    .tab-pane .stats .statBtn div p{
       margin: 0px;
       color: #c046e3;
       font-family: 'Montserrat-Bold';
       font-size: 16px;
    }
    .tab-pane .stats .statBtn div p span{
       margin: 0px;
       color: #c046e3;
       font-family: 'Montserrat-Regular';
    }
    .tab-pane .stats .statBtn div p.title{
       margin: 0px;
       color: #c046e3;
       font-size: 20px;
    }
    .tab-pane .stats .statBtn.active div p,.tab-pane .stats .statBtn.active div p span,.tab-pane .stats .statBtn.active div p.title{
       color: #fff;
    }
    .tab-pane .stats .statBtn.active div{
       background-color: #2f55d4;
       color: #fff;
       border: 1px solid transparent;
    }
    @media (max-width: 1650px) {
        .hint-pl {
            padding-left: 140px!important;
        }
        span.hint {
            top: 6px;
            left: 13px;
            font-size: 18px;
        }
    }
    @media (min-width: 1920px) {
        .item-theme iframe {
            top: -265px;
            left: -395px;
            width: calc(100% * 3.33);
            height: calc(100% * 3);
            transform: scale(0.3);
        }
    }
</style>
@stop
@section('content')
<main role="main" class="contents contact-page">

<!-- MODALS START -->
        <!-- GENERATE MODAL -->
        <div class="modal fade" id="Generate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content rounded shadow border-0">
                    <div class="modal-body">
                        <form action="">
                            <div class="p-4 shadow">
                                <h5 class="text-md-center text-center">Generate Url</h5>
                                <h6 class="text-md-center text-center">Create the name for your URL</h6>


                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group position-relative text-center">
                                            <input name="name" id="first" type="text" class="form-control" placeholder="Full Name :">
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                            <div class="p-4 mt-2 shadow">
                                <h5 class="text-md-center text-center">Placeholder</h5>
                                <h6 class="text-md-center text-center">Fill placeholders that will be used in this template</h6>


                                <div class="row mt-4 align-items-center">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-switch">
                                            <div class="form-group">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">Activate custom Placeholder</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row mt-2 align-items-center">
                                            <div class="col-md-5">
                                                <div class="form-group mb-0">
                                                    <select class="form-control">
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" placeholder="Type here">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-0">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-minus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 align-items-center">
                                            <div class="col-md-5">
                                                <div class="form-group mb-0">
                                                    <select class="form-control">
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" placeholder="Type here">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-0">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-minus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 align-items-center">
                                            <div class="col-md-5">
                                                <div class="form-group mb-0">
                                                    <select class="form-control">
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                        <option value="">Sample Option</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" placeholder="Type here">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-0">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-12 mt-4">
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-success btn-lg"><i class="mdi mdi-content-save next-5"></i> Save and Generate Url</a>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><!-- GENERATE MODAL -->

        <!-- EDIT MODAL -->
        <div class="modal fade" id="action-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content rounded shadow border-0">
                    <div class="modal-body">
                        <form action="">
                            <div class="p-4 shadow">
                                <h5 class="text-md-center text-center">Edit Page</h5>

                                <div class="mt-4">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group position-relative text-left">
                                                <label>Name of Tempate</label>
                                                <i class="mdi mdi-file ml-3 icons"></i>
                                                <input name="name" type="text" class="form-control pl-5" placeholder="Template">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="form-group position-relative text-left">
                                                <label>Tag</label>
                                                <i class="mdi mdi-tag ml-3 icons"></i>
                                                <input name="name" type="text" class="form-control pl-5" placeholder="Tag">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="form-group position-relative text-left">
                                                <label>Full Name</label>
                                                <i class="mdi mdi-account ml-3 icons"></i>
                                                <input name="name" type="text" class="form-control pl-5" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- <!DOCTYPE html>
                                            <html>
                                                <head>
                                                    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
                                                    <script>tinymce.init({selector:'textarea'});</script>
                                                </head>
                                                <body>
                                                    <textarea>Next, use our Get Started docs to setup Tiny!</textarea>
                                                </body>
                                            </html> -->
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="text-right">
                                                <a href="javascript:void(0)" class="btn btn-secondary btn-lg">Placeholders</a>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-lg">Save</a>
                                                <a href="javascript:void(0)" class="btn btn-success btn-lg"><i class="mdi mdi-content-save"></i> Save and Generate Url</a>
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><!-- EDIT MODAL -->
        <!-- MODALS END -->

        <!-- Hero Start -->
        <section class="bg-half bg-light">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 text-center">
                                <div class="page-next-level">
                                    <h4 class="title"> Profile </h4>
                                </div>
                            </div>  <!--end col-->
                        </div><!--end row-->
                    </div> <!--end container-->
                </div>
            </div>
        </section><!--end section-->
        <!-- Hero End -->

        <!-- Shape Start -->
        <div class="position-relative">
            <div class="shape overflow-hidden text-white">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!--Shape End-->

        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <!-- Nav Tabs Start -->
                        <div class="col mt-4 pt-2">
                            <div class="component-wrapper rounded shadow">
                                <div class="p-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-templates-tab" data-toggle="pill" href="#pills-templates" role="tab" aria-controls="pills-templates" aria-selected="false">
                                                        <div class="text-center pt-1 pb-1">
                                                            <h4 class="title font-weight-normal mb-0">Templates</h4>
                                                        </div>
                                                    </a><!--end nav link-->
                                                </li><!--end nav item-->

                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-profile-page-tab" data-toggle="pill" href="#pills-profile-page" role="tab" aria-controls="pills-profile-page" aria-selected="false">
                                                        <div class="text-center pt-1 pb-1">
                                                            <h4 class="title font-weight-normal mb-0">Profile Page</h4>
                                                        </div>
                                                    </a><!--end nav link-->
                                                </li><!--end nav item-->

                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-placeholder-tab" data-toggle="pill" href="#pills-placeholder" role="tab" aria-controls="pills-placeholder" aria-selected="false">
                                                        <div class="text-center pt-1 pb-1">
                                                            <h4 class="title font-weight-normal mb-0">Placeholder</h4>
                                                        </div>
                                                    </a><!--end nav link-->
                                                </li><!--end nav item-->

                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-statistics-tab" data-toggle="pill" href="#pills-statistics" role="tab" aria-controls="pills-statistics" aria-selected="false">
                                                        <div class="text-center pt-1 pb-1">
                                                            <h4 class="title font-weight-normal mb-0">Statistics</h4>
                                                        </div>
                                                    </a><!--end nav link-->
                                                </li><!--end nav item-->

                                                <li class="nav-item">
                                                    <a class="nav-link" href="#" target="_blank" aria-selected="false">
                                                        <div class="text-center pt-1 pb-1">
                                                            <h4 class="title font-weight-normal mb-0">MyIntro.Page</h4>
                                                        </div>
                                                    </a><!--end nav link-->
                                                </li><!--end nav item-->
                                            </ul><!--end nav pills-->
                                        </div><!--end col-->
                                    </div><!--end row-->

                                    <div class="row pt-2">
                                        <div class="col-12">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-templates" role="tabpanel" aria-labelledby="pills-templates-tab">

                                                    <!-- Table Start -->
                                                    <div class="col pt-2">
                                                        <div class="component-wrapper rounded shadow">
                                                            <div class="p-4 border-bottom">
                                                                <h4 class="title mb-0"> Table </h4>
                                                            </div>

                                                            <div class="p-4">
                                                                <div class="table-responsive bg-white shadow rounded">
                                                                    <table class="table mb-0 table-center td-center">
                                                                        <thead>
                                                                            <tr>
                                                                            <th scope="col">Date</th>
                                                                            <th scope="col">Name of the template</th>
                                                                            <th scope="col">Tag</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">Statistics</th>
                                                                            <th scope="col">Action</th>
                                                                            <th scope="col">Generate URL</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">2019-12-18 18:54:57 </th>
                                                                                <td>Template 1</td>
                                                                                <td>#RaffyTulfo</td>
                                                                                <td>Tulfo</td>
                                                                                <td>URL: 1</td>
                                                                                <td>
                                                                                    <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-pencil"> </i></a>
                                                                                    <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                </td>
                                                                                <td>
                                                                                    <a href="index.html" data-toggle="modal" data-target="#Generate" class="btn btn-success">Generate</a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">2019-12-18 18:54:57 </th>
                                                                                <td>Template 2</td>
                                                                                <td>#KMJS</td>
                                                                                <td>Jessica</td>
                                                                                <td>URL: 2</td>
                                                                                <td>
                                                                                    <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-pencil"> </i></a>
                                                                                    <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                </td>
                                                                                <td>
                                                                                    <a href="index.html" data-toggle="modal" data-target="#Generate" class="btn btn-success">Generate</a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">2019-12-18 18:54:57 </th>
                                                                                <td>Template 3</td>
                                                                                <td>#RatedK</td>
                                                                                <td>Korina</td>
                                                                                <td>URL: 3</td>
                                                                                <td>
                                                                                    <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                                                                                    <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                </td>
                                                                                <td>
                                                                                    <a href="index.html" data-toggle="modal" data-target="#Generate" class="btn btn-success">Generate</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="p-4 text-center">
                                                                <a  data-toggle="modal" data-target="#action-edit" class="btn btn-success btn-lg"><i class="mdi mdi-file-plus"></i> Create new page</a>
                                                            </div>
                                                        </div>
                                                    </div><!--end col-->
                                                    <!-- Table End -->
                                                </div><!--end teb pane-->

                                                <div class="tab-pane fade" id="pills-profile-page" role="tabpanel" aria-labelledby="pills-profile-page-tab">

                                                    <form action="" id="2a" enctype="multipart/form-data">
                                                        <div class="p-4 shadow">
                                                            <h5 class="text-md-center text-center">Profile Picture</h5>

                                                            <div class="mt-3 text-md-left text-center d-sm-flex">
                                                                <img src="images/client/01.jpg" class="avatar float-md-left avatar-ex-large rounded-pill shadow mr-md-4" alt="">

                                                                <div class="mt-md-5 mt-4 mt-sm-0">
                                                                    <a href="javascript:void(0)" class="btn btn-primary mt-2">Change Picture</a>
                                                                    <a href="javascript:void(0)" class="btn btn-danger mt-2 ml-2">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="p-4 mt-4 shadow">
                                                            <h5 class="text-md-center text-center">Choose Your Design</h5>

                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                                                    <label class="catagories border rounded">
                                                                        <img src="images/work/1.jpg" class="img-fluid rounded-top" alt="">
                                                                        <div class="bg-white rounded-bottom p-3">
                                                                            <ul class="list-unstyled mb-0">
                                                                                <li>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <div class="form-group mb-0">
                                                                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                                                            <span class="custom-control-label" for="customRadio1">Template 1</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </label>
                                                                </div>

                                                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                                                    <label class="catagories border rounded">
                                                                        <img src="images/work/1.jpg" class="img-fluid rounded-top" alt="">
                                                                        <div class="bg-white rounded-bottom p-3">
                                                                            <ul class="list-unstyled mb-0">
                                                                                <li>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <div class="form-group mb-0">
                                                                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                                                            <span class="custom-control-label" for="customRadio2">Template 2</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </label>
                                                                </div>

                                                                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                                                                    <label class="catagories border rounded">
                                                                        <img src="images/work/1.jpg" class="img-fluid rounded-top" alt="">
                                                                        <div class="bg-white rounded-bottom p-3">
                                                                            <ul class="list-unstyled mb-0">
                                                                                <li>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <div class="form-group mb-0">
                                                                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                                                                            <span class="custom-control-label" for="customRadio3">Template 3</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="p-4 mt-4 shadow">
                                                            <h5 class="text-md-center text-center">Profile</h5>

                                                            <div class="row mt-4">
                                                                <div class="col-md-12">
                                                                    <div class="form-group position-relative text-left">
                                                                        <label>Full Name</label>
                                                                        <i class="mdi mdi-account ml-3 icons"></i>
                                                                        <input name="name" id="first" type="text" class="form-control pl-5" placeholder="Full Name :">
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-md-12">
                                                                    <div class="form-group position-relative text-left">
                                                                        <label>Title</label>
                                                                        <i class="mdi mdi-format-title ml-3 icons"></i>
                                                                        <input name="name" id="last" type="text" class="form-control pl-5" placeholder="Title :">
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-md-12">
                                                                    <div class="form-group position-relative text-left">
                                                                        <label>Bio</label>
                                                                        <i class="mdi mdi-comment-text-outline ml-3 icons"></i>
                                                                        <textarea name="comments" id="comments" rows="4" class="form-control pl-5" placeholder="Bio :"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div><!--end row-->
                                                        </div>

                                                        <div class="p-4 mt-4 shadow">
                                                            <h5 class="text-md-center text-center">Social Sites</h5>

                                                            <div class="row mt-4 align-items-center">
                                                                <div class="col-md-12">
                                                                    <div class="custom-control custom-switch">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                                            <label class="custom-control-label" for="customSwitch2">Add Extra URLs</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group mb-0">
                                                                                <select class="form-control">
                                                                                    <option value="">Facebook</option>
                                                                                    <option value="">Twitter</option>
                                                                                    <option value="">Instagram</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="form-group mb-0">
                                                                                <input type="text" class="form-control" placeholder="example.com">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group mb-0">
                                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-minus"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group mb-0">
                                                                                <select class="form-control">
                                                                                    <option value="">Facebook</option>
                                                                                    <option value="">Twitter</option>
                                                                                    <option value="">Instagram</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="form-group mb-0">
                                                                                <input type="text" class="form-control" placeholder="example.com">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group mb-0">
                                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-minus"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group mb-0">
                                                                                <select class="form-control">
                                                                                    <option value="">Facebook</option>
                                                                                    <option value="">Twitter</option>
                                                                                    <option value="">Instagram</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="form-group mb-0">
                                                                                <input type="text" class="form-control" placeholder="example.com">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group mb-0">
                                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-plus"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!--end col-->

                                                                <div class="col-md-12 mt-4">
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-12">
                                                                            <div class="custom-control custom-switch">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                                                                    <label class="custom-control-label" for="customSwitch3">Activate Contact Form</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-12">
                                                                            <div class="custom-control custom-switch">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" class="custom-control-input" id="customSwitch4">
                                                                                    <label class="custom-control-label" for="customSwitch4">Add Video to Your Page</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!--end col-->
                                                            </div><!--end row-->
                                                        </div>

                                                        <div class="p-4 mt-4 shadow">
                                                            <h5 class="text-md-center text-center">URL</h5>

                                                            <div class="row mt-4 align-items-center">
                                                                <div class="col-md-12 mt-4">
                                                                    <div class="form-group position-relative text-left custom-padding-url">
                                                                        <span>myintro.page/</span>
                                                                        <input name="url" type="text" class="form-control pl-url">
                                                                    </div>
                                                                </div><!--end col-->

                                                                <div class="col-md-12 mt-4">
                                                                    <div class="text-center">
                                                                        <a href="javascript:void(0)" class="btn btn-success btn-lg"><i class="mdi mdi-content-save"></i> Save and Generate Url</a>
                                                                    </div>
                                                                </div>
                                                            </div><!--end row-->
                                                        </div>
                                                    </form>
                                                </div><!--end teb pane-->

                                                <div class="tab-pane fade" id="pills-placeholder" role="tabpanel" aria-labelledby="pills-placeholder-tab">

                                                    <form action="">
                                                        <div class="p-4 shadow">
                                                            <h5 class="text-md-center text-center">Placeholder</h5>

                                                            <div class="row mt-4 align-items-center">
                                                                <div class="col-md-12">
                                                                    <div class="custom-control custom-switch">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" class="custom-control-input" id="customSwitch5">
                                                                            <label class="custom-control-label" for="customSwitch5">Activate custom Placeholder</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group mb-0">
                                                                                <select class="form-control">
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group mb-0">
                                                                                <input type="text" class="form-control" placeholder="Type here">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group mb-0">
                                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-minus"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group mb-0">
                                                                                <select class="form-control">
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group mb-0">
                                                                                <input type="text" class="form-control" placeholder="Type here">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group mb-0">
                                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-minus"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2 align-items-center">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group mb-0">
                                                                                <select class="form-control">
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                    <option value="">Sample Option</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group mb-0">
                                                                                <input type="text" class="form-control" placeholder="Type here">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group mb-0">
                                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#Generate" class="btn btn-success"><i class="mdi mdi-plus"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!--end col-->

                                                                <div class="col-md-12 mt-5">
                                                                    <div class="text-center">
                                                                        <a href="javascript:void(0)" class="btn btn-success btn-lg"><i class="mdi mdi-content-save"></i> Save</a>
                                                                    </div>
                                                                </div>
                                                            </div><!--end row-->
                                                        </div>
                                                    </form>
                                                </div><!--end teb pane-->

                                                <div class="tab-pane fade" id="pills-statistics" role="tabpanel" aria-labelledby="pills-statistics-tab">

                                                    <div class="component-wrapper rounded shadow">
                                                        <div class="p-4">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded" id="pills-tab" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link rounded active" id="stat-profile-tab" data-toggle="pill" href="#stat-profile" role="tab" aria-controls="stat-profile" aria-selected="true">
                                                                                <div class="text-center pt-1 pb-1">
                                                                                    <h4 class="title font-weight-normal mb-0">Profile Page</h4>
                                                                                </div>
                                                                            </a><!--end nav link-->
                                                                        </li><!--end nav item-->

                                                                        <li class="nav-item">
                                                                            <a class="nav-link rounded" id="stat-templates-tab" data-toggle="pill" href="#stat-templates" role="tab" aria-controls="stat-templates" aria-selected="false">
                                                                                <div class="text-center pt-1 pb-1">
                                                                                    <h4 class="title font-weight-normal mb-0">Template Pages</h4>
                                                                                </div>
                                                                            </a><!--end nav link-->
                                                                        </li><!--end nav item-->

                                                                        <li class="nav-item">
                                                                            <a class="nav-link rounded" id="stat-urls-tab" data-toggle="pill" href="#stat-urls" role="tab" aria-controls="stat-urls" aria-selected="false">
                                                                                <div class="text-center pt-1 pb-1">
                                                                                    <h4 class="title font-weight-normal mb-0">Generated URLs</h4>
                                                                                </div>
                                                                            </a><!--end nav link-->
                                                                        </li><!--end nav item-->

                                                                        <li class="nav-item">
                                                                            <a class="nav-link rounded" id="my-account-tab" data-toggle="pill" href="#my-account" role="tab" aria-controls="my-account" aria-selected="true">
                                                                                <div class="text-center pt-1 pb-1">
                                                                                    <h4 class="title font-weight-normal mb-0">My Account</h4>
                                                                                </div>
                                                                            </a><!--end nav link-->
                                                                        </li><!--end nav item-->
                                                                    </ul><!--end nav pills-->
                                                                </div><!--end col-->
                                                            </div><!--end row-->

                                                            <div class="row pt-2">
                                                                <div class="col-12">
                                                                    <div class="tab-content" id="pills-tabContent">
                                                                        <div class="tab-pane fade active show" id="stat-profile" role="tabpanel" aria-labelledby="stat-profile-tab">

                                                                            <div class="component-wrapper">
                                                                                <div class="p-3 text-left">
                                                                                    <h4 class="title mb-0"> Number Of Views: </h4>
                                                                                </div>

                                                                                <div class="px-3 pb-3">
                                                                                    <div class="table-responsive bg-white shadow">
                                                                                        <table class="table mb-0 table-center">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="text-left">Total:</td>
                                                                                                    <td class="text-right">
                                                                                                        <span class="badge badge-primary">152</span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="component-wrapper mt-3">
                                                                                <div class="p-3 text-left">
                                                                                    <h4 class="title mb-0"> Number of Clicks: </h4>
                                                                                </div>

                                                                                <div class="px-3 pb-3">
                                                                                    <div class="table-responsive bg-white shadow">
                                                                                        <table class="table mb-0 table-center">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="text-left">Social Sites:</td>
                                                                                                    <td class="text-right">
                                                                                                        <span class="badge badge-primary">5</span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="text-left">Contact Form:</td>
                                                                                                    <td class="text-right">
                                                                                                        <span class="badge badge-primary">4</span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="component-wrapper mt-3">
                                                                                <div class="p-3 text-left">
                                                                                    <h4 class="title mb-0"> Number of Emails Received: </h4>
                                                                                </div>

                                                                                <div class="px-3 pb-3">
                                                                                    <div class="table-responsive bg-white shadow">
                                                                                        <table class="table mb-0 table-center">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="text-left">Total:</td>
                                                                                                    <td class="text-right">
                                                                                                        <span class="badge badge-primary">6</span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!--end teb pane-->

                                                                        <div class="tab-pane fade" id="stat-templates" role="tabpanel" aria-labelledby="stat-templates-tab">

                                                                            <div class="component-wrapper">
                                                                                <div class="p-4">
                                                                                    <div class="table-responsive bg-white shadow rounded">
                                                                                        <table class="table mb-0 table-center td-center">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th scope="col">Date</th>
                                                                                                    <th scope="col">Template Name</th>
                                                                                                    <th scope="col">Number Active Of URLs</th>
                                                                                                    <th scope="col">Action</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th scope="row">2019-12-18 18:54:57 </th>
                                                                                                    <td>Template 1</td>
                                                                                                    <td>1</td>
                                                                                                    <td>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-eye"> </i></a>
                                                                                                        <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">2019-12-18 18:54:57 </th>
                                                                                                    <td>Template 2</td>
                                                                                                    <td>1</td>
                                                                                                    <td>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-eye"> </i></a>
                                                                                                        <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">2019-12-18 18:54:57 </th>
                                                                                                    <td>Template 3</td>
                                                                                                    <td>2</td>
                                                                                                    <td>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                                                                                                        <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!--end teb pane-->

                                                                        <div class="tab-pane fade" id="stat-urls" role="tabpanel" aria-labelledby="stat-urls-tab">

                                                                            <div class="component-wrapper">
                                                                                <div class="p-4">
                                                                                    <div class="table-responsive bg-white shadow rounded">
                                                                                        <table class="table mb-0 table-center td-center">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th scope="col">Date</th>
                                                                                                    <th scope="col">Page Name</th>
                                                                                                    <th scope="col">Clicks</th>
                                                                                                    <th scope="col">Page Views</th>
                                                                                                    <th scope="col">Action</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th scope="row">2019-12-18 18:54:57 </th>
                                                                                                    <td>Template 1</td>
                                                                                                    <td>1</td>
                                                                                                    <td>8</td>
                                                                                                    <td>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-eye"> </i></a>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-success"><i class="mdi mdi-file-multiple"> </i></a>
                                                                                                        <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">2019-12-18 18:54:57 </th>
                                                                                                    <td>Template 2</td>
                                                                                                    <td>1</td>
                                                                                                    <td>3</td>
                                                                                                    <td>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-eye"> </i></a>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-success"><i class="mdi mdi-file-multiple"> </i></a>
                                                                                                        <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">2019-12-18 18:54:57 </th>
                                                                                                    <td>Template 3</td>
                                                                                                    <td>2</td>
                                                                                                    <td>1</td>
                                                                                                    <td>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-primary"><i class="mdi mdi-eye"> </i></a>
                                                                                                        <a href="index.html" data-toggle="modal" data-target="#action-edit" class="btn btn-success"><i class="mdi mdi-file-multiple"> </i></a>
                                                                                                        <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!--end teb pane-->

                                                                        <div class="tab-pane fade" id="my-account" role="tabpanel" aria-labelledby="my-account-tab">

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <form id="updateUser">
                                                                                        <div class="p-4 mt-4 shadow">
                                                                                            <h5 class="text-md-left text-left">Credentials</h5>

                                                                                            <div class="row mt-4">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group position-relative text-left">
                                                                                                        <label>Email</label>
                                                                                                        <i class="mdi mdi-account ml-3 icons"></i>
                                                                                                        <input name="name" id="first" type="email" class="form-control pl-5" placeholder="Email Address :">
                                                                                                    </div>
                                                                                                </div><!--end col-->

                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group position-relative text-left">
                                                                                                        <label>New Password</label>
                                                                                                        <i class="mdi mdi-lock ml-3 icons"></i>
                                                                                                        <input name="newPassword" id="first" type="password" class="form-control pl-5" placeholder="New Password :">
                                                                                                    </div>
                                                                                                </div><!--end col-->

                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group position-relative text-left">
                                                                                                        <label>Confirm Password</label>
                                                                                                        <i class="mdi mdi-lock ml-3 icons"></i>
                                                                                                        <input name="conPassword" id="first" type="password" class="form-control pl-5" placeholder="Confirm Password :">
                                                                                                    </div>
                                                                                                </div><!--end col-->

                                                                                                <div class="col-sm-12 text-center">
                                                                                                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="Update">
                                                                                                </div>
                                                                                            </div><!--end row-->
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="col-md-6 mt-4 mt-md-0">
                                                                                    <div class="p-4 mt-4 shadow">
                                                                                        <h5 class="text-md-left text-left">Subscription Details:</h5>

                                                                                        <div class="component-wrapper">
                                                                                            <div class="p-3 text-left">
                                                                                                <h4 class="title mb-0"> Number Of Views: </h4>
                                                                                            </div>

                                                                                            <div class="px-3 pb-3">
                                                                                                <div class="table-responsive bg-white shadow">
                                                                                                    <table class="table mb-0 table-center">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td class="text-left">Subscription type:</td>
                                                                                                                <td class="text-right">
                                                                                                                    <span class="badge badge-primary">{{$user_subs->subscription->subscription_type?'Pro ':'Free '}}</span>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td class="text-left">Amount:</td>
                                                                                                                <td class="text-right">
                                                                                                                    <span class="badge badge-primary">{{$user_subs->subscription->invoice->price??'Free'}}</span>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td class="text-left">Start Date:</td>
                                                                                                                <td class="text-right">
                                                                                                                    <span class="badge badge-primary">{{$user_subs->subscription->invoice?$user_subs->subscription->start_date:$user_subs->subscription->created_at}}</span>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td class="text-left">Invoice Number:</td>
                                                                                                                <td class="text-right">
                                                                                                                    <span class="badge badge-primary">{{$user_subs->subscription->invoice->transaction_id??'None'}}</span>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td class="text-left">Profile Number:</td>
                                                                                                                <td class="text-right">
                                                                                                                    <span class="badge badge-primary">{{$user_subs->subscription->invoice->recurring_id??'None'}}</span>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                                <a href="#" class="btn btn-success mt-4 checkInvoice"> See More </a>
                                                                                            @if ($user_subs->subscription->subscription_type)
                                                                                                <div class="alert alert-info mt-4" role="alert">
                                                                                                    You can cancel your subscription in your account on Paypal. <a target="_blank" href="https://www.paypal.com/" class="alert-link">Go to Paypal</a> or see <a target="_blank" class="alert-link" href="https://www.paypal.com/ph/smarthelp/article/how-do-i-cancel-a-recurring-payment,-subscription,-or-automatic-billing-agreement-i-have-with-a-merchant-faq1067">Instructions from Paypal.</a>
                                                                                                </div>
                                                                                                @else
                                                                                                <div class="alert alert-info mt-4" role="alert">
                                                                                                    <a href="{{ route('paypal.express-checkout', ['recurring' => true]) }}" class="btn btn-pink btn-block">Go Pro Now</a>
                                                                                                </div>
                                                                                            @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!--end teb pane-->
                                                                    </div><!--end tab content-->
                                                                </div><!--end col-->
                                                            </div><!--end row-->
                                                        </div>
                                                    </div>
                                                </div><!--end teb pane-->
                                            </div><!--end tab content-->
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
                            </div>
                        </div><!--end col-->
                        <!-- Nav Tabs End -->
                    </div>
                </div>
            </div>
        </section>
</main>
@stop
@section('js')
<script type="text/javascript">
    var timer;
    $(window).on('load', function () {
        // initCKeditor();
        CKEDITOR.replaceAll('editEditor');
    });
    $(document).on('submit','#updateUser',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{route('credential.update')}}",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    type: response.result[0]['type'],
                    title: response.result[0]['title'],
                    text: response.result[0]['message'],
                });
                location.reload();
            },error: function (errors) {
                $.each(errors.responseJSON.errors, function (indexInArray, valueOfElement) {
                    Swal.fire({
                        type: 'error',
                        title: 'error',
                        text: valueOfElement[0],
                    });
                });
            }
        });
    });
    $(document).on('click','.checkInvoice',function(e){
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{route('paypal.getInvoice')}}",
            success: function (data) {
                if(data.result == 'success'){
                    $("#appendInvoiceModal").empty();
                    $('#appendInvoiceModal').append(data.html);
                    $('.DataTableID').DataTable();
                    $('#invoiceModal').modal('show');
                }else{
                    Swal.fire({
                        type: data.result,
                        title: data.title,
                        text: data.message,
                    });
                }
            },
        });
    });
    $(document).on('click','.checkPpalRec',function(e){
        e.preventDefault();
        rec_id = $(this).data('id');
        $('#invoiceModal').modal('hide');
        $.ajax({
            type: "get",
            url: "{{route('paypal.getProfile')}}",
            data: {id: rec_id},
            success: function (data) {
                if(data.result == 'success'){
                    $("#appendPaypalModal").empty();
                    $('#appendPaypalModal').append(data.html);
                    $('.DataTableID').DataTable();
                    $('#paypalModal').modal('show');
                }else{
                    Swal.fire({
                        type: data.result,
                        title: data.title,
                        text: data.message,
                    });
                }
            },
        });
    });
    $(document).on('click','.cancelSub',function(e){
        e.preventDefault();
        Swal.fire({
            type: 'warning',
            title: 'Request for Cancellation?',
            showCancelButton: true,
            text: 'are you sure you want to cancel your current subscription?',
        }).then(function (result) {
                if(result.value){
                    $.ajax({
                        type: "post",
                        url: "{{route('request.cancel.subscription')}}",
                    success: function (response) {
                        if(response.response == 'success'){
                            Swal.fire({
                                type: 'success',
                                title: 'Cancel Request Sent',
                                text: 'The admin is reviewing your request.',
                            }).then(function (result) {
                                location.reload();
                            });
                        }else if(response.response == 'warning'){
                            Swal.fire({
                                type: 'warning',
                                title: 'Request Already Sent',
                                text: 'Please Wait, The admin is reviewing your request.',
                            });
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                        }
                    },
                });
            }
        });
    });
    $(document).on('click', '.statBtn', function(e) {
        e.preventDefault();
        $('.statBtn').removeClass('active');
        $(this).addClass('active');
        console.log($(this).hasClass('clicks'));
        if($(this).hasClass('clicks')){
            $('.tableHolder').css('display','none');
            $('.clicksTable').css('display','block');
        }else if($(this).hasClass('views')){
            $('.tableHolder').css('display','none');
            $('.viewsTable').css('display','block');
        }else{
            $('.tableHolder').css('display','none');
            $('.subscTable').css('display','block');
        }
    });
    $(document).on('click', '.next-5', function(e) {
        e.preventDefault();
        $('#2a').submit();
    });
    $(document).on('submit', '#1a', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var placeholderID = [];
        var phFormat = [];
        var phName = [];
        $('[name=placeholder_name]').each(function (index, element) {
            phName.push($(element).val());
        });
        $('[name=placeholder_format]').each(function (index, element) {
            phFormat.push($(element).val());

        });
        $('[name=newT_placeholder_id]').each(function (index, element) {
            placeholderID.push($(element).val());
        });
        $('[name=newT_placeholder_ids]').val(placeholderID);
        $('[name=ntPlaceholder_names]').val(phName);
        $('[name=ntPlaceholder_formats]').val(phFormat);
        $('[name=newT_url]').val($('[name=templateTag]').val());
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{route('pageTemplate.save')}}",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response.result[0]['result']);
                if(response.result[0]['result'] == 'success'){
                    Swal.fire({
                        type: response.result[0]['type'],
                        title: response.result[0]['title'],
                        text: response.result[0]['message'],
                    });
                    $('.hideOnscs').hide('slow',function(){
                        $('div#showOnGenerate').slideDown('fast');
                        $('.urlHere').val(response.PageURL);
                        $('.pageURLview').attr('href', response.PageURL);
                    });
                }else{
                    Swal.fire({
                        type: response.result[0]['type'],
                        title: response.result[0]['title'],
                        text: response.result[0]['message'],
                    });
                }
            },
            error: function (errors) {
                $.each(errors.responseJSON.errors, function (indexInArray, valueOfElement) {
                    Swal.fire({
                        type: 'error',
                        title: 'error',
                        text: valueOfElement[0],
                    });
                });
            }
        });
    });
    $(document).on('submit', '#2a', function(e) {
        e.preventDefault();
        var socialProvider = [];
        var formData = new FormData(this);
        $('[name=social_provider]').each(function (index, element) {
            socialProvider.push($(element).val());
        });
        formData.append('social_provider', socialProvider);
        $('input, textarea').removeClass('is-invalid');
        $('.upload-pic .profile, #template, #socials').removeClass('error');
        $.ajax({
            type: "post",
            url: "{{route('profile.save')}}",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.result == 'success'){
                    Swal.fire({
                        type: 'success',
                        title: 'Good Job!',
                        text: 'Profile page have been successfully updated.',
                    }).then(function (result) {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            },
            beforeSend: function (response) {
                $('#loadingDiv').show();
            },
            complete: function (response) {
                $('#loadingDiv').fadeOut('fast');
            },
            error: function (errors) {
                $.each(errors.responseJSON.errors, function (indexInArray, valueOfElement) {
                    if(indexInArray == 'image'){
                        $('.upload-pic .profile').addClass('error');
                    }else if(indexInArray == 'template'){
                        $('#template').addClass('error');
                    }else if(indexInArray == 'social_url' || indexInArray == 'social_provider'){
                        $('#socials').addClass('error');
                        $('#socials').find('strong').text(valueOfElement[0]);
                    }else{
                        $(`[name^=${indexInArray}]`).addClass('is-invalid');
                        $(`[name^=${indexInArray}]`).next().find('strong').text(valueOfElement[0]);
                    }
                });
            }
        });
    });
    $(document).on('click', '.saveGen', function (e) {
        e.preventDefault();
        $('#1a').submit();
    });
    $(document).on('click', '.saveBtn', function () {
        var placeholderID = [];
        var phFormat = [];
        var phName = [];
        $('[name=placeholder_id]').each(function (index, element) {
            placeholderID.push($(element).val());
        });
        $('[name=placeholder_name]').each(function (index, element) {
            phName.push($(element).val());
        });
        $('[name=placeholder_format]').each(function (index, element) {
            phFormat.push($(element).val());

        });
        $('[name=placeholder_ids]').val(placeholderID);
        $('[name=placeholder_names]').val(phName);
        $('[name=placeholder_formats]').val(phFormat);
        var formData = $('#placeholder-form, #other-placeholder-form').serialize();
        $.ajax({
            type: "post",
            url: "{{route('profile.save-placeholder')}}",
            data: formData,
            dataType: "json",
            success: function (response) {
                if(response.result == 'success'){
                    Swal.fire({
                        type: 'success',
                        title: 'Good Job!',
                        text: 'Profile page have been successfully updated.',
                    }).then(function (result) {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            },
            // error: function (errors) {
            //     $.each(errors.responseJSON.errors, function (indexInArray, valueOfElement) {
            //         $(`[name^=${indexInArray}]`).addClass('is-invalid');
            //         $(`[name^=${indexInArray}]`).next('strong').text(valueOfElement[0]);
            //     });
            // }
        });
    });
    $(document).on('click', '.btn-placeholder', function () {
        if($(this).find('i').hasClass('fa-plus')){
            parent = $(this).parents('form');
            if(parent.attr('id') == "placeholder-form"){
                if($("[name=placeholder_id]").last().find('option').length - 1){
                    var selectOptions = '';
                    $("[name=placeholder_id]").last().find('option').each(function(index, element) {
                        if($('[name=placeholder_id]').last().val() != $(element).val()){
                            selectOptions += `<option value="${$(element).val()}">${$(element).text()}</option>`;
                        }
                    });
                    $(parent).append(`<div class="form-inline justify-content-center">
                                        <select class="form-control" name="placeholder_id">
                                            ${selectOptions}
                                        </select>
                                        <input class="form-control" type="text" name="placeholder_value[]" placeholder="Type Here">
                                        <a class="form-control btn-placeholder"><i class="fa fa-minus"></i></a>
                                        <a class="form-control btn-placeholder"><i class="fa fa-plus"></i></a>
                                    </div>`);
                    $(this).siblings('select').attr('disabled', 'disabled');
                    if($(this).parent().find('.fa-minus').length){
                        $(this).remove();
                    }else{
                        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                    }
                }else{
                    alert('No more placeholder available.');
                    $(this).siblings('select').attr('disabled', 'disabled');
                    if($(this).parent().find('.fa-minus').length){
                        $(this).remove();
                    }else{
                        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                    }
                }
            }else{
                $('#appendHere').append(`<div class="form-inline justify-content-center">
                                    <input class="form-control" type="text" name="placeholder_name" placeholder="Name of the Placeholder">
                                    <input class="form-control" type="text" name="placeholder_format" placeholder="%Example%">
                                    <a class="form-control btn-placeholder"><i class="fa fa-minus"></i></a>
                                    <a class="form-control btn-placeholder"><i class="fa fa-plus"></i></a>
                                </div>`);
                if($(this).parent().find('.fa-minus').length){
                    $(this).remove();
                }else{
                    $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                }
            }
        }else{
            parent = $(this).parents('form');
            if(parent.attr('id') == "placeholder-form"){
                var selectedOption = $(this).siblings('select');
                $("[name=placeholder_id]").last().append(`<option value="${selectedOption.val()}">${selectedOption.find('option:selected').text()}</option>`);
                $(this).parents('.form-inline').remove();
                $("[name=placeholder_id]").last().removeAttr('disabled');
                if(parent.find('.btn-placeholder').last().parent().find('.btn-placeholder').length == 1){
                    parent.find('.btn-placeholder').last().parent().append(`<a class="form-control btn-placeholder"><i class="fa fa-plus"></i></a>`);
                }

                if($("[name=placeholder_id]").length == 1){
                    parent.find('.btn-placeholder').last().parent().find('.btn-placeholder i.fa-minus').parent().remove();
                }
            }else{
                $(this).parents('.form-inline').remove();
                if($('#appendHere').find('.btn-placeholder').last().parent().find('.btn-placeholder').length == 1){
                    $('#appendHere').find('.btn-placeholder').last().parent().append(`<a class="form-control btn-placeholder"><i class="fa fa-plus"></i></a>`);
                }

                if($("[name^=placeholder_name]").length == 1){
                    $('#appendHere').find('.btn-placeholder').last().parent().find('.btn-placeholder i.fa-minus').parent().remove();
                }
            }
        }
    });
    $(document).on('click', '.btn-ntplaceholder', function () {
        if($(this).find('i').hasClass('fa-plus')){
            parent = $(this).parents('div.pholderForm');
            if(parent.attr('id') == "f1"){
                if($("[name=newT_placeholder_id]").last().find('option').length - 1){
                    var selectOptions = '';
                    $("[name=newT_placeholder_id]").last().find('option').each(function(index, element) {
                        if($('[name=newT_placeholder_id]').last().val() != $(element).val()){
                            selectOptions += `<option value="${$(element).val()}">${$(element).text()}</option>`;
                        }
                    });
                    $('.GenerateForm .appendGenerateHere').append(`<div class="form-inline justify-content-center">
                                        <select class="form-control" name="newT_placeholder_id">
                                            ${selectOptions}
                                        </select>
                                        <input class="form-control" type="text" name="newT_placeholder_value[]" placeholder="Type Here">
                                        <a class="form-control btn-ntplaceholder"><i class="fa fa-minus"></i></a>
                                        <a class="form-control btn-ntplaceholder"><i class="fa fa-plus"></i></a>
                                    </div>`);
                    $(this).siblings('select').attr('disabled', 'disabled');
                    if($(this).parent().find('.fa-minus').length){
                        $(this).remove();
                    }else{
                        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                    }
                }else{
                    alert('No more placeholder available.');
                    $(this).siblings('select').attr('disabled', 'disabled');
                    if($(this).parent().find('.fa-minus').length){
                        $(this).remove();
                    }else{
                        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                    }
                }
            }else{
                $('.GenerateForm .appendOtherPh').append(`<div class="form-inline justify-content-center">
                                    <input class="form-control" type="text" name="ntPlaceholder_name" placeholder="Name of the Placeholder">
                                    <input class="form-control" type="text" name="ntPlaceholder_format" placeholder="%Example%">
                                    <a class="form-control btn-ntplaceholder"><i class="fa fa-minus"></i></a>
                                    <a class="form-control btn-ntplaceholder"><i class="fa fa-plus"></i></a>
                                </div>`);
                if($(this).parent().find('.fa-minus').length){
                    $(this).remove();
                }else{
                    $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                }
            }
        }else{
            parent = $(this).parents('div.pholderForm');
            if(parent.attr('id') == "f1"){
                var selectedOption = $(this).siblings('select');
                $("[name=newT_placeholder_id]").last().append(`<option value="${selectedOption.val()}">${selectedOption.find('option:selected').text()}</option>`);
                $(this).parents('.form-inline').remove();
                $("[name=newT_placeholder_id]").last().removeAttr('disabled');
                if(parent.find('.btn-ntplaceholder').last().parent().find('.btn-ntplaceholder').length == 1){
                    parent.find('.btn-ntplaceholder').last().parent().append(`<a class="form-control btn-ntplaceholder"><i class="fa fa-plus"></i></a>`);
                }
                if($("[name=newT_placeholder_id]").length == 1){
                    parent.find('.btn-ntplaceholder').last().parent().find('.btn-ntplaceholder i.fa-minus').parent().remove();
                }
            }else{
                $(this).parents('.form-inline').remove();
                if($('.GenerateForm .appendOtherPh').find('.btn-ntplaceholder').last().parent().find('.btn-ntplaceholder').length == 1){
                    $('.GenerateForm .appendOtherPh').find('.btn-ntplaceholder').last().parent().append(`<a class="form-control btn-ntplaceholder"><i class="fa fa-plus"></i></a>`);
                }
                if($("[name=ntPlaceholder_name]").length == 1){
                    $('.GenerateForm .appendOtherPh').find('.btn-ntplaceholder').last().parent().find('.btn-ntplaceholder i.fa-minus').parent().remove();
                }
            }
        }
    });
    $(document).on('keyup', '[name=profile_url]', function() {
        clearTimeout(timer);
        elem = $(this);
        timer = setTimeout(function() {
            if(elem.val()){
                $('.CopyBtnHolder').show();
            }else{
                $('.CopyBtnHolder').hide();
            }
        }, 700);
    });
    $(document).on('change', '[name=custom_placeholder]', function () {
        console.log($(this).is(':checked'));
        if($(this).is(':checked')){
            $('.GenerateForm .pholderForm').last().slideDown(500, function(){
                $('html, body').animate({
                    scrollTop: $('.GenerateForm .pholderForm').last().offset().top - $('header').outerHeight()
                }, 500);
            });
        }else{
            $('.GenerateForm .pholderForm').last().slideUp();
        }
    });
    $(document).on('click', '#btn-custom-placeholder', function () {
        setTimeout(function(){
            if($('[name=custom_placeholder]').is(':checked')){
                $('.phForm').last().slideDown(500, function(){
                    $('html, body').animate({
                        scrollTop: $('.phForm').last().offset().top - $('header').outerHeight()
                    }, 500);
                });
            }else{
                $('.phForm').last().slideUp();
            }
        }, 200);
    });
    $(document).on('click', '.item-theme', function () {
        $('.item-theme').removeClass('active');
        $(this).addClass('active');
        $(this).find('[name=template]').prop('checked', true);
    });
    $(document).on('click', '.switch', function (e) {
        if($(this).hasClass('pro')){
            e.preventDefault();
        }
    });
    $(document).on('click', '#btnCopy', function (e) {
        e.preventDefault();
        var urlInput = $(this).parents('.profile-form').find('[name=profile_url]');
        var textToCopy = urlInput.data('domain')+'/'+urlInput.val();
        copyToClipboard(textToCopy);
        $(this).text('Copied');
    });
    $(document).on('click','.pageURLcopy',function(e){
        e.preventDefault();
        text = $('.urlHere').val();
        copyToClipboard(text);
        $(this).text('Copied');
    });
    $(document).on('click','.copyOnTable',function(e){
        e.preventDefault();
        var text = $(this).data('url');
        var textToCopy = location.host+'/'+text;
        copyToClipboard(textToCopy);
        $(this).text('copied');
    });
    $(document).on('click', '.btn-remadd', function () {
        if ($(this).text() == '+') {
            if($("[name=social_provider]").last().find('option').length - 1){
                var selectOptions;
                $("[name=social_provider]").last().find('option').each(function(index, element) {
                    if($('[name=social_provider]').last().val() != $(element).val()){
                        selectOptions += `<option value="${$(element).val()}">${$(element).val()}</option>`;
                    }
                });
                $('#appendSocial').append(`<div class="form-inline">
                                                <select name="social_provider" class="form-control">
                                                    ${selectOptions}
                                                </select>
                                                <input type="text" class="form-control fullname" placeholder="example.com" name="social_url[]">
                                                <a class="btn-remadd fc">-</a>
                                                <a class="btn-remadd">+</a>
                                            </div>`);
                $(this).siblings('select').attr('disabled', 'disabled');
                if($(this).siblings('.fc').length){
                    $(this).remove();
                }else{
                    $(this).text('-').addClass('fc');
                }
            }else{
                alert('No more social media platform.');
                $(this).siblings('select').attr('disabled', 'disabled');
                if($(this).siblings('.fc').length){
                    $(this).remove();
                }else{
                    $(this).text('-').addClass('fc');
                }
            }
        }else{
            var selectedOption = $(this).siblings('select').val();
            $("[name=social_provider]").last().append(`<option value="${selectedOption}">${selectedOption}</option>`);
            $(this).parents('.form-inline').remove();
            $("[name=social_provider]").last().removeAttr('disabled');
            if($('.btn-remadd').last().parent().find('.btn-remadd').length == 1){
                $('.btn-remadd').last().parent().append(`<a class="btn-remadd">+</a>`);
            }
            if($("[name=social_provider]").length == 1){
                $('a.fc').last().remove();
            }
        }
    });
    $(document).on('click','.oneAfback2', function(e){
        e.preventDefault();
        $('#1a .editTemplateTab').empty();
        $('#1a .editTemplateTab').css('display', 'none');
        $('#1a .firstPage').css('display','block');
    });
    $(document).on('click','.oneAsback', function(e){
        e.preventDefault();
        location.reload();
    });
    $(document).on('click','.deleteGen', function(e){
        e.preventDefault();
        $id = $(this).data('genid');
        Swal.fire({
            type: 'warning',
            title: 'Delete This URL?',
            showCancelButton: true,
            text: 'This URL will be gone forever?',
        }).then(function (result) {
            if(result.value){
                $.ajax({
                    type: "post",
                    url: "{{route('pageTemplate.deleteGenPage')}}",
                    data: {id : $id},
                    success: function (data) {
                        if(data.result == 'success'){
                            Swal.fire({
                                type: 'success',
                                title: 'Good Job!',
                                text: 'The URL has been deleted',
                            }).then(function (result) {
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                        }
                    },
                });
            }
        });
    });
    $(document).on('click','.deletePageTemplate', function(e){
        e.preventDefault();
        $id = $(this).data('id');
        Swal.fire({
            type: 'warning',
            title: 'Delete This Page?',
            showCancelButton: true,
            text: 'All URLs and its Statistics will also be deleted!',
        }).then(function (result) {
            if(result.value){
                $.ajax({
                    type: "post",
                    url: "{{route('pageTemplate.deletePage')}}",
                    data: {id : $id},
                    success: function (data) {
                        if(data.result == 'success'){
                            Swal.fire({
                                type: 'success',
                                title: 'Good Job!',
                                text: 'The page has been deleted',
                            }).then(function (result) {
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                        }
                    },
                });
            }
        });
    });
    $(document).on('click','.oneAfback', function(e){
        e.preventDefault();
        if($(this).data('page') == 2){
            location.reload();
        }else if($(this).data('page') == 3){
            $(this).parents('.oneApages').css('display', 'none');
            $('#1a .secondPage').css('display','block');
        }else if($(this).data('page') == 4){
            $(this).parents('.oneApages').css('display', 'none');
            $('#1a .thirdPage').css('display','block');
        }else{
        }
    });
    $(document).on('click','.pagesStep', function(e){
        e.preventDefault();
        $input1 = $('.secondPage [name="templateName"]').val();
        $input2 = $('.secondPage [name="templateTag"]').val();
        $input3 = $('.secondPage [name="fullName"]').val();
        id = $(this).data('pageid');
        urlid = $(this).data('urlid');
        generate = $(this).data('generate');
        pageid = $('[name=pageTemplateid]').val();
        step = $(this).data('step');
            $.ajax({
                type: "get",
                url: "{{route('pageTemplate.getForm')}}",
                data: {id : id, step:step, pageid : pageid, generate:generate, urlid:urlid},
                success: function (data) {
                    console.log(data.step);
                    if(data.step == 1 ){
                        $('#1a .oneApages').css('display', 'none');
                        $("#1a .secondPage").empty();
                        $('#1a .secondPage').append(data.html);
                        $('#1a .secondPage').css('display','block');
                        CKEDITOR.replaceAll('editEditor');
                    }else if((data.step == 2) && ($input1!='' && $input2!='' && $input3!='') || ((data.generate == true) && (data.step == 2))){
                        $('#1a .oneApages').css('display', 'none');
                        $("#1a .thirdPage").empty();
                        $('#1a .thirdPage').append(data.html);
                        $('#1a .thirdPage').css('display','block');
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Some fields are blank',
                            text: 'Please fill up all the blank fields.',
                        });
                    }
                },
            });
    });
    $(document).on('click','.saveNext2',function(e) {
        e.preventDefault();
        $input1 = $('.secondPage [name="upTemplateName"]').val();
        $input2 = $('.secondPage [name="upTemplateTag"]').val();
        $input3 = $('.secondPage [name="upFullName"]').val();
        if($input1!='' && $input2!='' && $input3!=''){;
        }else{
            Swal.fire({
                type: 'error',
                title: 'Some fields are blank',
                text: 'Please fill up all the blank fields.',
            }).then(function (result) {
                if (result.value) {
                }
            });
        }
    });
    $(document).on('click','.statsView', function(e){
        e.preventDefault();
        id = $(this).data('pageid');
        $.ajax({
            type: "get",
            url: "{{route('pageTemplate.getStatsModal')}}",
            data: {pageid : id},
            success: function (data) {
                if(data.result == 'success'){
                    $("#appendUrlModal").empty();
                    $('#appendUrlModal').append(data.html);
                    $('.DataTableID').DataTable();
                    $('#statsModal').modal('show');
                }else{
                    Swal.fire({
                        type: data.result,
                        title: data.title,
                        text: data.message,
                    });
                }
            },
        });
    });
    $("[name=image]").change(function () {
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageUpload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function copyToClipboard(text) {
        var $temp = $("<input>");
        $("body").append($temp);
        toInput = $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
@stop
