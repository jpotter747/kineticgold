@extends('...layouts.video')



@section('content')
<div style="left: 30px; border: 0px none; height: 450px; position: fixed; width: 600px; overflow: hidden; top: 67px;">
    <div style="overflow: hidden;">
    </div>
    <iframe id="video_iframe" width="600" height="450" src="" frameborder="1" allowfullscreen></iframe>
    </div>
    </div>

<div style="position:absolute; top:52px; z-index:-1">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-6">
            <div class="panel panel-default display">
                <div class="panel-heading">Links for Biogas - click to view</div>
                <div class="panel-body">
                     <div class="form-group col-md-12 " onclick="updateyoutube('LJXuqNVxaDg')">
                        Sintex Floating Type Bio Gas Plant
                    </div>
                    <div class="form-group col-md-12 " onclick="updateyoutube('xoJTlhfjpXQ')">
                        Compact Biogas Plant
                    </div>
                    <div class="form-group col-md-12 " onclick="updateyoutube('Qp39KDlkGp4')">
                        How to Install a Small Sized Biogas Plan
                    </div>
                    <div class="form-group col-md-12 " onclick="updateyoutube('cNqB3yNRxJ4')">
                        A small 7kw biogas plant to produce electricity, heat and biomethane
                    </div>
                    <div class="form-group col-md-12 " onclick="updateyoutube('O0fVbQy_1KA')">
                        National Bio Gas, 7500 watts power generation, tubewell & fertilizer
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>







@stop