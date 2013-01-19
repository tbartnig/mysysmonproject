
<!--Content Start-->
<div id="content">
    
 <!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
	     <ul class="menu-speedbar">
	    	 <li><a href="/usersettings/changeemail" class="act_link">Change emailaddress</a></li>
	         <li><a href="/usersettings/changepassword">Change password</a></li>
	         <li><a href="/usersettings/changenotifications">Change notifications</a></li>
	     </ul>
	     </div>
	</div>
     <!--SpeedBar END-->
     
     <!--Search Start-->   
     
     <!--Search END-->
     
     <!--CONTENT MAIN START-->
     <div class="content">
        <?php if(isset($msg)) {
        	//hieronder geven wij eventuele berichtne weer
         	echo '<div class="' .$boxtype .'">';
	        echo $msg;   
	        echo "</div>";
		}
		?>
        <!--Input fields Start-->
		<div class="grid">
        	<div class="grid-title">
            	<div class="pull-left">Change emailaddress</div>
            	<div class="pull-right"></div>
            	<div class="clear"></div>
          	</div>
          <div class="grid-content">
    	  <div class="formRow">
    	  <form action="/usersettings/saveemail" method="post">
			  <label>Emailaddress: </label>
        	  <div class="formRight">
                    <input type="text" id="emailaddress" name="emailaddress" value="<?=$emailaddress?>"  class="span"> 
              </div>
         </div>
         <div class="clear"></div>
         <div class="formRow">
   	     	<div class="formRight">
    	     	<input class="btn btn-warning" type="Submit" value="Save">
    	     </form>
			</div>
		</div>
    	<div class="clear"></div>
 	</div>    
</div>
        <!--Input fields END-->
        
        

 </div>
 <!--CONTENT MAIN END-->

</div>
<!--Content END-->