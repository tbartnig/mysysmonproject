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
				<div class="pull-left">Update model</div>
					<div class="pull-right"></div>
					<div class="clear"></div>
			</div><!-- end grid title -->
			<div class="grid-content">
				<form action="/systemsettings/models/updatemodel" method="post">
					<div class="formRow">
						<label>Modeltype </label>
						<div class="formRight">
				        	<input type="text" id="modeltype" name="modeltype" value="<?=$values['modeltype'] ?>" class="span">
		            	</div>
					</div>
					<div class="formRow">
						<label>Manufacturer </label>
						<div class="formRight">
				        	<input type="text" id="manufacturer" name="manufacturer" value="<?=$values['manufacturer'] ?>"  class="span">
		            	</div>
					</div>

					<div class="formRow">
						<label>Class </label>
						<div class="formRight">
				        	<select class="span_select" name="modelclassid">
				        	 	<?php foreach ($modelclass as $value) {
				        	 		if($values['modelclassid'] == $value['idsysmonmodelclass']) { //indien de waarde uit de database overeenkomt met value[idcategory]
								 		echo '<option selected=selected value=' . $value['idsysmonmodelclass'] . '>' . $value['modelclassdescription'] . '</option>';
									} else {
										echo '<option value=' . $value['idsysmonmodelclass'] . '>' . $value['modelclassdescription'] . '</option>';
									}
								} ?>
	                          </select>
		            	</div>
					</div>
					<div class="formRow">
						<label>Cpu Class </label>
						<div class="formRight">
				        	<select class="span_select" name="cpuclassid">
				        	 	<?php foreach ($cpuclass as $value) {
				        	 		if($values['cpuclassid'] == $value['idsysmoncpuclass']) { //indien de waarde uit de database overeenkomt met value[idcategory]
										 echo '<option selected=selected value=' . $value['idsysmoncpuclass'] . '>' . $value['cpuclassdescription'] . '</option>';
									} else {
										 echo '<option value=' . $value['idsysmoncpuclass'] . '>' . $value['cpuclassdescription'] . '</option>';
									}
								} ?>
	                          </select>
		            	</div>
					</div>



			         <div class="formRow">
						<div class="formRight">
							<input type="hidden" id="idmodeltype" name="idmodeltype" value="<?=$values['idmodeltype'] ?>"  class="span">
			     			<input class="btn btn-warning" type="Submit" value="Update model">
			     		</div>
		     		</div>
	 				<div class="clear"></div>

				</form>
			</div> <!-- end gridcontent -->
		</div>
	</div> <!-- end grid! -->
</div> <!--Content END-->