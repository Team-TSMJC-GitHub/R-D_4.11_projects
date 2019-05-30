<?php

require_once("conn.php");
$id = $_GET['id'];

$sql = "DELETE FROM lecturer WHERE lecturer_id='".$id."'";
$sql2 = "DELETE FROM masters WHERE masters_id='".$id."'";
$sql3 = "DELETE FROM phd WHERE phd_id='".$id."'";
$sql4 = "DELETE FROM bcis WHERE bcis_id='".$id."'";
$sql5 = "DELETE FROM teaching WHERE lecturer_id='".$id."'";

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	$result = $conn->query($sql);
	$result2 = $conn->query($sql2);
	$result3 = $conn->query($sql3);
	$result4 = $conn->query($sql4);
	$result5 = $conn->query($sql5);
	echo "<script>alert('Lecturer Delete Succeed!');window.location.href=document.referrer;</script>";
}


$conn->close();
?>