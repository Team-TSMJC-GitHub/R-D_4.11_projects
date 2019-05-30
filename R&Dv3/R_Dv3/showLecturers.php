<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AUT</title>
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,700">
  	<link rel="stylesheet" href="css/style.min.css">
</head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
	text-align: center;
}

th {text-align: center;
	color:red;
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.mini.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js'></script>
<script type="text/javascript">
$(function(){
	
	 $('.edit').editable('saveLecturer.php', { 
		 width     :80,
		 height    :20,
		 //onblur    : "ignore",
         cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
     });
	
	 
	 $('.edit_select').editable('save.php', { 
		 loadurl   : 'json.php',
		 type      : "select",
		 cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
		 style     : 'display: inline'
	 });
	 $(".datepicker").editable('save.php', { 
		 width     : 120,
		 type      : 'datepicker',
		 onblur    : "ignore",
		 cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
		 style     : 'display: inline'
	 });
	 $(".textarea").editable('save.php', { 
		 type      : 'textarea',
		 rows      : 6,
		 cols      : 50,
		 onblur    : "ignore",
		 cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">'
	 });	 
});

$.editable.addInputType('datepicker', {
    element : function(settings, original) {
        var input = $('<input class="input" />');
		input.attr("readonly","readonly");
        $(this).append(input);
        return(input);
    },
    plugin : function(settings, original) {
		var form = this;
		$("input",this).datepicker();
    }
});
</script>
<body>
	<div id="wrapper" class="wrapper">
	  <header class="header htmleaf-header">
			<h1>All Lecturer <span> </span></h1>
		</header>
	  <main>
	    <div class="container">
	      <section>
	        <?php
			require_once("conn.php");

			$sql2 = "SELECT lecturer_id FROM lecturer WHERE lecturer_id NOT IN (SELECT lecturer.lecturer_id FROM lecturer,teaching WHERE lecturer.lecturer_id IN (teaching.lecturer_id, teaching.lecturer_id2) AND lecturer.offer_id = teaching.offer_id)";
			$result2 = $conn->query($sql2);
			
	
	        $sql = "SELECT lecturer.*, paper.internal_id, paper.name FROM lecturer, paper, teaching, offer WHERE lecturer.lecturer_id IN (teaching.lecturer_id, teaching.lecturer_id2) AND teaching.offer_id = offer.offer_id 
			AND offer.paper_id = paper.paper_id
			ORDER BY total_load DESC";
			$result = $conn->query($sql);
			

	
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

if ($result2->num_rows >0) {
	while($row2 = $result2->fetch_assoc()){

$sql3 = "SELECT * FROM lecturer WHERE lecturer_id = '". $row2['lecturer_id']. "'" ;
 
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
}




if ($result->num_rows >0) {
	while($row = $result->fetch_assoc()){
		 
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
		
		$sql2 = "UPDATE lecturer SET total_load = '$total' WHERE lecturer_id='". $row['lecturer_id']."'";
		$result2 = $conn->query($sql2);
	}
}

	echo "</table>";


	        ?>
	      </section>
	    </div>
	  </main>
	</div><!-- /wrapper -->

	
	<button id="mm-menu-toggle" class="mm-menu-toggle">Toggle Menu</button>
	<nav id="mm-menu" class="mm-menu">
	  <div class="mm-menu__header">
	    <h2 class="mm-menu__title">Teaching Assement  System</h2>
	  </div>
	  <ul class="mm-menu__items">
		<li class="mm-menu__item">
	      <a class="mm-menu__link" href="index.php">
	        <span class="mm-menu__link-text"><i class="md md-home"></i> Home</span>
	      </a>
	    </li>
		
	    <li class="mm-menu__item">
	      <a class="mm-menu__link" href="paperform.php">
	        <span class="mm-menu__link-text"><i class="md md-settings"></i> Paper</span>
	      </a>
	    </li>
		
	    <li class="mm-menu__item">
	      <a class="mm-menu__link" href="offer.php">
	        <span class="mm-menu__link-text"><i class="md md-favorite"></i> Offer</span>
	      </a>
	    </li>
		
	    <li class="mm-menu__item">
	      <a class="mm-menu__link" href="lecturer.php">
	        <span class="mm-menu__link-text"><i class="md md-person"></i> Lecturer</span>
	      </a>
	    </li>
		
		<li class="mm-menu__item">
	      <a class="mm-menu__link" href="teaching.php">
	        <span class="mm-menu__link-text"><i class="md md-inbox"></i> Teaching Allocation</span>
	      </a>
	    </li>
	    
	  </ul>
	</nav><!-- /nav -->
	
	<script src="js/production/materialMenu.min.js"></script>
	<script>
	  var menu = new Menu;
	</script>
</body>
</html>