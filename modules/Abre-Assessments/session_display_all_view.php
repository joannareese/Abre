<?php

	/*
	* Copyright (C) 2016-2018 Abre.io Inc.
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */

	//Required configuration files
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
	require_once('../../core/abre_functions.php');
	require_once('permissions.php');

	if($pagerestrictions=="")
	{

		$sql = "SELECT COUNT(*) FROM assessments_sessions WHERE Owner='".$_SESSION['useremail']."'";
		$result = $db->query($sql);
		$returnrow = $result->fetch_assoc();
		$rowcount = $returnrow["COUNT(*)"];
		if($rowcount!=0)
		{
			?>
			<div class='page_container mdl-shadow--4dp'>
			<div class='page'>
				<div id='searchresults'>
					<div class='row'><div class='col s12'>
						<table id='myTable' class='tablesorter'>
							<thead>
								<tr class='pointer'>
									<th>Title</th>
									<th style='width:30px'></th>
									<th style='width:30px'></th>
								</tr>
							</thead>
							<tbody>

								<?php
								$sql = "SELECT Assessment_ID, Session_ID FROM assessments_sessions WHERE Owner='".$_SESSION['useremail']."'";
								$result = $db->query($sql);
								while($row = $result->fetch_assoc())
								{
									$Assessment_ID=htmlspecialchars($row["Assessment_ID"], ENT_QUOTES);
									$Session_ID=htmlspecialchars($row["Session_ID"], ENT_QUOTES);

									//Find assessment information
									$sql2 = "SELECT Verified, Title FROM assessments WHERE id='$Assessment_ID'";
									$result2 = $db->query($sql2);
									while($row2 = $result2->fetch_assoc())
									{
										$Verified=htmlspecialchars($row2["Verified"], ENT_QUOTES);
										$Title=htmlspecialchars($row2["Title"], ENT_QUOTES);
									}

									echo "<tr class='assessmentrow'>";
										echo "<td>$Title</td>";
										echo "<td width=30px>";
											echo "<a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-color-text--grey-600' href='$portal_root/#assessments/session/$Assessment_ID/$Session_ID' target='_blank'><i class='material-icons'>open_in_new</i></a>";
										echo "</td>";

										if($Verified==0)
										{
											echo "<td width=30px>";
												echo "<a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-color-text--grey-600 deletesession' href='modules/".basename(__DIR__)."/session_delete.php?assessmentid=".$Assessment_ID."'><i class='material-icons'>delete</i></a>";
											echo "</td>";
										}

									echo "</tr>";
								}
								echo "</tbody>";
							echo "</table>";
						echo "</div>";

					echo "</div>";

			echo "</div>";
			echo "</div>";
		}
		else
		{
			echo "<div class='row center-align'><div class='col s12'><h6>There are currently no sessions</h6></div></div>";
		}

		$db->close();
	}

?>

<script>

	//Process the profile form
	$(function()
	{

		$("#myTable").tablesorter();

	});


</script>