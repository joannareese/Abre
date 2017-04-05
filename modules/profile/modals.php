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
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php'); 
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');	

?>

	<!--Work Schedule-->
	<div id="viewschedule" class="modal modal-fixed-footer modal-mobile-full" style='width: 80%'>
	    <div class="modal-content">
			<h4>Set Your Work Schedule</h4>
			<div class='row'>
				<div class='col m3 hide-on-small-only'>
					<?php include "calendarsidebar.php"; ?>
				</div>
				<div class='col m9 s12'>
					<?php echo "<form id='form-calendar' method='post'>"; ?>
						<input id="saveddates" type="hidden"></input>
					</form>
					<div id="workcalendardisplay"></div>
				</div>
			</div>
	    </div>
		<div class="modal-footer">
			<button class="modal-close waves-effect btn-flat white-text" style='margin-left:5px; background-color: <?php echo sitesettings("sitecolor"); ?>'>Close</button>
			<button class="printbutton waves-effect btn-flat white-text" style='background-color: <?php echo sitesettings("sitecolor"); ?>'>Print</button>
			<div id="selecteddays" style='margin:12px 0 0 20px; font-weight:500; font-size:16px;'></div>
	    </div>
	</div>
	
<!--Stream Editor-->
	<?php
	if(superadmin())
	{
	?>

	<div id='streameditor' class='modal modal-fixed-footer modal-mobile-full'>
		<div class='modal-content'>
			<a class="modal-close black-text" style='position:absolute; right:20px; top:25px;'><i class='material-icons'>clear</i></a>
			<div class='row'>
				<div class='col s12'>
					<h4>Stream Editor</h4>
					<?php
						include "stream_editor_content.php";
					?>
				</div>
			</div>
		</div>
		<div class='modal-footer'>
			<a class='modal-action waves-effect btn-flat white-text modal-addeditstream' href='#addeditstream' data-streamtitle='Add New Stream' style='background-color: <?php echo sitesettings("sitecolor"); ?>'>Add</a>
		</div>
	</div>

	<div id='addeditstream' class='modal modal-fixed-footer modal-mobile-full' style="width: 90%">
		<form id='addeditstreamform' method="post" action='#'>
		<div class='modal-content'>
			<a class="modal-close black-text" style='position:absolute; right:20px; top:25px;'><i class='material-icons'>clear</i></a>
			<div class='row'>
				<div class='col s12'><h4 id='editstreammodaltitle'></h4></div>
				<div class='input-field col s12'>
					<input placeholder="Enter Stream Name" id="stream_name" name="stream_name" type="text" autocomplete="off" required>
					<label for="stream_name" class="active">Name</label>
				</div>
				<div class='input-field col s12'>
					<input placeholder="Enter RSS Link" id="rss_link" name="rss_link" type="text" autocomplete="off" required>
					<label for="rss_link" class="active">Link</label>
				</div>
			</div>
			<div class='row'>
				<div class='col m4 s12'>
						<input type="radio" name="streamradio" id="stream_staff" value="staff" required>
						<label for="stream_staff">Staff</label>
				</div>
				<div class='col m4 s12'>
					<input type="radio" name="streamradio" id="stream_students" value="students">
					<label for="stream_students">Students</label>
				</div>
			</div>
			<input id="stream_id" name="stream_id" type="hidden">
		</div>
		<div class='modal-footer'>
			<button type="submit" class='modal-action waves-effect btn-flat white-text' id='saveupdatestream' style='background-color: <?php echo sitesettings("sitecolor"); ?>'>Save</button>
			<a class='modal-action modal-close waves-effect btn-flat white-text' style='background-color: <?php echo sitesettings("sitecolor"); ?>; margin-right:5px;'>Cancel</a>
		</div>
		</form>
	</div>
	<?php
 	}
 	?>
	
<script>
	
$(function()
{
	 			
	 			
		   	<?php
			if(superadmin())
			{
			?>

				//Add/Edit Stream
				$('.modal-addeditstream').leanModal({
					in_duration: 0,
					out_duration: 0,
					ready: function()
					{
						$('.modal-content').scrollTop(0);
						$("#editstreammodaltitle").text('Add New Stream');
						$("#stream_name").val('');
						$("#rss_link").val('');
						$("#stream_id").val('');
						$('#stream_staff').prop('checked', false);
						$('#stream_students').prop('checked', false);
					}
				});

				//Save/Update Stream
				$('#addeditstreamform').submit(function(event)
				{
					event.preventDefault();

					var streamtitle = $('#stream_name').val();
					var rsslink = $('#rss_link').val();
					var streamgroup= $('input[name=streamradio]:checked').val();

					var streamid = $('#stream_id').val();
					//Make the post request
					$.ajax({
						type: 'POST',
						url: 'modules/profile/update_stream.php',
						data: { title: streamtitle, link: rsslink, id: streamid, group: streamgroup }
					})

					.done(function(){
						$('#addeditstream').closeModal({ in_duration: 0, out_duration: 0 });
						$('#streamsort').load('modules/profile/stream_editor_content.php');
						$('#content_holder').load( 'modules/profile/profile.php');
					});
				});

			<?php
			}
			?>
	 			
	 			
				var today = new Date();
				//var y = today.getFullYear();		
				var y = 2016;		
				$('#workcalendardisplay').multiDatesPicker({
					<?php
						if($_SESSION['usertype']!="student")
						{
							$sql = "SELECT * FROM profiles where email='".$_SESSION['useremail']."'";
							$dbreturn = databasequery($sql);
							foreach ($dbreturn as $row)
							{
								$work_calendar_saved=htmlspecialchars($row['work_calendar'], ENT_QUOTES);
								if($work_calendar_saved!=NULL)
								{
									$work_calendar_saved = str_replace(' ', '', $work_calendar_saved);
									$work_calendar_saved=explode(",", $work_calendar_saved);
									$work_calendar_saved=implode("','", $work_calendar_saved);
									$work_calendar_saved="'".$work_calendar_saved."'";
									echo "addDates: [$work_calendar_saved],";
									//echo "addDisabledDates:['12/04/2016','12/03/2016'],";
								}
								else
								{
									include "calendar_default_dates.php";
									echo "addDates: [$work_calendar_saved],";
									//echo "addDisabledDates:['12/04/2016','12/03/2016'],";
								}
							}
						}
					?>
					numberOfMonths: [6,2],
					defaultDate: '8/1/'+y,
					altField: '#saveddates',
					dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
					onSelect: function (date) {

				        var dates = $('#workcalendardisplay').multiDatesPicker('getDates').length;
						$("#selecteddays").text(dates + " Days Selected");
						
						
						
						var datestosave = $( "#saveddates" ).val();
						$.ajax({
							type: 'POST',
							url: '/modules/profile/calendar_update.php',
							data: { calendardaystosave : datestosave },
						})
								
						//Show the notification
						.done(function(response) {
							//var notification = document.querySelector('.mdl-js-snackbar');
							//var data = { message: response };
							//notification.MaterialSnackbar.showSnackbar(data);
						})
						
						
						
				    }
				});
				
	 			var dates = $('#workcalendardisplay').multiDatesPicker('getDates').length;
				$("#selecteddays").text(dates + " Days Selected");
				
				
				
				
			});
			
</script>