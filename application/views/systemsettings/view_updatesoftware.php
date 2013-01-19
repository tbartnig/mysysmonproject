<!--Content Start-->
<div id="content">

	 <!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
			<ul class="menu-speedbar">
			<li><a href="/systemsettings/contacts">Manage contacts</a></li>
			<li><a href="/systemsettings/software">Manage software</a></li>
			<li><a href="/systemsettings/locations">Manage locations</a></li>
			<li><a href="/systemsettings/models">Manage models</a></li>
			</ul>
		</div>
	</div>
	<!--SpeedBar END-->
	<!--CONTENT MAIN START-->
	<div class="content">
		<?php
		  if(validation_errors()) {
			//indien er validation errors zijn laten we deze zien
			echo '<div class="info-message alert alert-error">';
           	echo validation_errors();
			echo '</div>';
		  }
		?>
		<!--FORM start-->
		<div class="grid">
			<div class="grid-title">
				<div class="pull-left">Update application or OS</div>
					<div class="pull-right"></div>
					<div class="clear"></div>
			</div><!-- end grid title -->
			<div class="grid-content">
				<form action="/systemsettings/software/updatesoftware" method="post">
					<div class="formRow">
						<label>Application</label>
						<div class="formRight">
				        	<input type="text" id="location" name="application" value="<?=$values['application'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Vendor </label>
						<div class="formRight">
				        	<input type="text" id="vendor" name="vendor" value="<?=$values['vendor'] ?>"  class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Version </label>
						<div class="formRight">
				        	<input type="text" id="version" name="version" value="<?=$values['version'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Amount </label>
						<div class="formRight">
				        	<input type="text" id="totallicenses" name="totallicenses" value="<?=$values['amount'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Licensekey </label>
						<div class="formRight">
				        	<input type="text" id="licensekey" name="licensekey" value="<?=$values['licensekey'] ?>" class="span">
		            	</div>
					</div>
			         <div class="formRow">
						<div class="formRight">
							<input type="hidden" id="idsysmonsoftware" name="idsysmonsoftware" value="<?=$values['idsysmonsoftware'] ?>"  class="span">
			     			<input class="btn btn-warning" type="Submit" value="Save">
			     		</div>
		     		</div>
	 				<div class="clear"></div>
				</form>
			</div> <!-- end gridcontent -->
		</div>
	</div> <!-- end grid! -->
</div> <!--Content END-->