@extends('layouts.tib')



@section('content')
<div style="position:absolute; top:52px; z-index:-1">
    <div style="width:100%">
    {{--<div class="pagecontainer"><img src="{{URL::to('/')}}/images/On-Line Accounting-small.jpg" ></div>--}}
       <div style="z-index:-5; overflow-y:scroll; height: 100%; background-size:cover;
                                                                                                       background-attachment:fixed;  background-image:url('/images/pexels-photo-97079.jpeg');">     <div class="skip">&nbsp;</div>

            <div class="skip">&nbsp;</div>
            <div class="trans row">
            <div class="col-md-8 col-md-offset-2">
                <div style="width:100%;">
                    <div class="kinetic600">
                        Returns Policy
                    </div>
                </div>
                <div style="width:100%;" class="panel panel-default display">
                    <div class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-md-12 ">
                        This is an extraction of Section 6.0 of the General Policies and Procedures Manual.
                        </div>
                         <div class="form-group col-md-12 ">
                        6.0 SATISFACTION GUARANTEED AND RETURN OF SALES AIDS
                        </div>
                        <div class="form-group col-md-12 ">
                         <ol type="A">
                           <li>The TIB Foundation offers a one hundred percent (100%) thirty-day money back guarantee for all non customized products.</li>
                           <li>With respect to return of Sales Aids, The TIB Foundation  offers refund opportunities depending on the product or service purchased.
                           Shipping and handling incurred will not be refunded.</li>
                           <li>Customized products (such as business cards) may only be returned if the customized information (name, address, etc) is other than as ordered. </li>
                           <li>The TIB Foundation offers a one hundred percent (100%) thirty-day money back guarantee for membership in the TIB Foundation.
                        <div class="form-group col-md-12 ">
                        6.1 Return Process
                        </div>
                       <div class="form-group col-md-12 ">
                            <ol type="A">
                              <li>All returns, whether by a Customer, or Member, must be made as follows:
                                    <ol type="i">
                                        <li>Obtain Return Merchandise Authorization from The TIB Foundation;</li>
                                        <li>Ship items to the address provided to The TIB Foundation Customer service when order was placed</li>
                                        <li>A copy of the orinal invoice is returned with the returned products or service. Such invoice must reference the RMA and include the reason for the return.</li>
                                        <li>Ship back product in manufacturer’s box exactly as was delivered.</li>
                                    </ol></li>
                                <li>All returns must be shipped to The TIB Foundation pre-paid, as The TIB Foundation does not accept shipping collect packages. The Gold Diggers Association recommends shipping
                                returned products by UPS or FedEx with tracking and insurance as risk of loss or damage in shipping of the returned product shall be borne solely
                                by the Customer, or Member. If returned product is not received at The TIB Foundation's Distribution Center, it is the responsibility of the Customer,
                                or Member to trace the shipment and no credit will be applied.</li>
                                <li>The return of $500 or more of products for a refund within a calendar year, by a Member, may constitute grounds for involuntary termination.</li>
                  </ol>

                        </div>
                         <div class="form-group col-md-12 ">
                         </div>

                         <div class="form-group col-md-12 ">
                         </div>
                </div>
            </div>
            <div class="skip">&nbsp;</div>
              <div class="skip">&nbsp;</div>
              <div class="skip">&nbsp;</div>
              <div class="skip">&nbsp;</div>
              <div class="skip">&nbsp;</div>
        </div>
    </div>
</div>
</div>
@endsection