<?php

	/*
	* Copyright (C) 2016-2017 Abre.io LLC
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
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');

	//Check for installation
	if(admin()){ require('installer.php'); }

	$pageview=1;
	$drawerhidden=0;
	$pageorder=10;
	$pagetitle="Guided Learning";
	$description="Secure lesson builder for delivering a focused lesson with Guided Learning App or Guided Learning Extension.";
	$version="1.1.1";
	$repo="abreio/Abre-Guided-Learning";
	$pageicon="directions";
	$pagepath="guide";

	require_once('permissions.php');

?>