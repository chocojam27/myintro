<input type="text" name="pageTemplateid" hidden value="{{$pageTemplateDetails->id??''}}">
{{-- @dd($pageTemplateDetails??''); --}}
<div class="formHolder">
    <div class="templateForm">
        <div class="text-center" id="template">
            <h2>{{$pageTemplateDetails->page_template_name??''?'Edit Page':'Create New Page'}}</h2>
        </div>
        <input class="form-control" type="text" name="templateName" placeholder="Name of Template" value="{{$pageTemplateDetails->page_template_name??''}}">
        <input class="form-control" type="text" name="templateTag" placeholder="Tag" value="{{$pageTemplateDetails->tag??''}}">
        <input class="form-control" type="text" name="fullName" placeholder="Full Name" value="{{$pageTemplateDetails->full_name??''}}">
    </div>
    <textarea class="form-control editEditor" name="mainContent" id="" cols="30" rows="10">
        {{$pageTemplateDetails??''?$pageTemplateDetails->main_content:'Place Your Contents Here'}}
    </textarea>
    <div id="phList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="phModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="phModalLongTitle">Placeholders:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped " width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name of Placeholder</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ntplaceholders as $placeholder)
                            <tr>
                                <td>{{$placeholder->format}}</td>
                                <td>{{$placeholder->description}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="btnHolder">
        <a class="btnPink oneAfback" data-page="2" href="#">Back</a>
        <a href="#" class="btnPink" data-toggle="modal" data-target="#phList">Placeholders</a>
        <input type="submit" class="btnPink" value="Save" style="cursor:pointer">
        <a href='#' class="saveGenerate pagesStep" data-step="2">Save and Generate URL</a>
    </div>
</div>
