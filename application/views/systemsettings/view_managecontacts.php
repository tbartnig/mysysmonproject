
<!--Content Start-->
<div id="content">

 <!--SpeedBar Start-->
	<div class="speedbar">
		<div class="speedbar-content">
	     <ul class="menu-speedbar">
	    	 <li><a href="/systemsettings/contacts" class="act_link">Manage contacts</a></li>
	         <li><a href="/systemsettings/software">Manage software</a></li>
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
<input id="c1" name="cc" type="checkbox">
     <!--Tabel contacts start -->
    <div class="grid">
	  <div class="grid-title">
        <div class="pull-left">Manage contacts</div>
          <div class="pull-right">
              <a href="/systemsettings/contacts/addcontact" class="btn"><i class="icon-cog"></i>Add Contact</a>
          </div>
          <div class="clear"></div>
      </div>
      <div class="grid-content">
      	<form action="/systemsettings/contacts/deleteselectedcontacts" method="post">
            <table class="table table-mod-2" id="datatable_1">
            <thead>

              <tr>
                <th>Name</th>
                <th>Emailaddress</th>
                <th>Telephone number</th>
                <th>Street address</th>
                <th>Country</th>
                <th>Description</th>
                <th>Catagorie</th>
                <th>Company</th>
              </tr>
            </thead>
            <tbody>

				<?php
				if(!empty($arrContacts)) {
					foreach ($arrContacts as $contact) { //loop door het eerste array heen
						echo "<tr>";
						echo '<td><input type="checkbox"  name="selectedcontacts[]" value="' . $contact["idcontact"] . '" id="' . $contact["idcontact"] . '"><label for="' . $contact["idcontact"] .'" ><span></span><a href="/systemsettings/contacts/editcontact/'.$contact["idcontact"] . '">' . $contact["name"] . '</a></label></td>' .PHP_EOL;
						//echo '<td></td>';
						echo "<td>" . $contact['emailaddress'] . '</td>' .PHP_EOL;
						echo "<td>" . $contact['contacttel'] . '</td>' .PHP_EOL;
						echo "<td>" . $contact['streetaddress'] . '</td>' .PHP_EOL;
						echo "<td>" . $contact['country'] . '</td>' .PHP_EOL;
						echo "<td>" . $contact['description'] . '</td>' .PHP_EOL;
						echo "<td>" . $contact['catdescription'] . '</td>' .PHP_EOL;
						echo "<td>" . $contact['company'] . '</td>' .PHP_EOL;
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