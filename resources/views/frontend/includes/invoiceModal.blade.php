<table class="table table-striped DataTableID" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Title</th>
                <th>Profile ID</th>
                <th>Start Date</th>
                <th>Cancell Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($invoice)
                @foreach ($invoice as $datas)
                <tr>
                    <td>{{$datas->transaction_id}}</td>
                    <td>{{$datas->title}}</td>
                    <td>{{$datas->recurring_id}}</td>
                    <td>{{$datas->created_at}}</td>
                    <td>{{$datas->cancelled_date}}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a target="_blank" class="btn btn-primary checkPpalRec" data-id="{{$datas->recurring_id}}" href="#" title="View More Details" data-dismiss="modal">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
