<?php
 require_once("conn.php");
	$offerid = $_POST['offerid'];
	$lecturer = $_POST['lecturer'];
	$lecturer2 = $_POST['lecturer2'];
	
	
	$sql = "INSERT INTO teaching(lecturer_id, lecturer_id2, offer_id) VALUES ('$lecturer', '$lecturer2', '$offerid')";
	$sql2 = "UPDATE lecturer SET offer_id = '$offerid' WHERE lecturer_id='$lecturer'";
	$sql3 =  "UPDATE lecturer SET offer_id = '$offerid' WHERE lecturer_id='$lecturer2'";
// no lecturer2 then 
if ($lecturer2==NULL)
{
	if ($conn->query($sql) === TRUE) 
	{
	if ($conn->query($sql2) === TRUE) 
		{
          echo "<script>alert('Assigned successfully!');window.location.href=document.referrer;</script>";
		} 
	else {
    echo "Error: " . $conn->error;
		 }
	}
}
else
{


if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE ) 
	{
	
          echo "<script>alert('Assigned successfully!');window.location.href=document.referrer;</script>";
    }
	else {
    echo "Error: " . $conn->error;
		 }
	
}

$sql4 = "SELECT lecturer.lecturer_id,lecturer.title, lecturer.first_name, lecturer.last_name, sum(paper.paper_load) FROM lecturer, paper, offer, teaching WHERE  
			teaching.offer_id = offer.offer_id AND offer.paper_id = paper.paper_id 
			AND teaching.lecturer_id = lecturer.lecturer_id GROUP BY lecturer.lecturer_id order by lecturer_id desc";
			$result = $conn->query($sql4);

		$row = mysqli_fetch_array($result);
			$lecturerid = $row['lecturer_id'];
			$total = $row['sum(paper.paper_load)'];
$sql5 = "UPDATE lecturer set teaching_load = '$total' WHERE lecturer_id = '$lecturerid'";

		$conn->query($sql5);
		
		
		
$conn->close();
?>