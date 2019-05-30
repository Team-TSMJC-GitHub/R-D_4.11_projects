<?php
 require_once("conn.php");
	$paper = $_POST['paper'];
	$year = $_POST['year'];
	$sem = $_POST['sem'];
	$time = $_POST['day']." ".$_POST['time1']."-".$_POST['time2'];
	$sql = "INSERT INTO offer (paper_id, year, semester, time) VALUES ('$paper', '$year', '$sem', '$time')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Offer added successfully!');window.location.href=document.referrer;</script>";
} else {
    echo "<script>alert('Offer added Before! Please try again!');window.location.href=document.referrer;</script>";
}


$conn->close();
?>