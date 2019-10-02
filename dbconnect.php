<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "juvenile_report";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	$conn->query("set names utf8");

	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} ?>
