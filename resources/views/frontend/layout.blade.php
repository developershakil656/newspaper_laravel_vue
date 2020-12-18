<!DOCTYPE html>
<html lang="en">
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/app2.css') }}" rel="stylesheet" type="text/css"/>

<!-- <style> 
        [v-cloak] { 
            display: none; 
        } 
    </style>  -->
</head>

<body >

<div id="homeContent">

<myheader></myheader>




<div
      style="
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.78);
            position: fixed;
            top: 0;
            z-index: 3;
      "
      v-if="isLoading"
    >
      <loader class="loader"></loader>
    </div>

    <router-view></router-view>



<div class="col-md-12 bottom">
    	<div class="col-md-4">
        	<h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">About Us</span></h3>
            <img src="{{asset('assets/frontend')}}/images/book.png" align="left" /><span class="name"><font color="#e03521">COLOR</font><font color="#fff">MAG</font></span>
            <p align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="col-md-4">
        	<div class="col-md-12">
            	<h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Quick Links</span></h3>
            </div>    
            <div class="col-md-6">
            	<div class="row">
              	<ul class="nav">
    				<li><a href="#">POLITICS</a></li>
    				<li><a href="#">BUSINESS</a></li>
    				<li><a href="#">ENTERTAINMENT</a></li>
    				<li><a href="#">TECHNOLOGY</a></li>
        		</ul> 
                </div>
            </div>
            <div class="col-md-6">
            	<div class="row">
              	<ul class="nav">
    				<li><a href="#">SPORTS</a></li>
    				<li><a href="#">TRAVEL</a></li>
    				<li><a href="#">STYLE</a></li>
    				<li><a href="#">HEALTH</a></li>
        		</ul> 
                </div>
            </div>    
        </div>
        <div class="col-md-4">
        	<h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Contact Us</span></h3>
            <span class="name"><font color="#e03521">COLOR</font><font color="#fff">MAG</font></span><br />
            Follow us at:<br /><br />
            <a href="#"><img src="{{asset('assets/frontend')}}/images/icon-fb.png" /></a>
    		<a href="#"><img src="{{asset('assets/frontend')}}/images/icon-twitter.png" /></a>
    		<a href="#"><img src="{{asset('assets/frontend')}}/images/icon-google.png" /></a>
    		<a href="#"><img src="{{asset('assets/frontend')}}/images/icon-insta.png" /></a>
    		<a href="#"><img src="{{asset('assets/frontend')}}/images/icon-pin.png" /></a>
    		<a href="#"><img src="{{asset('assets/frontend')}}/images/icon-youtube.png" /></a><br />
            <a href="#top" class="btn btn-default goto"><span class="glyphicon glyphicon-arrow-up"></span></a><br />
        </div>
</div>

<div class="col-md-12 text-center copyright">
	Copyright &copy; 2016 <a href="#">COLORMAG</a> Powered by: <a href="#">DREAMTEAM</a>
</div>
</div>

<script src="{{asset('js/app2.js')}}"></script>
<script src="{{asset('js/all.js')}}"></script>
<script>
	jQuery(document).ready(function() {
		// slick slider call 
    $('.slick_slider').slick({
        dots: true,
        infinite: true,
        speed: 800,
        slidesToShow: 1,
        slide: 'div',
        autoplay: true,
        autoplaySpeed: 5000,
        cssEase: 'linear'
    });
	})
</script>

</body>
</html>
