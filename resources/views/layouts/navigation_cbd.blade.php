
    <div class="navcontainer4" >
        {{--<div class="navbar-brand brand-image">--}}
             {{--<a href="{{URL::to('/')}}"><sp class="tibSm">TCHAMGANG</sp></a>--}}
        {{--</div>--}}

        <div style="padding:15px;">
            <ul>

                <li><a href="{{URL::to('/')}}/shop">Shop<span class="caret"></span></a>
                    <ul>
                        <li><a href="{{URL::to('/')}}/Gummies">Gummies</a></li>
                        <li><a href="{{URL::to('/')}}/HempOil">Hemp Oil</a></li>
                        <li><a href="{{URL::to('/')}}/capsules">Capsules</a></li>
                        <li><a href="{{URL::to('/')}}/topical">Topical</a></li>
                        <li><a href="{{URL::to('/')}}/vape">Vapes</a></li>
                        <li><a href="{{URL::to('/')}}/Balms">Balms</a></li>
                        <li><a href="{{URL::to('/')}}/skincare">Skin Care</a></li>
                        <li><a href="{{URL::to('/')}}/cbdoils">CBD Oils</a></li>
                        <li><a href="{{URL::to('/')}}/papin">Pain Treatment</a></li>
                        <li><a href="{{URL::to('/')}}/edibles">Edibles</a></li>
                    </ul>

                </li>

            </ul>

            <ul class="pull-right">
                <li><a href="{{URL::to('/')}}/about4">About</a></li>


                @if ($user_name == '' or $user_name == null )
                    @if($username == '')
                        <li><a href="{{URL::to('/')}}/login4">Login</a></li>
                    @else
                        <li><a href="#">{{$username}}<span class="caret"></span></a>
                           <ul>
                               <l1><a href="{{URL::to('/')}}/logout4">Logout</a></l1>
                           </ul>
                        </li>
                    @endif
                @else

                    <li><a href="{{URL::to('/')}}/homepage4/{{$user_id}}">{{$user_name}}<span class="caret"></span></a>

                        <ul>
                            <li><a href="{{URL::to('/')}}/homepage4/{{$user_id}}">Personal Info</a></li>
                            <li><a href="{{URL::to('/')}}/organization4">Organization</a></li>
                            <li><a href="{{URL::to('/')}}/myaccounting4">Accounting</a></li>
                            <li><a href="{{URL::to('/')}}/logout4">Logout</a></li>
                            @if($userRoles[6]=='yes')
                                <li><a href="{{URL::to('/')}}/cbd/admin/financial">Finance</a></li>
                            @endif
                            @if($userRoles[5]=='yes')
                                <li><a href="{{URL::to('/')}}/cbd/admin/management">User Management</a></li>
                                <li><a href="{{URL::to('/')}}/cbd/admin/products">Product Management</a></li>
                            @endif
                            @if($userRoles[7]=='yes')
                                <li><a href="{{URL::to('/')}}/cbd/admin/config">Config</a></li>
                            @endif
                            @if($userRoles[10]=='yes')
                                <li><a href="{{URL::to('/')}}/cbd/admin/gensales">General Sales</a></li>
                            @endif

                        </ul>
                    </li>
                @endif
            </ul>

        </div>

    </div>