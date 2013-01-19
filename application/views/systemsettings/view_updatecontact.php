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
				<div class="pull-left">Update contact</div>
					<div class="pull-right"></div>
					<div class="clear"></div>
			</div><!-- end grid title -->
			<div class="grid-content">
				<form action="/systemsettings/contacts/updatecontact" method="post">
					<div class="formRow">
						<label>Name </label>
						<div class="formRight">
				        	<input type="text" id="name" name="name" value="<?=$values['name'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Emailaddress </label>
						<div class="formRight">
				        	<input type="text" id="emailaddress" name="emailaddress" value="<?=$values['emailaddress'] ?>"  class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Street address </label>
						<div class="formRight">
				        	<input type="text" id="streetaddress" name="streetaddress" value="<?=$values['streetaddress'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Telephone </label>
						<div class="formRight">
				        	<input type="text" id="contacttel" name="contacttel" value="<?=$values['contacttel'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Country </label>
						<div class="formRight">
				        	<input type="text" id="country" name="country" value="<?=$values['country'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Discription </label>
						<div class="formRight">
				        	<input type="text" id="description" name="description" value="<?=$values['description'] ?>"  class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Category </label>
						<div class="formRight">
				        	 <select class="span_select" name="catagoryid">
				        	 	<?php
				        	 	foreach ($contactcategory as $value) {
				        	 		if($values['catagoryid'] == $value['idcatagory']) { //indien de waarde uit de database overeenkomt met value[idcategory]
				        	 			 echo '<option selected=selected  value=' . $value['idcatagory'] . '>' . $value['catdescription'] . '</option>';  //selecteren we de optie
				        	 		} else {
								 		echo '<option value=' . $value['idcatagory'] . '>' . $value['catdescription'] . '</option>';
									}
								}
								?>
	                          </select>
		            	</div>
					</div>
					<div class="formRow">
						<label>Company </label>
						<div class="formRight">
				        	<input type="text" id="company" name="company"  value="<?=$values['company'] ?>" class="span">
		            	</div>
					</div>
			         <div class="formRow">
						<div class="formRight">
							<input type="hidden" id="idcontact" name="idcontact" value="<?=$values['idcontact'] ?>"  class="span">
			     			<input class="btn btn-warning" type="Submit" value="Update contact">
			     		</div>
		     		</div>
	 				<div class="clear"></div>
				</form>
			</div> <!-- end gridcontent -->
		</div>
	</div> <!-- end grid! -->
</div> <!--Content END-->