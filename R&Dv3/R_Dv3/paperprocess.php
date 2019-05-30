<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Process Post paper Page</title>
</head>
<body>
<h1>Paper Process</h1>
<?php
 	require_once("conn.php");

	$id = $_POST["internalid"];
	$name = $_POST["papername"];
	$ctype = $_POST["coursetype"];
	$load = $_POST["Workload"];
	
	$sql = "insert into paper (internal_id, name, course_type, paper_load) 
VALUES ('$id', '$name', '$ctype', '$load')"; 

	if ($conn->query($sql) === TRUE) {	
	echo "<script>alert('Record successfully!');window.location.href=document.referrer;</script>";}
	else{// display the successful message
	echo "Error: " . $conn->error;}

	

$conn->close();
?>

</body>
</html>
