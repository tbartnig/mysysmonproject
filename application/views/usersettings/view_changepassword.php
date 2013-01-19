<!--Content Start-->
<div id="content">
    
<!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
	     <ul class="menu-speedbar">
	    	  <li><a href="/usersettings/changeemail">Change emailaddress</a></li>
	         <li><a href="/usersettings/changepassword" class="act_link">Change password</a></li>
	         <li><a href="/usersettings/changenotifications">Change notifications</a></li>
	     </ul>
	     </div>
	</div>
     <!--SpeedBar END-->
     
     <!--Search Start-->   
    
     <!--Search END-->
     
     <!--CONTENT MAIN START-->
     <div class="content">
         <?php 
         if(validation_errors()) {
		//indien er validation errors zijn laten we deze zien	
			echo '<div class="info-message alert alert-error">';
           	echo validation_errors();     
			echo '</div>';
		}
		 //indien er andere berichten zijn geven we deze hier weer.
		if(isset($msg)) {
        	//hieronder geven wij eventuele berichtne weer
         	echo '<div class="' .$boxtype .'">';
	        echo $msg;   
	        echo "</div>";
		}
		?>   
        <!--Input fields Start-->
		<div class="grid">
        	<div class="grid-title">
            	<div class="pull-left">Change password</div>
            	<div class="pull-right"></div>
            	<div class="clear"></div>
          	</div>
            <div class="grid-content">
            	<form action="/usersettings/savepassword" method="post">
            	<div class="formRow">
			 		<label>Current password: </label>
        	  		<div class="formRight">
                    <input type="password" id="currpassword" name="currpassword"  class="span"> 
             	</div>
    	  		<div class="formRow">
			 		<label>New password: </label>
        	  		<div class="formRight">
                    <input type="password" id="password" name="password"  class="span"> 
             	</div>
			</div>
          	<div class="formRow">
				<label>repeat new password: </label>
				<div class="formRight">
                	<input type="password" id="passconf" name="passconf"  class="span"> 
              	</div>
				</form>
			</div>
			
			
			<div class="formRow">
   	     		<div class="formRight">
    	     		<input class="btn btn-warning" type="Submit" value="Save">
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