@extends('layouts.default')




@section('content')
<div style="position:absolute; top:52px; z-index:-1">
    <div style="width:100%">
    {{--<div class="pagecontainer"><img src="{{URL::to('/')}}/images/On-Line Accounting-small.jpg" ></div>--}}
        <div style="z-index:-5; overflow-y:scroll; height: 100%; background-size:cover; background-attachment:fixed;  background-image:url('/images/denmark.jpeg');">
            <div class="skip">&nbsp;</div>
            <div class="trans row">
            <div class="col-md-8 col-md-offset-2">
                <div style="width:100%;">
                    <div class="kinetic600">
                        Auto-Ship Policy
                    </div>
                </div>
                <div class="panel panel-default display">
                    <div class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-md-12 ">
                            Kinetic Gold does not sell products that have an Auto-Ship Option.
                        </div>


                        <div class="form-group col-md-12 ">
                          </div>
                         <div class="form-group col-md-12 ">
                            Put your referral link in your email, ads, or notices.
                         </div>
                         <div class="form-group col-md-12 ">
                             Obviously, your organizations size alone will not create any income for you.  All Profit Sharing is earned
                             from deposits that are made,  so encourage your down-line to know what works to spread the word, and to discover
                             how they can be utilized.
                          </div>
                         <div class="form-group col-md-12 ">
                             Remember that a great many people are highly motivated to become self-sufficient.  As these perilous times further unfold, more and more people will want to become such.
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
                <div class="skip">&nbsp;</div>
                <div class="skip">&nbsp;</div>
                <div class="skip">&nbsp;</div>
                <div class="skip">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
@endsection