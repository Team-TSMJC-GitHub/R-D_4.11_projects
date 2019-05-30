<?php
include_once("conn.php");
$field=explode(",",$_POST['id']);

$val=$_POST['value'];
$val = htmlspecialchars($val, ENT_QUOTES);
$val = trim($val,"S");

if(empty($val)){
    echo "Can not be Null!";
}else{
	$query=mysqli_query($conn,"update offer set $field[0]='$val' where paper_id ='$field[1]'");
	if($query){
	   echo "S".$val."";
	}else{
	   echo $field[1];	
	}
}
$conn->close();
?>