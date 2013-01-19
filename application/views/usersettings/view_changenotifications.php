
<!--Content Start-->
<div id="content">
    
<!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
	    		<ul class="menu-speedbar">
	    		<li><a href="/usersettings/changeemail">Change emailaddress</a></li>
	        	<li><a href="/usersettings/changepassword">Change password</a></li>
	        	<li><a href="/usersettings/changenotifications" class="act_link">Change notifications</a></li>
	     </ul>
		</div>
	</div>
     <!--SpeedBar END-->
     
     <!--Search Start-->   
	
 	<!--Search END-->
     
	<!--CONTENT MAIN START-->
	<div class="content">    
		 <?php 
		 if(isset($msg)) {
        	//hieronder geven wij eventuele berichtne weer
         	echo '<div class="' .$boxtype .'">';
	        echo $msg;   
	        echo "</div>";
		}
	   if(validation_errors()) {
		//indien er validation errors zijn laten we deze zien	
			echo '<div class="info-message alert alert-error">';
           	echo validation_errors();     
			echo '</div>';
		}
		?>
        <!--Input fields Start-->
		<div class="grid">
    		<div class="grid-title">
    	    	<div class="pull-left">Change notification period</div>
            	<div class="pull-right"></div>
            	<div class="clear"></div>
			</div>
		<div class="grid-content">
			<form action="/usersettings/savenotifications" method="post">
			<div class="formRow">
		 		<div class=" distance">
				<p>
    			<input type="checkbox" id="businessdays"  name="businessdays" <?php if(isset($businessdays) && $businessdays == TRUE) echo "checked"?> />
				<label for="businessdays"><span></span> Business days</label>
				</p>
				<p>
					<input type="checkbox" id="weekend" name="weekend" <?php if(isset($weekend) && $weekend == TRUE) echo "checked"?> />
					<label for="weekend"><span></span> Weekend</label>
				</p>
			</div>
			<div class="formRow">
				<label>From: </label>
				<div class="formRight">
                	<input type="text" id="fromtime" name="fromtime"  class="span" value="<?= $from ?>"> 
              	</div>
			</div>
			<div class="formRow">
				<label>Till: </label>
				<div class="formRight">
                	<input type="text" id="tilltime" name="tilltime"  class="span" value="<?= $till ?>">
              </div>
         	</div>
		</div>
		<div class="formRow">		
			<input class="btn btn-warning" type="Submit" value="Save">
		</div>
		</form>
 	</div>    
</div>
<!--Input fields END-->
        
</div>
 <!--CONTENT MAIN END-->

</div>
<!--Content END-->