<?php
	$host = "127.0.0.1";
	$user = "root";
	$passwd = "";
	$base = "TallyHop";
	$conn = mysqli_connect($host, $user, $passwd, $base) or die("Connexion impossible");

	if (!$conn) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}
	echo "Success: A proper connection to MySQL was made! The TallyHop database is great." . PHP_EOL;
	echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;

//	mysqli_close($conn);

?>
