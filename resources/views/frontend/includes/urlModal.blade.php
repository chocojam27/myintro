<table class="table table-striped DataTableID" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>URL</th>
            <th>Clicks</th>
            <th>Views</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($generatedURLs)
            @foreach ($generatedURLs as $url)
            <tr>
                <td>{{$url->name}}</td>
                <td>{{$url->clicks??''?$url->clicks->count():'0'}}</td>
                <td>{{$url->views??''?$url->views->count():'0'}}</td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a target="_blank" class="btn btn-primary pagesStep" data-urlid="{{$url->id}}" data-step="2" href="#" title="Edit Placeholders" data-dismiss="modal">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a target="_blank" class="btn btn-primary" href="{{route('inner.page',['id' => $profile->url, 'innerId' => $url->url])}}" title="View">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="copyOnTable btn btn-primary" data-url="{{$profile->url.'/'.$url->url}}" href="#" title="Copy to Clipboard">
                                <i class="fa fa-clipboard" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-danger deleteGen" data-genid="{{$url->id}}"  href="#" title="Delete">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
