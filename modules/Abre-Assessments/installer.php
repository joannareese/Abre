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
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');

	if(superadmin() && !isAppInstalled("Abre-Assessments"))
	{

		//Check for assessments_settings table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT * FROM assessments_settings LIMIT 1"))
		{
			$sql = "CREATE TABLE `assessments_settings` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `assessments_settings` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `assessments_settings` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Certica_URL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Certica_URL FROM assessments_settings LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_settings` ADD `Certica_URL` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Certica_AccessKey field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Certica_AccessKey FROM assessments_settings LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_settings` ADD `Certica_AccessKey` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for assessments table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT * FROM assessments LIMIT 1"))
		{
			$sql = "CREATE TABLE `assessments` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `assessments` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `assessments` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Owner field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Owner FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Owner` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Title field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Title FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Title` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Description field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Description FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Description` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Subject field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Subject FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Subject` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Grade field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Grade FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Grade` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Code FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Code` int(11) NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Editors field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Editors FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Editors` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Locked field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Locked FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Locked` INT NOT NULL DEFAULT '0';";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Share field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Shared FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Shared` INT NOT NULL DEFAULT '0';";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Verified field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Verified FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Verified` INT NOT NULL DEFAULT '0';";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Level field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Level FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Level` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for SessionID
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Session_ID FROM assessments LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments` ADD `Session_ID` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for assessments_questions table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT * FROM assessments_questions LIMIT 1"))
		{
			$sql = "CREATE TABLE `assessments_questions` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `assessments_questions` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `assessments_questions` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Assessment_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Assessment_ID FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Assessment_ID` text NOT NULL;";
			//$sql .= "ALTER TABLE `assessments_questions` ADD FOREIGN KEY (`Assessment_ID`) REFERENCES assessments(`ID`);";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Question_Order field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Question_Order FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Question_Order` int(11) NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Bank_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Bank_ID FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Bank_ID` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Points field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Points FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Points` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Vendor_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Vendor_ID FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Vendor_ID` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Type field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Type FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Type` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Difficulty field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Difficulty FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Difficulty` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Standard field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Standard FROM assessments_questions LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_questions` ADD `Standard` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for assessments_standards table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT * FROM assessments_standards LIMIT 1"))
		{
			$sql = "CREATE TABLE `assessments_standards` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `assessments_standards` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `assessments_standards` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Subject field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Subject FROM assessments_standards LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_standards` ADD `Subject` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Standard field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Standard FROM assessments_standards LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_standards` ADD `Standard` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for assessments_scores table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT * FROM assessments_scores LIMIT 1"))
		{
			$sql = "CREATE TABLE `assessments_scores` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `assessments_scores` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `assessments_scores` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Assessment_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Assessment_ID FROM assessments_scores LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_scores` ADD `Assessment_ID` text NOT NULL;";
			//$sql .= "ALTER TABLE `assessments_scores` ADD FOREIGN KEY (`Assessment_ID`) REFERENCES assessments(`ID`);";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for User field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT User FROM assessments_scores LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_scores` ADD `User` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Score field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Score FROM assessments_scores LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_scores` ADD `Score` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for scoredOn field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT scoredOn FROM assessments_scores LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_scores` ADD `scoredOn` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for ItemID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT ItemID FROM assessments_scores LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_scores` ADD `ItemID` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Response field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Response FROM assessments_scores LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_scores` ADD `Response` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Score_GUID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Score_GUID FROM assessments_scores LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_scores` ADD `Score_GUID` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for assessments_status table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT * FROM assessments_status LIMIT 1"))
		{
			$sql = "CREATE TABLE `assessments_status` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `assessments_status` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `assessments_status` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Assessment_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Assessment_ID FROM assessments_status LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_status` ADD `Assessment_ID` text NOT NULL;";
			//$sql .= "ALTER TABLE `assessments_status` ADD FOREIGN KEY (`Assessment_ID`) REFERENCES assessments(`ID`);";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for User field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT User FROM assessments_status LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_status` ADD `User` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Start_Time field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Start_Time FROM assessments_status LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_status` ADD `Start_Time` datetime NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for End_Time field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT End_Time FROM assessments_status LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_status` ADD `End_Time` datetime NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for End_Time field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Is_Graded FROM assessments_status LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_status` ADD `Is_Graded` int(11) NOT NULL DEFAULT '0';";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Assessments_Results table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT * FROM assessments_results LIMIT 1"))
		{
			$sql = "CREATE TABLE `assessments_results` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `assessments_results` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `assessments_results` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Assessment_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Assessment_ID FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `Assessment_ID` text NOT NULL;";
			//$sql .= "ALTER TABLE `assessments_results` ADD FOREIGN KEY (`Assessment_ID`) REFERENCES assessments(`ID`);";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for User field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT User FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `User` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Student_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Student_ID FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `Student_ID` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Score field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Score FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `Score` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Possible_Points field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Possible_Points FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `Possible_Points` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for IEP field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT IEP FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `IEP` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for ELL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT ELL FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `ELL` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Gifted field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		if(!$db->query("SELECT Gifted FROM assessments_results LIMIT 1"))
		{
			$sql = "ALTER TABLE `assessments_results` ADD `Gifted` text NOT NULL;";
			$db->multi_query($sql);
		}
		$db->close();

		//Mark app as installed
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
		$sql = "UPDATE apps_abre SET installed = 1 WHERE app = 'Abre-Assessments'";
		$db->multi_query($sql);
		$db->close();

	}

?>