<?php
 require_once("conn.php");
  error_reporting(0);
	$title = $_POST['title'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$dept = $_POST['dept'];
	$sad = $_POST['sad'];
	$sadwl= $_POST['sadwl'];
	$wl= $_POST['workload'];

if($sad==null){
	$sad="NONE";
}

 $sql = "INSERT INTO lecturer (title, first_name, last_name, departement, special_admin_duties, special_admin_duties_workload, workload_factor, supervision_load, teaching_load, total_load, offer_id) VALUES ('$title', '$fname', '$lname', '$dept', '$sad', '$sadwl', '$wl', '0','0','0', '0')";
 $result = $conn->query($sql);
 $getID = mysqli_insert_id($conn);
 
 
 $sql2 = "INSERT INTO supervision (lecturer_id,supervision_load, phd_id, masters_id, bcis_id) VALUES ('$getID', '0', '$getID','$getID','$getID')";
 $result2 = $conn->query($sql2);

 $sql3 = "INSERT INTO phd (phd_id, primary_load, non_primary) VALUES ('$getID','0','0')";
 $result3 = $conn->query($sql3);
 
 $sql4 = "INSERT INTO masters (masters_id, honors, 60pt_project, 90pt_thesis, 120pr_thesis, mphil) VALUES ('$getID','0','0','0','0','0')";
 $result4 = $conn->query($sql4);
 
 $sql5 = "INSERT INTO bcis (bcis_id, project) VALUES ('$getID','0')";
 $result5 = $conn->query($sql5);
 
if(result&&result2&&result3&&result4&&result5){
	echo "<script>alert('New lecturer added successfully!');window.location.href=document.referrer;</script>";
}else{
 
	echo "Failed : ".$conn->error;
}


$conn->close();
?>