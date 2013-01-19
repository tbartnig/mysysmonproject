<!DOCTYPE html>
<html lang="en"  class="body-error"><head>
    <meta charset="utf-8">
    <title>Sweet Dreams - Login</title>
<!-- http://themeforest.net/user/dimka_ua_kh/portfolio -->

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/login.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">

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
    <div id="container_demo" >
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
            <div id="login" class="animate form position">
                <form action="/auth" class="form-login" method="post"> 
                    <div class="content-login">
                    <a href="#" class="logo"></a>
                
                    <?php if(validation_errors()) {
                       //indien er validation errors zijn laten we deze zien	
                       echo '<div class="info-message alert alert-info">';
                       	echo validation_errors();     
                	   echo '</div>';
					}
					?>   
   
                    <div class="inputs">
                        <i class="icon-user first-icon"></i><input name="username" type="text" class="first-input" placeholder="username" />
                        <div class="clear"></div>
                        <i class="icon-key"></i><input name="password" type="password" class="last-input" placeholder="password" />
                    </div>
                    
                    <div class="remember">
                    	<input type="checkbox" id="c2" name="cc" checked="checked" />
            			<label for="c2"><span></span> Remember Me</label>
                    </div>
                    <div class="link"><a href="#">Forgot Password?</a></div>
                    <div class="clear"></div>
                    <div class="button-login"><input type="submit" class="btn btn-large" value="Sign In"></div>
                    </div>
                    <!-- 
                    <div class="footer-login">
                   
                     <div class="pull-left ">Don't have an account?</div>
                     <div class="pull-right"><a href="#toregister" class="to_register">Creative Account</a></div>
                     <div class="clear"></div>
                     
                    </div>
                   -->
                </form>
                
                
               
              
            </div>            
        </div>
    </div>  
    
   
    
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>

  </body>
</html>

