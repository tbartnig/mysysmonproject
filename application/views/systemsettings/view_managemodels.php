
<!--Content Start-->
<div id="content">

 <!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
	     <ul class="menu-speedbar">
	    	 <li><a href="/systemsettings/contacts">Manage contacts</a></li>
	         <li><a href="/systemsettings/software" >Manage software</a></li>
	         <li><a href="/systemsettings/locations">Manage locations</a></li>
	         <li><a href="/systemsettings/models" class="act_link">Manage models</a></li>
	     </ul>
	     </div>
	</div>
     <!--SpeedBar END-->



     <!--CONTENT MAIN START-->
     <div class="content">
        <?php if(isset($msg)) {
        	//hieronder geven wij eventuele berichtne weer
         	echo '<div class="' .$boxtype .'">';
	        echo $msg;
	        echo "</div>";
		}
		?>
     <!--Tabel contacts start -->
    <div class="grid">
	  <div class="grid-title">
        <div class="pull-left">Manage Models</div>
          <div class="pull-right">
              <a href="/systemsettings/models/addmodel" class="btn"><i class="icon-cog"></i>Add Model</a>
            </div>
            <div class="clear"></div>
      </div>
      <div class="grid-content">
      	<form action="/systemsettings/models/deleteselectedmodels" method="post">
            <table class="table table-mod-2" id="datatable_1">
            <thead>
              <tr>
                <th>Modeltype</th>
                <th>Manufacturer</th>
                <th>Class</th>
                <th>Cpu Class</th>
              </tr>
            </thead>
            <tbody>
				<?php
				if(!empty($arrModels)) {
					foreach ($arrModels as $model) { //loop door het eerste array heen
						echo "<tr>";
						echo '<td><input type="checkbox"  name="selectedmodels[]" value="' . $model["idmodeltype"] . '" id="' . $model["idmodeltype"] . '"><label for="' . $model["idmodeltype"] .'" ><span></span><a href="/systemsettings/models/editmodel/'.$model["idmodeltype"] . '">' . $model["modeltype"] . '</a></label></td>' .PHP_EOL;
						echo "<td>" . $model['manufacturer'] . '</td>' .PHP_EOL;
						echo "<td>" . $model['modelclassdescription'] . '</td>' .PHP_EOL;
						echo "<td>" . $model['cpuclassdescription'] . '</td>' .PHP_EOL;
						echo "</tr>";
					}
				}
				?>
            </tbody>
          </table>

        <div class="clear"></div>
        <input type="submit" class="btn btn-danger btn-small" value="Delete selected">
        </form>
      </div>
    </div>
    <!--Tabel contacts END-->

</div>
<!--Content END-->