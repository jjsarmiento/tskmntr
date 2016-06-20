@extends('layouts.usermain')

@section('title')
    Proveek | Dashboard
@stop

@section('head-content')
{{ $calculated_prog = $intProgress + $reqProgress}}
{{ $total_prog = $calculated_prog + $optProgress }}
<style>
    #progressbar {
        background-color: #f6f6f6;
        border-radius: 13px; /* (height of inner div) / 2 + padding */
        padding: 3px;
        border:1px solid #2980b9;
        display:flex;
    }
        
    #progressbar > #prog-meter-req {
        background-color: #2980b9;
        animation-name: reqProgress;
        animation-duration: 3s;
        height: 20px;
        border-radius: 10px;
        max-width: 70%;
        width:{{ $calculated_prog }}%;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    #progressbar > #prog-meter-opt {
        background-color: orange;
        animation-name: optProgress;
        animation-duration: 3s;
        height: 20px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        max-width: 30%;
        width:{{ $optProgress }}%;
    }

    @keyframes reqProgress {
    from {width:0%;}
    to {width:{{ $calculated_prog }}%;}
    }

    @keyframes optProgress {
    from {width:0%;}
    to {width:{{ $optProgress }}%;}
    }

    body{background-color:#E9EAED;}
    .accordion-toggle
    {
        text-decoration: none !important; 
    }

    h5 {
        margin: 0;
    }
    .thumbnail {
        border: 1px solid #BDC3C7;
        border-radius: 0.3em;
        cursor: pointer;
        position: relative;
        width: 80px;
        height: 80px;
        overflow: hidden;
        /*float: left;*/
        margin-left: 20px;
        margin-top: 15px;
        margin-right: 1em;
        margin-bottom: 0em;
        /*-moz-box-shadow:    3px 3px 5px 6px #ccc;*/
        /*-webkit-box-shadow: 3px 3px 5px 6px #ccc;*/
        /*box-shadow: 0 8px 6px -6px black;*/
    }

    .thumbnail img {
        display: inline;
        position: absolute;
        left: 50%;
        top: 50%;
        height: 100%;
        width: auto;
        /*-webkit-transform: translate(-50%,-50%);*/
        /*-ms-transform: translate(-50%,-50%);*/
        transform: translate(-50%,-50%);
    }
    .thumbnail img.portrait {
        width: 100%;
        height: auto;
    }
    .link-btn
    {
        border:1px solid #2980b9;
        border-radius: 4px;
        background-color: white;
        color: #2980b9 !important;
    }

    .link-btn:hover
    {
        background-color:#2980b9;
        color:white !important;
    }
    .hrLine
    {
        background:#ccc;
        max-width:100%;
        border:none;
        height:1px;
        max-height:1px;
    }
</style>

@stop


@section('content')
<section>
    <div class="container main-content lato-text">
        <!-- Statistics -->
        <div class="row">
<!-- PROFILE PIC / INFO  -->
            <div class="col-lg-4"> 
                <div class="widget-container" style="display:flex; min-height:125px; display:block !important;">
                    <div class="col-lg-3 no-padding" style="">
                        <div class="thumbnail">
                            @if(Auth::user()->profilePic)
                                <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                            @else
                                <a href="/editProfile"><img src="/images/default_profile_pic.png" class="portrait"/></a><br>
                            @endif
                        </div>
                            
                    </div>
                    <div class="col-lg-9 padded">
                        <div class="heading">
                            <a href="/editProfile" style="font-weight:bold; font-size:14pt;">{{ Auth::user()->fullName }}</a><br>
                        </div>
                    </div>
                    <div class="col-lg-12" style="padding-left:24px;">
                        <a href="/editProfile">Edit Profile</a>
                    </div>
                </div>
                <br>
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="widget-container" style="min-height:25px; border:1px solid #e6e6e6">
                                    <div class="widget-content">
                                        <div class="padded" style="color:#2980b9; font-size:14pt;">
                                            <i class="glyphicon glyphicon-search"></i>&nbspSearch
                                        </div>
                                    </div>
                                </div>
                                <div class="panel filter-categories">
                                    <div class="panel-body">
                                        <!-- <input name="searchWord" id="searchWord" type="text" class="form-control input-trans" placeholder="Search for workers" required> -->
                                        <div class="col-lg-12">
                                            <button name="searchBtn" id="searchBtn" class="lato-text btn btn-default btn-trans" style="text-transform: none; border:1px solid #2980b9; width:100%; border-radius: 4px;" type="button">Click here to search for jobs</button>
                                        </div>
                                        <!-- <div class="btn-group" data-toggle="buttons" style="width:100%;">
                                            <input value="<?php if(@$searchWord != 0){ echo($searchWord); } ?>" type="text" name="searchWord" id="searchWord" class="form-control" placeholder="Enter keyword" />
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- ENF PROFILE PIC / INFO -->

<!-- MAIN CONTENT STATISTICS / AVAILABLE JOBS -->
            <div class="col-lg-8">
                <div class="col-lg-12">
                    <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                        <div class="widget-content">
                            <div class="padded" style="color:#2980b9; font-size:18pt;">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : {{ number_format($total_prog) }}%
                            </div>
                        </div>
                    </div>
                </div>
<!-- PROFILE OOMPLETENESS METER -->
                <div class="col-lg-12">
                    <div class="widget-container" style="min-height:30px; border-bottom:1px solid #e6e6e6">
                        <div class="widget-content">
                            <div class="padded text-center" style="color:#2980b9; font-size:18pt;">
                                <div id="progressbar">
                                    <div id="prog-meter-req"></div>
                                    <div id="prog-meter-opt"></div>
                                </div>
                                <div style="text-align:left; font-size:12pt; display:flex;">
                                    <div style="width:20%;">0%</div>
                                    <div style="width:20%;">20%</div>
                                    <div style="width:20%; text-align:center;">50%</div>
                                    <div style="width:20%; text-align:right;">80%</div>
                                    <div style="width:20%; text-align:right;">100%</div>
                                </div>
                                <span style="font-size:10pt;">Please complete your profile to be able to apply for jobs.</span>
                            </div>
                        </div>
                    </div>
                </div>
<!-- END OF PROFILE  COMPLETENESS METER -->
                <div class="col-lg-12">
                    <div class="widget-container stats-container" style="display:block !important;">
                        <div class="col-lg-3 lato-text">
                            <a href="/tskmntr_taskBids" style="text-decoration:none;">
                                <div class="number" style="color:#2980b9;">
                                    <i class="fa fa-gavel"></i>
                                    {{ $bidCount }}
                                </div>
                                <div class="text" style="color:#2980b9;">
                                    Bids
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 lato-text">
                            <a href="/tskmntr_taskOffers" style="text-decoration:none;">
                                <div class="number" style="color:#2980b9;">
                                    <i class="fa fa-globe"></i>
                                    {{ $offerCount }}
                                </div>
                                <div class="text" style="color:#2980b9;">
                                    Offers
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 lato-text">
                            <a href="/tskmntr_onGoing" style="text-decoration:none;">
                                <div class="number" style="color:#2980b9;">
                                    <i class="fa fa-refresh"></i>
                                    {{ $ongoingCount }}
                                </div>
                                <div class="text" style="color:#2980b9;">
                                    On going
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 lato-text">
                            <a href="/tskmntr_completed" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-check"></i>
                                {{ $completedCount }}
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Completed
                            </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <!-- <div class="widget-container fluid-height" style="border-top:1px solid #e6e6e6">
                                <div class="widget-content padded">
                                    @if(Auth::user()->status == 'PRE_ACTIVATED')
                                        @if(Document::where('user_id', Auth::user()->id)->count() != 0 && Photo::where('user_id', Auth::user()->id)->count() != 0)
                                            <div class="heading">
                                                <i class="icon-bar-chart"></i>Your profile is being reviewed by our staff.
                                            </div>
                                            <div class="widget-content clearfix" style="padding: 0px 30px;">
                                                After your profile has been activated, you can start looking for tasks!<br/>
                                                This could take 24 hours or less.
                                            </div>
                                        @else
                                            <div class="heading">
                                                <i class="icon-bar-chart"></i>You're one step closer to taking jobs!
                                            </div>
                                            <div class="widget-content clearfix" style="padding: 0px 30px;">
                                                You just need to upload:
                                                <ul>
                                                <li>1 old document with complete name and address (i.e Transcript of record, birth certificate, etc. Accepted files are .doc, .pdf and .docx); and, </li>
                                                <li>at least 2 (Two) Key Skills Certification (Accepts .jpg, .png and .jpeg file extensions only)</li>
                                                </ul>
                                                Just click <a href="/editProfile">here!</a>
                                            </div>
                                        @endif
                                    @else
                                        <div class="heading">
                                            <i class="icon-bar-chart"></i>You can now search for tasks!
                                        </div>
                                        <div class="widget-content clearfix" style="padding: 0px 30px;">
                                            <a href="/tskmntr/taskSearch" class="btn link-btn">Search for a task</a><br/>
                                        </div>
                                    @endif
                                </div>
                            </div> -->
                            <div class="col-lg-12 padded" style="padding-top: 25px;">
                                <div class="col-lg-5"><hr class="hrLine"></div>
                                <div class="col-lg-2" style="margin-top:10px;"><p style="font-size:10pt;">Available Jobs</p></div>
                                <div class="col-lg-5"><hr class="hrLine"></div>
                            </div>

                            <br><br><br><br>

<!-- TEMPLATE -->
                            <!-- <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".5s" data-wow-offset="0" data-wow-delay="0" style="padding-left:10px; padding-right:10px; min-height: 50px;">
                                <div style="display:flex;padding-bottom:5px; border-bottom:1px solid #e6e6e6">
                                    <span style="padding:0;margin:0; flex:1">
                                        <img src="frontend/img/team/00.jpg" class="thumbnail" style="margin:0; width:64px; height:64px;" >
                                    </span>
                                    <div style="flex:11; padding-left: 5px;">
                                        <h3 class="lato-text" style="margin:0 !important; color:#2980b9">[Task Name Here]</h3>
                                        <span style="padding:0;margin:0; color:#ccc;">
                                            [Company Name]
                                        </span><br>
                                        <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                                            [Time]
                                        </span>
                                    </div>
                                </div>
                                <p class="lato-text no-padding">
                                    [Description]
                                </p>           
                            </div>
                            <br> -->

                            <!-- <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".5s" data-wow-offset="0" data-wow-delay="0" style="padding-left:10px; padding-right:10px; min-height: 50px;">
                                <div style="display:flex;padding-bottom:5px; border-bottom:1px solid #e6e6e6">
                                    <span style="padding:0;margin:0; flex:1">
                                        <img src="frontend/img/team/00.jpg" class="thumbnail" style="margin:0; width:64px; height:64px;" >
                                    </span>
                                    <div style="flex:11; padding-left: 5px;">
                                        <h3 class="lato-text" style="margin:0 !important; color:#2980b9">
                                            Nature Photographer
                                        </h3>
                                        <span style="padding:0;margin:0; color:#ccc;">
                                            Proveek Dev Team
                                        </span><br>
                                        <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                                            1 hr
                                        </span>
                                    </div>
                                </div>
                                <p class="lato-text no-padding">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi perspiciatis totam amet maxime aliquam, natus, neque, dolore quisquam similique a minima enim quia blanditiis doloremque eaque! A ab suscipit provident! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, autem cupiditate quos officiis ab tempore consequuntur, ex laborum odio recusandae libero inventore repellat aliquam, optio fugit, vero molestiae iusto illo.
                                </p>           
                            </div>
                            <br> -->
<!-- END TEMPLATE -->

<!-- LOOP HERE -->
                            <?php $counter = 0; ?>
                            @foreach(array_chunk($tasks->getCollection()->all(), 1) as $task)
                                @foreach($task as $item)
                                    <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".5s" data-wow-offset="0" data-wow-delay="0" style="padding-left:10px; padding-right:10px; min-height: 50px;">
                                        <div style="display:flex;padding-bottom:5px; border-bottom:1px solid #e6e6e6">
                                            <span style="padding:0;margin:0; flex:1">
                                                @foreach(User::where('id', $item->user_id)->get() as $user)
                                                    <img src="{{ $user->profilePic }}" class="thumbnail" style="margin:0; width:64px; height:64px;" >
                                                @endforeach
                                            </span>
                                            <div style="flex:11; padding-left: 5px;">
                                            <a href="/bid{{$item->workTime}}/{{ $item->id }}" style="text-decoration:none;">
                                                <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                                    {{ $item->name }}
                                                </h3>
                                                <span style="padding:0;margin:0; color:#ccc;">
                                                    @foreach(User::where('id', $item->user_id)->get() as $user)
                                                        {{ $user->companyName }}
                                                    @endforeach
                                                </span><br>
                                                <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                                                    {{ date('m/d/y', $item->created_at->getTimeStamp()) }}
                                                </span>
                                                </a>
                                            </div>
                                        </div>
                                        <p class="lato-text no-padding">
                                            {{ $item->description }}
                                        </p>           
                                    </div>
                                    <br>
                                    <?php $counter++;?>
                                @endforeach
                            @endforeach
                            {{ $tasks->links() }}
<!-- END LOOP -->
                        </div>
                    </div>
                </div>
            </div>
<!-- END MAIN CONTENT -->
        </div>
    </div>
</section>

<!-- FOOTER -->
    <section id="footer" class="divFooterDark" style="padding-top:40px; padding-bottom:60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-8 text-center">
                        <div class="col-lg-4">
                            <div class="col-lg-12 text-left div_footer">
                                <h2>Proveek</h2>
                                <ul style="padding-left:0">
                                    <li><a href="#page-top" class="page-scroll">Home</a></li>
                                    <li>{{ HTML::link('/howitworks', 'How It Works')}}</li>
                                    <li>  {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}</li>
                                    <li>  {{ HTML::link('/pricing', 'Pricing')}}</li>
                                   <li><a href="#">FAQ</a></li>
                                    <li>    {{ HTML::link('/login', 'Login / Sign Up')}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 text-left feedback_footer">
                            <h2>Contact Us</h2>
                            <p>We love to hear from you. Please drop us a message.</p>
                            <div class="col-lg-12" style="padding:0;">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="col-lg-12" style="padding:15px 0 0 0 ;">
                                <input type="email" placeholder="Email">
                            </div>
                            <div class="col-lg-12" style="padding:15px 0 0 0 ;">
                                <input type="text" placeholder="Message">
                            </div>
                            <div class="col-lg-12 text-right" style="padding:15px 0 0 0 ;">
                                <button type="button" class="btn btn-primary btn-md" style="width: 120px;border-radius: 4px;">Send</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                         <div class="col-lg-12 text-center div_footer">
                            <h2>Find Us On</h2>
                            <hr class="primary">
                            <p>
                                Stay connected to keep up with the latest news, promos and updates.
                            </p>
                            <div class="div_footer">
                                <a href="https://www.facebook.com/proveek"><i class="fa fa-facebook-square fa-3x wow bounceIn" data-wow-delay=".2s"></i></a>
                                <a href="https://twitter.com/Proveek"><i class="fa fa-twitter-square fa-3x wow bounceIn" data-wow-delay=".3s"></i></a>
                                <a href="#"><i class="fa fa-instagram fa-3x wow bounceIn" data-wow-delay=".4s"></i></a>
                                <a href="https://plus.google.com/108796854139900682022/posts"><i class="fa fa-google-plus-square fa-3x wow bounceIn" data-wow-delay=".5s"></i></a>
                                <a href="#"><i class="fa fa-envelope-square fa-3x wow bounceIn" data-wow-delay=".6s"></i></a>
                            </div>
                            <p>2015  <i class="fa fa-copyright"></i>  Proveek Inc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- END OF FOOTER -->
@stop

@section('body-scripts')
<script>
    $(document).ready(function(){
        $('#uploadProfilePicForm').submit(function(){
            $('#uploadBtn').empty().append('Uploading..');

        });

        

        $('#searchBtn').click(function(){
                var workingTime = 'PTIME',
                    searchField = 'name',
                    searchCity  = '175301',
                    searchWord  = '0',
                    rateRange   = '0',
                    rangeValue  = '0';

                if($('#searchWord').val() != ''){
                    searchWord = $('#searchWord').val();
                }

                location.href = '/tskmntr/doTaskSearch='+workingTime+'='+searchField+'='+searchCity+'='+searchWord+'='+rateRange+'='+rangeValue;
            });

        
    })
</script>
@stop