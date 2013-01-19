<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Sweet Dreams - Dashboard</title>

<!-- http://www.scriptgates.com - more free script -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/css/jquery-ui-1.8.16.custom.css" media="screen"  />
    <link rel="stylesheet" href="/css/fullcalendar.css" media="screen"  />
    <link rel="stylesheet" href="/css/chosen.css" media="screen"  />
    <link rel="stylesheet" href="/css/datepicker.css" >
    <link rel="stylesheet" href="/css/colorpicker.css">
    <link rel="stylesheet" href="/css/glisse.css?1.css">
    <link rel="stylesheet" href="/css/jquery.jgrowl.css">
    <link rel="stylesheet" href="/js/elfinder/css/elfinder.css" media="screen" />
    <link rel="stylesheet" href="/css/jquery.tagsinput.css" />
    <link rel="stylesheet" href="/css/demo_table.css" >
    <link rel="stylesheet" href="/css/jquery.jscrollpane.css" >
    <link rel="stylesheet" href="/css/validationEngine.jquery.css">
    <link rel="stylesheet" href="/css/jquery.stepy.css" />
    
	<link rel="stylesheet" href="/css/icon/font-awesome.css">
    <link rel="stylesheet" href="/css/bootstrap-responsive.css">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lte IE 8]><script type="text/javascript" src="/js/excanvas.min.js"></script><![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/images/icons/favicon.ico">

    
  </head>

  <body>

<!-- http://themeforest.net/user/dimka_ua_kh/portfolio -->
<!--Header Start-->
	<div class="header" >
    		
           <a href="dashboard.html" class="logo"><h1>SWEET DREAMS</h1></a>
           
           <div class="pull-right">
           
           <!--Notifications Start-->  
           <div class="notifications-head">
           
           <!--Messages Start-->
           <div class="btn-group m_left hide-mobile" >
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
    	     	<span class="notification">531</span><span class="triangle-1"></span><i class="icon-comments"></i><span class="caret"></span>
            </a>
            <div class="dropdown-menu">
            
              <span class="triangle-2"></span>
              <div class="ichat">
               <div class="ichat-messages">
               	<div class="ichat-title">
                  <div class="pull-left">New Messages</div>
                  <div class="pull-right"><span>Update 4*</span></div>
                  <div class="clear"></div>
                </div>
                
                <div class="imessage">
                  <div class="iavatar"><img src="images/users/1.jpg" alt=""></div>
                  <div class="imes">
                  	<div class="iauthor">Alan Cook</div>
                    <div class="itext">All right. Thank you.</div>
                  </div>
                  <div class="idelete"><a href="#"><span><i class="icon-remove"></i></span></a></div>
                  <div class="clear"></div>
                </div>
                <div class="imessage">
                  <div class="iavatar"><img src="images/users/6.jpg" alt=""></div>
                  <div class="imes">
                  	<div class="iauthor">Emma Clark</div>
                    <div class="itext">Will you pay by credit card?</div>
                  </div>
                  <div class="idelete"><a href="#"><span><i class="icon-remove"></i></span></a></div>
                  <div class="clear"></div>
                </div>
                <div class="imessage">
                  <div class="iavatar"><img src="images/users/2.jpg" alt=""></div>
                  <div class="imes">
                  	<div class="iauthor">Blake Washington</div>
                    <div class="itext">Can I help you?</div>
                  </div>
                  <div class="idelete"><a href="#"><span><i class="icon-remove"></i></span></a></div>
                  <div class="clear"></div>
                </div>
                
                <div class="ichat-link"><a href="#">InBox</a> <a href="#">OutBox</a> <a href="#">Spam</a> <a href="#">Trash</a>
                <div class="clear"></div>
                </div>
                
                </div>
                <a href="#" class="iview">View all</a><a href="#" class="imark">Mark all read</a>
               
              </div>
            
            </div>
          </div>
          <!--Messages END--> 
          
          <!--Recent Activity Start-->
           <div class="btn-group pull-left hide-mobile" >
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
    	     	<span class="notification">77</span><span class="triangle-1"></span><i class="icon-bell"></i><span class="caret"></span>
            </a>
            <div class="dropdown-menu">
            
              <span class="triangle-2"></span>
              <div class="ichat">
               <div class="ichat-messages">
               	<div class="ichat-title">
                  <div class="pull-left">Recent Activity</div>
                  <div class="pull-right"><span>Update 14*</span></div>
                  <div class="clear"></div>
                </div>
                
                <div class="r_activity">
                <div class="imessage">
                  <div class="r_icon"><a href="#"><i class="icon-camera"></i></a></div>
                  <div class="r_info">
                  	<div class="r_name"><strong>Alan Cook</strong> a new photo</div>
                    <div class="r_text"><i class="icon-time"></i> 3 hours ago</div>
                    <div class="r_link"><a href="#">View...</a></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="imessage">
                  <div class="r_icon"><a href="#"><i class="icon-thumbs-up"></i></a></div>
                  <div class="r_info">
                  	<div class="r_name"><strong>Isaac Donaldson</strong> like: BMW E36</div>
                    <div class="r_text"><i class="icon-time"></i> 5 hours ago</div>
                    <div class="r_link"><a href="#">View...</a></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="imessage">
                  <div class="r_icon"><a href="#"><i class="icon-user"></i></a></div>
                  <div class="r_info">
                  	<div class="r_name">Registered new user</div>
                    <div class="r_text"><i class="icon-time"></i> 15th of May - 06:21</div>
                    <div class="r_link"><a href="#">View...</a></div>
                  </div>
                  <div class="clear"></div>
                </div>
                </div>
               
                
                </div>
                <a href="#" class="iview">View all</a><a href="#" class="imark">Mark all read</a>
               
              </div>
            
            </div>
          </div>
          <!--Recent Activity END--> 
            
          </div><!--Notifications END-->
            
           <!--Button User Start-->  
		   <div class="btn-group pull-right" >
            <a class="btn btn-profile dropdown-toggle" id="button-profile" data-toggle="dropdown" href="#">
              <span class="name-user"><strong>Welcome</strong>, <?php echo $this->session->userdata('username'); ?></span> 
              <span class="avatar"><img src="images/users/1.jpg" alt="" ></span> 
              <span class="caret"></span>
            </a>
            <div class="dropdown-menu" id="prof_dropdown">
            <div class="item_m"><span class="caret"></span></div>
            <ul class="clear_ul" >
              <li><a href="#"><i class="icon-globe"></i> Home</a></li>
              <li><a href="#"><i class="icon-comments"></i> Messages</a></li>
              <li><a href="/usersettings"><i class="icon-cog"></i> Settings</a></li>
              <li><a href="/auth/logoff"><i class="icon-off"></i> Sign Out</a></li>
            </ul>
            </div>
          </div>
          <!--Button User END-->  
          
          </div>
    </div>
    <!--Header END-->
