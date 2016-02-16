@extends('layouts.default')


@section('content')
<div style="position:absolute; top:52px; z-index:-1">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default display">
                <div class="panel-heading">Requirements for Referral Bonuses</div>
                <div class="panel-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <div class="form-group col-md-12 ">
                            There are two types of registration statuses for clients of Eco-nomix.  Registered and Member.
                         </div>
                         <div class="form-group col-md-12 ">
                            Both types are eligible to earn bonuses by referring clients to Eco-nomix.  However, to receive the bonuses, you must be a member and have received the Eco-nomix debit card.
                         </div>
                         <div class="form-group col-md-12 ">
                               what do you have to do to receive a referral bonus.
                         </div>
                         <div class="form-group col-md-12 ">
                                <ul>
                                    <li>Refer someone - that's the first step</li>
                                    <li>Someone within 5 generations of your referrals makes a purchase.</li>
                                    <l1>After all purchases are what drive all the bonuses.</l1>
                                </ul>

                         </div>

                         <div class="form-group col-md-12 ">
                                Now lets see what you don't have to do.
                         </div>
                         <div class="form-group col-md-12 ">
                               <ul>
                                    <li>No minimum personal sales requirements</li>
                                    <li>No direct selling of products - all sales are done through the site</li>
                                    <li>No collecting of money</li>
                                    <li>No required marketing meetings</li>
                                    <li>No minimum number in your organization to 'qualify'</li>
                                    <li>No stocking of inventory</li>
                                    <li>No purchasing of product you don't want or need</li>
                                    <li>No confusing Marketing plan</li>
                                    <li>No waiting for the check that is in the mail</li>
                                    <li>No Hidden Fees</li>
                                    <li>No hard sell - hand out a business card, let the site do the work for you</li>
                               </ul>
                         </div>


                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection