<?php
$dbServername = "shareddb1e.hosting.stackcp.net";
		$dbUsername = "shbhmnagar-3233a302";
		$dbPassword = "Q/MEWyiGlrmY";
		$dbName = "shbhmnagar-3233a302";

		$link = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

		if (mysqli_connect_error()) {

			die ("There was an error connect to the database");
			

		}
?>