
<!--Content Start-->
<div id="content">

 <!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
	     <ul class="menu-speedbar">
	    	 <li><a href="/systemsettings/contacts">Manage contacts</a></li>
	         <li><a href="/systemsettings/software">Manage software</a></li>
	         <li><a href="/systemsettings/locations" class="act_link">Manage locations</a></li>
	         <li><a href="/systemsettings/models">Manage models</a></li>
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
        <div class="pull-left">Manage Locations</div>
          <div class="pull-right">
              <a href="/systemsettings/locations/addlocation" class="btn"><i class="icon-cog"></i>Add location</a>
            </div>
            <div class="clear"></div>
      </div>

      <div class="grid-content">
      	<form action="/systemsettings/locations/deleteselectedlocations" method="post">
            <table class="table table-mod-2" id="datatable_1">
            <thead>
              <tr>
                <th>Location</th>
                <th>Street address</th>
                <th>Telephone number</th>
                <th>Description</th>

              </tr>
            </thead>
            <tbody>
				<?php
				if(!empty($arrLocations)) {
					foreach ($arrLocations as $location) { //loop door het eerste array heen
						echo "<tr>";
						echo '<td><input type="checkbox"  name="selectedlocations[]" value="' . $location["idlocation"] . '" id="' . $location["idlocation"] . '"><label for="' . $location["idlocation"] .'" ><span></span><a href="/systemsettings/locations/editlocation/'.$location["idlocation"] . '">' . $location["location"] . '</a></label></td>' .PHP_EOL;
						//echo '<td></td>';
						echo "<td>" . $location['streetaddress'] . '</td>' .PHP_EOL;
						echo "<td>" . $location['contacttel'] . '</td>' .PHP_EOL;
						echo "<td>" . $location['description'] . '</td>' .PHP_EOL;
						echo "</tr>";
					}
				}
				?>
            </tbody>
          </table>

        <div class="clear"></div>
        <input type="submit" class="btn btn-danger btn-small" value="Delete selected">
      </div>
    </div>
    <!--Tabel contacts END-->

</div>
<!--Content END-->