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
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require_once('functions.php');

	require("filterbar.php");

	echo "<div id='searchresultsloader'>";
		require("queue_display.php");
	echo "</div>";
?>

<script>

	$(function(){
		$("#searchresultsloader").show();

		//Search Function
		function SearchQuery(page, sort, method){
			event.preventDefault();
			$("#conductsearch").show();
			var query = $("#conductsearchquery").val();
			var fromdate = $("#conductsearchqueryfrom").val();
			var thrudate = $("#conductsearchquerythru").val();
			$.post( "modules/<?php echo basename(__DIR__); ?>/queue_display.php",
			{ conductsearch: query, conductfrom: fromdate, conductthru: thrudate, page: page, sort: sort, method: method })
			.done(function(data) {
				$("#conductsearch").hide();
				$("#searchresultsloader").html(data);
				$("#conductsearchquerypage").val(page);
			});
		}

		//Save new incident
		$('#search').submit(function(event){
			SearchQuery(1, '', '');
		});

		//Date Range Change
		$("#conductsearchqueryfrom, #conductsearchquerythru").change(function(){
			SearchQuery(1, '', '');
		});

		//Paging Button
		$('#searchresultsloader').off('.pagebuttonqueue').on('click', '.pagebuttonqueue', function(){
			event.preventDefault();
			$('.mdl-layout__content').animate({scrollTop:0}, 0);
			var CurrentPage = $(this).data('page');
			var Sort = $(this).data('sort');
			var SortMethod = $(this).data('sortmethod');
			if(SortMethod == "DESC"){ SortMethod = "ASC"; }else{ SortMethod = "DESC"; }
			SearchQuery(CurrentPage, Sort,  SortMethod);
		});

		//Sort Button
		$('#searchresultsloader').off('.sortbuttonqueue').on('click', '.sortbuttonqueue', function(){
			event.preventDefault();
			var Sort = $(this).data('sort');
			var SortMethod = $(this).data('sortmethod');
			$('.mdl-layout__content').animate({scrollTop:0}, 0);
			SearchQuery(1, Sort, SortMethod);
		});
	});
	
</script>