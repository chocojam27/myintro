<div class="row mB-40">
        <div class="col-sm-8">
            <div class="bgc-white p-20 bd">
                {{-- @dd(\Carbon\Carbon::parse(strtotime('PROFILESTARTDATE'))->format('F d, Y')); --}}
                {!! Form::myInput('text', 'PROFILEID', 'Profile ID:' ,array('disabled')) !!}
                {!! Form::myInput('text', 'SUBSCRIBERNAME', 'Subscriber Name:' ,array('disabled')) !!}
                {!! Form::myInput('text', 'OUTSTANDINGBALANCE', 'Balance:' ,array('disabled')) !!}
                {!! Form::myInput('text', 'BILLINGPERIOD', 'Billing Period:' ,array('disabled')) !!}
                {!! Form::myInput('text', 'TOTALBILLINGCYCLES', 'Number of Billing Cycles Finished:' ,array('disabled')) !!}
                {!! Form::myInput('text', 'AMT', 'Amount:' ,array('disabled')) !!}
                {!! Form::myInput('text', 'PROFILESTARTDATE' , 'Profile Start Date:' , array('disabled')) !!}
                {!! Form::myInput('text', 'LASTPAYMENTDATE', 'Last Payment Date:' , array('disabled')) !!}
                {!! Form::myInput('text', 'NEXTBILLINGDATE', 'Next Billng Date:' , array('disabled')) !!}
            </div>
        </div>
    </div>
