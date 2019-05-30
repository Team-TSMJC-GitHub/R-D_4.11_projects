<?php

require_once("conn.php");
$id = $_GET['id'];

$sql = "DELETE FROM offer WHERE offer_id='".$id."'";
$sql2 = "DELETE FROM teaching WHERE offer_id='".$id."'";
$sql3 = "UPDATE lecturer SET offer_id=NULL WHERE offer_id='".$id."'";
if (isset($_GET['id']) && is_numeric($_GET['id'])){
	$result = $conn->query($sql);
	$result2 = $conn->query($sql2);
	$result3 = $conn->query($sql3);
	echo "<script>alert('Offer Delete Succeed!');window.location.href=document.referrer;</script>";
}


$conn->close();
?>