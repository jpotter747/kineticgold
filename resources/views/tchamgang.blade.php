@extends('layouts.tchamgang')


@section('content')
<div style="position:absolute; top:52px; z-index:-1; width:600">


        <table width="600" height="750" border="1">
            <tr>


                <td width="300px" height="375" style="vertical-align: top;">
                <img id="img1" src="../images/fchamgang 1.jpeg" width="300" height="375"  />
                </td>


                 <td width="300px" height="375" style="vertical-align: top;">
                  <img id="img2" src="../images/fchamgang 2.jpeg" width="300" height="375" />

                 </td>

            </tr>

             <tr>


                <td width="300px" height="375" style="vertical-align: top;">
                <img id="img3" src="../images/fchamgang 3.jpeg" width="300" height="375"  />
                </td>


                 <td width="300px" height="375" style="vertical-align: top;">
                  <img id="img4" src="../images/fchamgang 4.jpeg" width="300" height="375" />

                 </td>


            </tr>
        </table>



</div>
<div style="border:red 1px solid; position:absolute; left: 600px; top:52px; z-index:-1; width:800px; height:750px">

</div>

<script>
var imageno = Math.floor(Math.random() * (4+1));
var imagesrc = 'img'+imageno;
document.getElementById(imagesrc).src = "../images/fchamgang 5.jpeg"
</script>
@endsection