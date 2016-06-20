@extends('layouts.usermain')

@section('head')
	search
@stop

@section('head-content')
	<style type="text/css">
		body{ background-color:#f9f9f9; }
	</style>
@stop

@section('content')
<!-- <header style="min-height: 15%;">

</header> -->
<section>
    <div class="container lato-text">
    	<div class="row">
			<?php $counter=0;?>
			<div class="col-xs-12 wow fadeInUp" data-wow-delay=".4s" style="border-bottom:1px solid #ccc;"></div>
			@foreach ($users as $user)
		    <article class="col-xs-12 wow fadeInUp" data-wow-delay=".{{ $counter }}s" data-wow-duration="1s" style="padding:8px 8px 8px 8px; background-color:white; border-bottom: 1px solid #ccc; border-left: 1px solid #ccc; border-right: 1px solid #ccc;" >
		    	<div style="display:flex;">
		    		<div style="display:inline-block;">
			    		<aside style="padding:0;">
			    			@if($user->profilePic)
			    				<a style="font-size: 14pt;" href="{{ url('/')."/".$user->username }}">
			    					<img style="width:100px; height:100px;" src="{{$user->profilePic}}" />
			    				</a>
		                    @else
		                    	<a style="font-size: 14pt;" href="{{ url('/')."/".$user->username }}">
		                        	<img style="width:100px; height:100px;" src="/images/default_profile_pic.png" />
		                        </a>
		                    @endif
			    		</aside>
		    		</div>
		    		<div style="display:inline-block; padding-left: 10px;">
			    		<a style="font-size: 14pt;" href="{{ url('/')."/".$user->username }}">{{ $user->fullName }}</a>
						<div>{{ $user->gender }}</div>
						<div>{{ $user->country }}</div>
						<div>{{ $user->skills }}</div>
			    	</div>
			    </div>
			</article>
			<?php $counter++;?>
			@endforeach
		</div>
	</div>
</section>
@stop

@section('body-scripts')
<!-- 	<script type="text/javascript">
		$(document).ready(function(){
			$('#mainNav').addClass('affix').removeClass('affix-top');
		});
	</script> -->
@stop