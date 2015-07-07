<?php



if(  isset($_GET["id"]) && isset($_GET["n"]) && isset($_GET["re"]) && isset($_GET["ra"]) && isset($_GET["l"]) && isset($_GET["p"]) ) {

	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"], 1);

	$conn = new mysqli($server, $username, $password, $db);

	$result = $conn->query("SELECT * FROM user WHERE summoner_name = " . $_GET['n']);

	if($result->num_rows > 0) { 
		$row = $result->fetch_assoc();

		echo $row["summoner_name"] . " " . $row["summoner_id"];
	} else {
		$stmt = $conn->prepare("INSERT INTO user (summoner_id, summoner_name, rank, region, league, position) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isisss",$_GET["id"], $_GET["n"], $_GET["ra"], $_GET["re"], $_GET["l"], $_GET["p"]);
		$stmt->execute();		
		echo "inserted " . $_GET["n"];
	}

	$stmt->close();
	$conn->close();
} else {
	echo 'nothing to see here..';
}
