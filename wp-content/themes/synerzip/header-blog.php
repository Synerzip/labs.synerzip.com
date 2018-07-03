<?php 
	global $post;
	if(is_search())
	{
$title='search result';
	}
	else{
	$class='blog';
$title=$post->post_title;
}	
	?>
	
<!DOCTYPE HTML>
<html lang="en" class="no-js">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php wp_title('&raquo;',true,'right'); ?></title>
  <!--        /<link href="<?php //bloginfo('template_url'); ?>/beta_css/style.css" type="text/css" rel="stylesheet" />-->
<link href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" rel="stylesheet" />
  <link href="<?php bloginfo('template_url'); ?>/beta_css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="<?php bloginfo('template_url'); ?>/beta_css/font-awesome.min.css" type="text/css" rel="stylesheet" />
  <!-- Latest compiled and minified Bootstrap CSS
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->

  
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/beta_css/component.css" />
  
  <!-- Latest compiled and minified JavaScript
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
-->
	<script src="<?php bloginfo('template_url'); ?>/beta_js/jquery-2.1.3.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/beta_js/bootstrap.min.js"></script>

	  
  <script src="<?php bloginfo('template_url'); ?>/beta_js/main.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/beta_js/modernizr.custom.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet" lazyload>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112921641-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-112921641-1');
</script>

</head>
    
  
   <body class='<?php echo $class;?>'>

        <div id="more-menu" class="overlay">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/"><img src="<?php bloginfo('template_url'); ?>/beta_images/header-black-logo.png" title="Synerzip" alt="Synerzip" width="190" /></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right actions">
                        <li><a href="#" class="search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="close-nav"><i class="fa fa-times" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </nav>
            <div class="overlay-content">
		<div class="container">
                <ul class="setbar navigation-links">
                    <li id="offerings" class="offerings"><a href="/offering" title="Our Offerings">Our Offerings</a></li>
                    <li id="technologies" class="technologies"><a href="/technology" title="Technologies">Technologies</a></li>
                    <li id="values" class="values"><a href="/values" title="Our Values">Our Values</a></li>
                     <li id="webinars" class="webinars"><a href="/webinars" title="Webinars">Webinars</a></li>
                    <li id="practices" class="practices"><a href="/practices" title="Best Practices">Best Practices</a></li>
                </ul>
                <ul class="navigation-links">
                    <li class="team-pg"><a href="/team" title="Our Team">Our Team</a></li>
                    <li class="career-pg"><a href="/career" title="Career">Careers</a></li>
                  <li class="stories"><a href="/success-stories" title="Success Stories">Success Stories</a></li>
                    <li class="blog-pg"><a href="/blogs" title="Blog">Blog</a></li>
                    <li class="contact-pg"><a href="/contact" title="Contact">Contact</a></li>
                </ul>
		</div>
            </div>
        </div>

        <div id="search-panel" class="overlay">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/"><img src="<?php bloginfo('template_url'); ?>/beta_images/header-white-logo.png" title="Synerzip" alt="Synerzip" width="190" /></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right actions">
                        <li><a href="#" class="close-search-panel"><i class="fa fa-times" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </nav>
            <div class="search-content">
                <div class="container">
                    <div class="input-group input-group-lg">
                        <form role="search" method="get" id="site_search" action="/">
                            <div class="input-group input-group-lg"> 
                                <input name="s" id="s" class="form-control" aria-describedby="search" type="text">
                                <span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
        




        <section class="f-fix header-wrapper">
            <nav class="navbar navbar-default <?php echo $navColor;?>">
                <div class="container">
                    <nav>
						<div class="container-fluid" style="float:right;">
					    	<form class="navbar-form navbar-left hide-on-mobile"  action="<?php echo get_option('home'); ?>/" role="search" method="get" id="site_search" >
					      		<div class="input-group search-content">
					        		<input name="s" id="s" type="text" class="form-control" placeholder="Search">
					       				<div class="input-group-btn">
					          				<button class="btn btn-default-search " type="submit">
					            			<i class="fa fa-search" aria-hidden="true"></i>
					         				</button>
					        			</div>
					      		 </div>
					   		</form>
							<ul class="nav navbar-nav hide-on-mobile">
				  				<li><a href="/contact">Contact Us</a></li>
							</ul>
				  		</div>
					</nav>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="/" class="navbar-brand"><img src="<?php bloginfo('template_url'); ?>/beta_images/header-white-logo.png" title="Synerzip" alt="Synerzip" width="190" /></a>
                    </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="setbar nav navbar-nav navbar-right">
                             <li class="show-on-mobile" >
                                <form class="navbar-form navbar-left "  style="border-color:transparent;" action="/"  role="search" method="get" id="site_search" >
					      		<div class="input-group search-content" style="margin-left: 11%;">
					        		<input name="s" id="s" type="text" class="form-control" placeholder="Search" >
					       				<div class="input-group-btn">
					          				<button class="btn btn-default-search " type="submit">
					            			<i class="fa fa-search" aria-hidden="true"></i>
					         				</button>
					        			</div>
					      		 </div>
					   		</form>
                            </li>
                            <li class="stories">
                                <figure class="active-menu no-display" data-percent="100">
                                    <svg width="15" height="55">
                                    <line class="line" x1="6" y1="0" x2="6" y2="45" stroke-width="2px" />
                                    <circle class="circle" cx="141" cy="6" r="2.5" transform="rotate(-90, 95, 95)"/>
                                    </svg>
                                </figure>
                                <a href="/success-stories" title="Clients/Success Stories">Stories</a> 
                            </li>
                            <li id="technologies" class="technologies">
                                <a href="/technology" title="Technologies">Technologies</a> 
                            </li>
                            <li id="practices" class="practices">
                                <a href="/practices" title="Practices">Practices</a> 
                            </li>
                              <li class="dropdown team-pg">
	                       		<a href="/team" data-toggle="dropdown" class="dropdown-toggle disabled">Team<b class="caret"></b></a>
		                       		<ul class="dropdown-menu">
		                           		<li><a href="/values">Value</a></li>
		                           </ul>
                    		</li>
                       		<li class="dropdown">
	                       		<a href="#" data-toggle="dropdown" class="dropdown-toggle">Insight<b class="caret"></b></a>
		                       		<ul class="dropdown-menu">
		                           		<li><a href="/webinars">Webinars</a></li>
		                           		<li><a href="/blogs">Blogs</a></li>
		                           		<li><a href="/blogs">Events</a></li>
		                           		<li><a href="#">News</a></li>
		                            </ul>
                    		</li>
                       		<li  class="career-pg">
                                <figure class="active-menu no-display" data-percent="100">
                                    <svg width="15" height="55">
                                    <line class="line" x1="6" y1="0" x2="6" y2="45" stroke-width="2px" />
                                    <circle class="circle" cx="141" cy="6" r="2.5" transform="rotate(-90, 95, 95)"/>
                                    </svg>
                                </figure>
                                <a href="/career" title="Careers">Careers</a>
							</li>
                          	<li class="show-on-mobile" >
                                <a href="#"  title="Contact" >Contact Us</a> 
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>
<style>
.search-content .form-control {
    background: transparent;
    border: 0;
    border-bottom: 1px solid black;
    border-bottom-left-radius: 1px;
    color: black;
    box-shadow: none;
}

.btn-default-search {
    color: black;
    background-color: transparent;
    border-color: transparent;
}
.search-content .form-control:focus{
    box-shadow:none;
    border-color:transparent;
    border-bottom:1px solid black;
}
.form-control{
		display: block;
	    width: 100%;
	    height: 25px;
	    padding: 6px 12px;
	    font-size: 14px;
	    line-height: 1.42857143;
	    color: #555;
	    background-color: #fff;
	    background-image: none;
	    border-radius: 0px;
	    border: 1px solid #ccc;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
	    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
</style>

        <!--header section end-->
   
