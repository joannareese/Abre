<?php
	
	/*
	* Copyright 2015 Hamilton City School District	
	* 		
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 3 of the License, or
    * (at your option) any later version.
	* 
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU General Public License for more details.
	* 
    * You should have received a copy of the GNU General Public License
    * along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */
	
	//Required configuration files
	require_once('abre_verification.php');
	require_once('abre_google_login.php');
	require_once('abre_functions.php');

if(!isset($_GET["dash"]))
{
?>

	<!--Display the drawer-->
	<div class='drawer mdl-layout__drawer' id='drawer' style='border:none;'>
		
		<header class='drawer-header' style='background-color: <?php echo sitesettings("sitecolor"); ?>'>
			<?php
				echo "<img src='".$_SESSION['picture']."?sz=100' class='avatar'>";
				echo "<span class='mdl-color-text--white truncate'>".$_SESSION['displayName']."</span>";
				echo "<span class='mdl-color-text--white truncate'>".$_SESSION['useremail']."</span>";
			?>
		</header>
		
		<nav class='navigation mdl-navigation mdl-color--white'>
			<?php	
				
				for($modulecountloop = 0; $modulecountloop < $modulecount; $modulecountloop++)
				{	
					$pagetitle=$modules[$modulecountloop][1];
					$pageview=$modules[$modulecountloop][2];
					$pageicon=$modules[$modulecountloop][3];
					$pagepath=$modules[$modulecountloop][4];
					$drawerhidden=$modules[$modulecountloop][5];

					if($pageview==1 && $drawerhidden!=1)
					{
						echo "<a class='mdl-navigation__link' href='#$pagepath' onclick='toggle_drawer()'><i class='mdl-color-text--grey-500 material-icons drawericon' role='presentation'>$pageicon</i><span class='truncate'>$pagetitle</span></a>";
					}
				}
				
				//Show Feedback Module
				if($_SESSION['usertype']=="staff")
				{	
					echo "<div class='mdl-menu__item--full-bleed-divider' style='margin:10px 0 10px 0'></div>";
					echo "<a class='mdl-navigation__link modal-trigger' href='#feedback' onclick='toggle_drawer()'><i class='mdl-color-text--grey-500 material-icons drawericon' role='presentation'>help</i><span class='truncate'>Send Feedback</span></a>";
				}
				
				//Show Settings MOdule
				$sql = "SELECT *  FROM users where email='".$_SESSION['useremail']."' and superadmin=1";
				$result = $db->query($sql);
				while($row = $result->fetch_assoc())
				{
					echo "<a class='mdl-navigation__link' href='#settings' onclick='toggle_drawer()'><i class='mdl-color-text--grey-500 material-icons drawericon' role='presentation'>settings</i><span class='truncate'>Settings</span></a>";
				}
				
			?>
		</nav>
		
	</div>
<?php } ?>