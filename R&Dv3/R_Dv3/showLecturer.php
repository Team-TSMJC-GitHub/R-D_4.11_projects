<?php
require_once("conn.php");
$id = $_GET['l'];



echo "<table>
<th>Title</th>
<th>Last Name</th>
<th>First Name</th>
<th>Departement</th>
<th>Special Admin Duties</th>
<th>Special Admin Duties Workload</th>
<th>Workload Factor</th>
<th>Supervision Load</th>

<th>Papers are Teaching</th>

<th>Total (Teaching & Supervision)</th>

<th>Total (with Admin)</th>

<th>Percentage of Full Load</th>



<th></th>
</tr>";


$sql2 = "SELECT lecturer.*, paper.internal_id, paper.name FROM lecturer, paper, teaching, offer WHERE lecturer.lecturer_id IN (teaching.lecturer_id, teaching.lecturer_id2) AND teaching.offer_id = offer.offer_id 
			AND offer.paper_id = paper.paper_id AND lecturer.lecturer_id = '$id'" ;
 
$result2 = $conn->query($sql2);

if ($result2->num_rows >0) {
	while($row = $result2->fetch_assoc()){
		 
	$totalT = $row['teaching_load']+$row['supervision_load'];	 
	$total = $row['teaching_load']+$row['supervision_load']+$row['special_admin_duties_workload'];

	$percentage = ($row['teaching_load']+$row['supervision_load']+$row['special_admin_duties_workload']) / $row['workload_factor'];
	$percentage	= sprintf('%.2f',$percentage)*100;
		 
		 echo "<tr>";
		  
    echo "<td >" . $row['title'] . "</td>";
	echo "<td class = 'edit' id='last_name,". $row['lecturer_id']."'>" . $row['last_name'] . "</td>";
	echo "<td class = 'edit' id='first_name,". $row['lecturer_id']."'>" . $row['first_name'] . "</td>";
	echo "<td class = 'edit' id='departement,". $row['lecturer_id']."' >" . $row['departement'] . "</td>";
	echo "<td class = 'edit' id='special_admin_duties,". $row['lecturer_id']."' >" . $row['special_admin_duties'] . "</td>";
	echo "<td class = 'edit' id='special_admin_duties_workload,". $row['lecturer_id']."' >" . $row['special_admin_duties_workload'] . "</td>";
	echo "<td class = 'edit' id='workload_factor,". $row['lecturer_id']."' >" . $row['workload_factor'] . "</td>";
	echo "<td >" . $row['supervision_load'] . "</td>";
	
	
	
	echo "<td >" . $row['internal_id'] . "</td>";
	
	echo "<td > $totalT </td>";
	
	
	echo "<td >" . $row['total_load'] . "</td>";
	
	
	
	if($percentage>100 ){
	echo "<td style='color:Yellow; background-color:red'> $percentage %</td>";
	}
	
	if($percentage<101 ){
	echo "<td style='color:Yellow; background-color:green'> $percentage %</td>";
	}
	
	echo "<td><a href='deleteLecturer.php?id=" . $row['lecturer_id'] . "'></ a>Delete Lecturer</td>";
		echo "</tr>";
		
	}
}
else{
	$sql3 = "SELECT * FROM lecturer WHERE lecturer_id = '$id'" ;
 
	$result3 = $conn->query($sql3);

if ($result3->num_rows >0) {
	while($row3 = $result3->fetch_assoc()){
		 
	$totalT = $row3['teaching_load']+$row3['supervision_load'];	 
	$total = $row3['teaching_load']+$row3['supervision_load']+$row3['special_admin_duties_workload'];

	$percentage = ($row3['teaching_load']+$row3['supervision_load']+$row3['special_admin_duties_workload']) / $row3['workload_factor'];
	$percentage	= sprintf('%.2f',$percentage)*100;
		 
		 echo "<tr>";
		  
    echo "<td >" . $row3['title'] . "</td>";
	echo "<td class = 'edit' id='last_name,". $row3['lecturer_id']."'>" . $row3['last_name'] . "</td>";
	echo "<td class = 'edit' id='first_name,". $row3['lecturer_id']."'>" . $row3['first_name'] . "</td>";
	echo "<td class = 'edit' id='departement,". $row3['lecturer_id']."' >" . $row3['departement'] . "</td>";
	echo "<td class = 'edit' id='special_admin_duties,". $row3['lecturer_id']."' >" . $row3['special_admin_duties'] . "</td>";
	echo "<td class = 'edit' id='special_admin_duties_workload,". $row3['lecturer_id']."' >" . $row3['special_admin_duties_workload'] . "</td>";
	echo "<td class = 'edit' id='workload_factor,". $row3['lecturer_id']."' >" . $row3['workload_factor'] . "</td>";
	echo "<td >" . $row3['supervision_load'] . "</td>";
	
	
	
	echo "<td style='background-color:red'></td>";
	
	echo "<td > $totalT </td>";
	
	
	echo "<td >" . $row3['total_load'] . "</td>";
	
	
	
	if($percentage>100 ){
	echo "<td style='color:Yellow; background-color:red'> $percentage %</td>";
	}
	
	if($percentage<101 ){
	echo "<td style='color:Yellow; background-color:green'> $percentage %</td>";
	}
	
	echo "<td><a href='deleteLecturer.php?id=" . $row3['lecturer_id'] . "'></ a>Delete Lecturer</td>";
		echo "</tr>";
		
	}
}
}

?>