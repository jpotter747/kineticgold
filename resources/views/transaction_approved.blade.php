@extends('layouts.default')

@section('content')
<div style="position:absolute; top:52px; z-index:-1">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Thank You</div>
                <div class="panel-body">
						<div class="row">
							<div class="form-group col-md-10">
								 <label class="">Your order was completed successfully. We’ll get started on your order right away.</label>
							</div>
                        </div>
                        <div class="clearfix clear"></div>
                        <div class="row">
							<div class="form-group col-md-10">
								 <label class="">Oder no. : {{$transaction}}</label>
							</div>
                        </div>
                        <div class="row">
							<div class="form-group col-md-10">
								 <label class="">Order Price : ${{$grand_total}}</label>
							</div>
                        </div>
                        <div class="row">
							<div class="form-group col-md-10">
								 <label class="">Transaction ID : {{$transaction_number}}</label>
							</div>
                        </div>
                       
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
