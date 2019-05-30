<?php
include_once("conn.php");
$field=explode(",",$_POST['id']);

$val=$_POST['value'];
$val = htmlspecialchars($val, ENT_QUOTES);

if(empty($val)){
    echo "Can not be Null!";
}else{
	$query=mysqli_query($conn,"update phd set $field[0]='$val' where phd_id ='$field[1]'");
	if($query){
	   echo $val;
	}else{
	   echo $field[1];	
	}
}
$conn->close();
?>