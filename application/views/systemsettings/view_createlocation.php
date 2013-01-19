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
				<div class="pull-left">New location</div>
					<div class="pull-right"></div>
					<div class="clear"></div>
			</div><!-- end grid title -->
			<div class="grid-content">
				<form action="/systemsettings/locations/savelocation" method="post">
					<div class="formRow">
						<label>Location</label>
						<div class="formRight">
				        	<input type="text" id="location" name="location" value="<?=$values['location'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Street address </label>
						<div class="formRight">
				        	<input type="text" id="streetaddress" name="streetaddress" value="<?=$values['streetaddress'] ?>"  class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Telephone number </label>
						<div class="formRight">
				        	<input type="text" id="contacttel" name="contacttel" value="<?=$values['contacttel'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Description </label>
						<div class="formRight">
				        	<input type="text" id="description" name="description" value="<?=$values['description'] ?>" class="span">
		            	</div>
					</div>
			         <div class="formRow">
						<div class="formRight">
			     			<input class="btn btn-warning" type="Submit" value="Save location">
			     		</div>
		     		</div>
	 				<div class="clear"></div>
				</form>
			</div> <!-- end gridcontent -->
		</div>
	</div> <!-- end grid! -->
</div> <!--Content END-->