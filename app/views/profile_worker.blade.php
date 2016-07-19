@extends('layouts.usermain')

@section('title')
    @if($CLIENTFLAG && $roles == 'TASKMINATOR')
        @if($PURCHASED == 0)
            {{substr_replace($users->firstName, str_repeat('*', strlen($users->firstName)-1), 1)}}
            &nbsp;
            {{substr_replace($users->lastName, str_repeat('*', strlen($users->lastName)-1), 1)}} | Profile Page
        @else
            {{ $users->fullName }} | Profile Page
        @endif
    @else
        {{ $users->fullName }} | Profile Page
    @endif
@stop

@section('content')
    <!-- HEADER SEARCH SECTION -->
    <header style="min-height:70%;">
        <div class="vegas.overlay" style="width:100%; height:100%; background-color:rgba(0,0,0,.7);">
            <div class="header-content">
                <div class="header-content-inner wow fadeIn text-center" data-wow-delay="2s" > <!--style="background-color:rgba(0,0,0,.5); padding-top: 35px; padding-bottom:15px; border-radius: 8px;" -->
                    @if($users->profilePic)
                        <img class="userProfile" src="{{$users->profilePic}}" />
                    @else
                        <img class="userProfile" src="/images/default_profile_pic.png" />
                    @endif
                    <!-- <img class="userProfile" src="frontend/img/team/01.png"/> -->
                    <h2 class="lato-text">
                        @if($roles == 'TASKMINATOR')
                            @if($CLIENTFLAG)
                                @if($PURCHASED == 0)
                                    {{substr_replace($users->firstName, str_repeat('*', strlen($users->firstName)-1), 1)}}
                                    &nbsp;
                                    {{substr_replace($users->lastName, str_repeat('*', strlen($users->lastName)-1), 1)}}
                                @else
                                    {{ $users->fullName }}
                                @endif
                            @else
                                {{ $users->fullName }}
                            @endif
                        @elseif ( $roles == 'CLIENT_INDI' || $roles == 'CLIENT_CMP')
                            {{ $users->companyName }}
                        @else
                            {{ $users->fullName }}
                        @endif
                    </h2>
                    <p style="margin:auto;" class="btn btn-primary lato-text">
                        @if ( $roles == 'TASKMINATOR')
                            {{ $users->skills }}
                        @elseif ( $roles == 'CLIENT_INDI' || $roles == 'CLIENT_CMP')
                            {{ $users->businessNature }}
                        @elseif ( $roles == 'ADMIN')
                             Administrator
                        @endif
                    </p>
                    <br/>
                    <br/>
                    @if($roles == 'TASKMINATOR')
                        @if($CLIENTFLAG)
                            @if(User::IS_BOOKMARKED(Auth::user()->id, $users->id))
                                <a href="/REMOVE_BOOKMARK:{{BookmarkUser::where('worker_id', $users->id)->where('company_id', Auth::user()->id)->pluck('id')}}"><i class="BOOKMARK_USER fa fa-bookmark" style="color: #2ECC71; font-size: 2em;"></i></a>
                            @else
                                <a href="/ADD_BOOKMARK:{{$users->id}}"><i class="BOOKMARK_USER fa fa-bookmark-o" style="color: #2ECC71; font-size: 2em;"></i></a>
                            @endif
                        @endif
                    @endif
                    <!-- <div class="text-center div_header">
                    <a href="#next" class="page-scroll">
                        <i class="fa fa-4x fa-angle-down"></i>
                    </a>
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <!-- END OF -->

<!-- DESCRIPTION -->
    <section id="next" style="border-bottom:1px solid #222; padding-top:40px;">
        <div class="container">
            <div class="row">
                @if($roles == 'TASKMINATOR' || $roles == 'ADMIN')
                    <div class="col-lg-8 text-center">
                        <i class="fa fa-4x fa-info-circle text-primary"></i>
                        <h2 class="section-heading">Information</h2>
                        <hr class="hrLine">
                        <div class="col-lg-12 lato-text" style="font-size:14pt; text-align: left;">
                            <div style="padding-left: 30px;" style="display:table;">
                                @if($CLIENTFLAG && $roles == 'TASKMINATOR')
                                    @if($PURCHASED > 0)
                                        <div style="display:table-row;">
                                            <span style="display:table-cell;text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">First Name</span>
                                            <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                            <span style="display:table-cell;">{{ $users->firstName }}</span>
                                        </div>
                                        <div style="display:table-row;">
                                            <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Middle Name</span>
                                            <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                            <span style="display:table-cell">{{ $users->midName }}</span>
                                        </div>
                                        <div style="display:table-row;">
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Last Name</span>
                                            <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                            <span style="display:table-cell">{{ $users->lastName }}</span>
                                        </div>
                                    @endif
                                @else
                                    <div style="display:table-row;">
                                        <span style="display:table-cell;text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">First Name</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                        <span style="display:table-cell;">{{ $users->firstName }}</span>
                                    </div>
                                    <div style="display:table-row;">
                                        <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Middle Name</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                        <span style="display:table-cell">{{ $users->midName }}</span>
                                    </div>
                                    <div style="display:table-row;">
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Last Name</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                        <span style="display:table-cell">{{ $users->lastName }}</span>
                                    </div>
                                @endif

                                <div style="display:table-row;">
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">City</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ City::where('citycode', $users->city)->pluck('cityname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Barangay</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ Barangay::where('bgycode', $users->barangay)->pluck('bgyname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Gender</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;"> : </span>
                                    <span style="display:table-cell">{{ $users->gender }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ( $roles == 'CLIENT_INDI' || $roles == 'CLIENT_CMP')
                        <div class="col-lg-8 text-center lato-text" style="word-wrap: break-word;">
                            <i class="fa fa-4x fa-info-circle text-primary" aria-hidden="true"></i>
                            <h2 class="section-heading">About Us</h2>
                            <hr class="hrLine">
                            <p style="font-size: 14pt;">
                                {{ $users->businessDescription}}
                            </p>
                        </div>
                    @endif

                <div class="col-lg-4 text-center lato-text">
                    <i class="fa fa-4x fa-phone text-primary"></i>
                    <h2 class="section-heading">Contact Info</h2>
                    <hr class="hrLine">

                    @if($CLIENTFLAG && $roles == 'TASKMINATOR')
                        @if($USERINCART > 0)
                                <a href="#" data-target="#CARTMODAL" data-toggle="modal" class="SHWCRT btn btn-lg btn-danger btn-block" style="border-radius: 0.3em;">Added to Cart</a>
                        @elseif($PURCHASED > 0)
                            <div class="list-group" style="text-align:left;">
                                <p class="list-group-item"><i class="fa fa-phone fa-fw"></i>&nbsp; {{ $mobile  }}</p>
                                <a class="list-group-item" href="#"><i class="fa fa-facebook-square fa-fw"></i>&nbsp; Facebook</a>
                                <a class="list-group-item" href="#"><i class="fa fa-twitter-square fa-fw"></i>&nbsp; Twitter</a>
                                <a class="list-group-item" href="#"><i class="fa fa-instagram fa-fw"></i>&nbsp; Instagram</a>
                            </div>
                        @else
                            <a href="/addToCart={{$users->id}}" class="btn btn-warning btn-lg btn-block" style="border-radius: 0.3em;"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</a>
                        @endif
                    @else
                        <div class="list-group" style="text-align:left;">
                            <p class="list-group-item"><i class="fa fa-phone fa-fw"></i>&nbsp; {{ $mobile  }}</p>
                            <a class="list-group-item" href="#"><i class="fa fa-facebook-square fa-fw"></i>&nbsp; Facebook</a>
                            <a class="list-group-item" href="#"><i class="fa fa-twitter-square fa-fw"></i>&nbsp; Twitter</a>
                            <a class="list-group-item" href="#"><i class="fa fa-instagram fa-fw"></i>&nbsp; Instagram</a>
                        </div>
                    @endif
                </div>
                
                @if ( $roles == 'TASKMINATOR')
                    <div class="col-lg-12 text-center">
                        <i class="fa fa-4x fa-star text-primary" aria-hidden="true"></i>
                        <h2 class="section-heading">Skills</h2>
                        <hr class="hrLine">
                        <div class="col-12-lg lato-text" style="text-align: left;">
                            @foreach(User::getSkills($users->id) as $skill)
                                <span style="border:2px solid white; padding:8px; background-color: #2980b9; display:inline-block; color: #f9f9f9; border-radius: 0.2em; font-size: 12pt;">{{ $skill->itemname }}</span>
                            @endforeach
                            @foreach(User::GET_CUSTOM_SKILLS($users->id) as $skill)
                                <span style="border:2px solid white; padding:8px; background-color: #2980b9; display:inline-block; color: #f9f9f9; border-radius: 0.2em; font-size: 12pt;">{{ $skill->skill }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif



<!-- ABOUT US DIV -->
<!--                 <div class="col-lg-12 text-center">
                    <i class="fa fa-4x fa-info-circle text-primary"></i>
                    <h2 class="section-heading">About Us</h2>
                    <hr style="border:none; max-height:1px; background:none; border-bottom:1px solid #2980b9">
                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div> -->

<!-- OFFERED JOBS -->
<!--                 <div class="col-lg-6 text-center">
                    <i class="fa fa-4x fa-flag text-primary"></i>
                    <h2 class="section-heading">Offered Jobs</h2>
                    <hr style="border:none; max-height:1px; background:none; border-bottom:1px solid #2980b9">
                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div> -->

<!-- CONTACT -->
                <!-- <div class="col-lg-6 text-center">
                    <i class="fa fa-4x fa-phone text-primary"></i>
                    <h2 class="section-heading">Contact Info</h2>
                    <hr style="border:none; max-height:1px; background:none; border-bottom:1px solid #2980b9">
                    <div class="list-group" style="text-align:left;">
                        <p class="list-group-item"><i class="fa fa-phone fa-fw"></i>&nbsp; +(63) 949-554-8249</p>
                        <a class="list-group-item" href="#"><i class="fa fa-facebook-square fa-fw"></i>&nbsp; Facebook</a>
                        <a class="list-group-item" href="#"><i class="fa fa-twitter-square fa-fw"></i>&nbsp; Twitter</a>
                        <a class="list-group-item" href="#"><i class="fa fa-instagram fa-fw"></i>&nbsp; Instagram</a>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
<!-- END OF -->
<!-- All scripts and plugin should be placed here so the page can load -->

@stop

@section('body-scripts')
<!-- FOR HEADER SLIDER -->
    <script>
        $('header').vegas({
          overlay: true,
          preload: true,
          preloadImage: true,
          transition: 'fade', 
          transitionDuration: 4000,
          delay: 10000,
          animation: 'random',
          shuffle: true,
          timer:false,
          animationDuration: 20000,
          slides: [
            { src: 'frontend/img/slideshow/10.jpg' }
            //{ src: 'frontend/img/slideshow/03.jpg' },
            //{ src: 'frontend/img/slideshow/05.jpg' },
            //{ src: 'frontend/img/slideshow/07.jpg' },
            //{ src: 'frontend/img/slideshow/02.jpg' },
            //{ src: 'frontend/img/slideshow/04.jpg' },
            //{ src: 'frontend/img/slideshow/06.jpg' }
          ]
        });
    </script>
    {{ HTML::script('frontend/js/creative.js') }}
<!-- END OF HEADER SLIDER -->
@stop