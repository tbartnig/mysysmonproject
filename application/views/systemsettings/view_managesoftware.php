
<!--Content Start-->
<div id="content">

 <!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
	     <ul class="menu-speedbar">
	    	 <li><a href="/systemsettings/contacts">Manage contacts</a></li>
	         <li><a href="/systemsettings/software" class="act_link">Manage software</a></li>
	         <li><a href="/systemsettings/locations">Manage locations</a></li>
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
        <div class="pull-left">Manage Software</div>
          <div class="pull-right">
              <a href="/systemsettings/software/addsoftware" class="btn"><i class="icon-cog"></i>Add application</a>
            </div>
            <div class="clear"></div>
      </div>
      <div class="grid-content">
      	<form action="/systemsettings/software/deleteselectedsoftware" method="post">
            <table class="table table-mod-2" id="datatable_1">
            <thead>
              <tr>
                <th>Application</th>
                <th>Version</th>
                <th>Vendor</th>
                <th>Licensekey</th>
                <th>Total licences</th>
                <th>Licenses in use</th>
              </tr>
            </thead>
            <tbody>
				<?php
				if(!empty($arrSoftware)) {
					foreach ($arrSoftware as $software) { //loop door het eerste array heen
						echo "<tr>";
						echo '<td><input type="checkbox"  name="selectedsoftware[]" value="' . $software["idsysmonsoftware"] . '" id="' . $software["idsysmonsoftware"] . '"><label for="' . $software["idsysmonsoftware"] .'" ><span></span><a href="/systemsettings/software/editsoftware/'.$software["idsysmonsoftware"] . '">' . $software["application"] . '</a></label></td>' .PHP_EOL;
						echo '<td>' . $software["version"] . '</td>';
						echo '<td>' . $software["vendor"] . '</td>';
						echo '<td>' . $software["licensekey"] . '</td>';
						echo '<td>' . $software["amount"] . '</td>';
						echo '<td>' . $software["licinuse"] . '</td>';
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