@extends('layouts.usermain')

@section('title')
    {{$users->username}}
@stop

@section('content')
    <!-- HEADER SEARCH SECTION -->
    <header style="min-height:70%;">
        <div class="vegas.overlay" style="width:100%; height:100%; background-color:rgba(0,0,0,.7);">
            <div class="header-content">
                <div class="header-content-inner wow fadeIn text-center" data-wow-delay="0s" > <!--style="background-color:rgba(0,0,0,.5); padding-top: 35px; padding-bottom:15px; border-radius: 8px;" -->
                    @if($users->profilePic)
                        <img class="userProfile" src="{{$users->profilePic}}" />
                    @else
                        <img class="userProfile" src="/images/default_profile_pic.png" />
                    @endif
                    @if($roles == 'TASKMINATOR')
                        @if($CLIENTFLAG)
                            @if(User::IS_BOOKMARKED(Auth::user()->id, $users->id))
                                <a href="/REMOVE_BOOKMARK:{{BookmarkUser::where('worker_id', $users->id)->where('company_id', Auth::user()->id)->pluck('id')}}"><i class="BOOKMARK_USER fa fa-bookmark" style="color: #2ECC71; font-size: 2em;"></i></a>
                            @else
                                <a href="/ADD_BOOKMARK:{{$users->id}}"><i class="BOOKMARK_USER fa fa-bookmark-o" style="color: #2ECC71; font-size: 2em;"></i></a>
                            @endif

                            @if(BaseController::IS_PURCHASED(Auth::user()->id, $users->id))
                                &nbsp;&nbsp;&nbsp;
                                <a href="#" data-toggle="modal" data-target="#INVITEMULTIJOB"><i class="fa fa-envelope" style="color: #F1C40F; font-size: 2em;"></i></a>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </header>
    <!-- END OF -->

<!-- DESCRIPTION -->
    <section id="next" style="border-bottom:1px solid #222; padding-top:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <i class="fa fa-4x fa-info-circle text-primary"></i>
                    <h2 class="section-heading">Information</h2>
                    <hr class="hrLine">
                    <div class="col-lg-12 lato-text" style="font-size:14pt; text-align: left;">
                        <div style="padding-left: 30px;" style="display:table;">

                            <div style="display:table-row;">
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Region</span>
                                <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                <span style="display:table-cell">{{ Region::where('regcode', $users->region)->pluck('regname') }}</span>
                            </div>

                            <div style="display:table-row;">
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Province</span>
                                <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                <span style="display:table-cell">{{ Province::where('provcode', $users->province)->pluck('provname') }}</span>
                            </div>

                            <div style="display:table-row;">
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">City / Municipality</span>
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
            </div>
        </div>
    </section>

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