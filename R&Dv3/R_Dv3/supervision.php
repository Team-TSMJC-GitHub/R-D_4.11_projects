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
	 $('.edit').editable('savePhD.php', { 
		 width     :80,
		 height    :20,
		 //onblur    : "ignore",
         cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
     });
	 $('.edit2').editable('saveMasters.php', { 
		 width     :80,
		 height    :20,
		 //onblur    : "ignore",
         cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
     });
	 
	 $('.edit3').editable('saveBcis.php', { 
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


</script>
<body>
	<div id="wrapper" class="wrapper">
	  <header class="header htmleaf-header">
			<h1>Supervision <span> </span></h1>
		</header>
	  <main>
	    <div class="container">
	      <section>
	        <?php
			require_once("conn.php");
	        $sql = "SELECT lecturer.lecturer_id, lecturer.title, lecturer.first_name, lecturer.last_name, supervision.*, phd.*, masters.*, bcis.* FROM lecturer, supervision, phd, masters, bcis WHERE lecturer.lecturer_id = supervision.lecturer_id 
			AND supervision.phd_id = phd.phd_id AND supervision.masters_id = masters.masters_id AND supervision.bcis_id = bcis.bcis_id";
			$result = $conn->query($sql);
    
	echo "<table>
<th>Title</th>
<th>Last Name</th>
<th>First Name</th>

<th>PhD Primary(1)</th>
<th>PhD non-Primary(0.25)</th>
<th>PhD Total</th>

<th>Masters Honours(0.5)</th>
<th>Masters 60pt project(0.5)</th>
<th>Masters 90pt thesis(0.5)</th>
<th>Masters 120pt thesis(1)</th>
<th>Masters Mphil(1)</th>
<th>Masters Weighted Total</th>

<th>BCIS R&D Project(1)</th>

<th>Total</th>

<th>Surpervision Load</th>
</tr>";
if ($result->num_rows >0) {
	while($row = $result->fetch_assoc()){
		$pt= $row['primary_load']*1+$row['non_primary']*0.25;
		$mt= $row['honors']*0.5+$row['60pt_project']*0.5+$row['90pt_thesis']*0.5+$row['120pr_thesis']*1+$row['mphil']*1;
		$bt= $row['project']*1;
		$total= $pt+$mt+$bt;
				
    echo "<tr>";
    echo "<td >" . $row['title'] . "</td>";
	echo "<td >" . $row['last_name'] . "</td>";
	echo "<td >" . $row['first_name'] . "</td>";
	
	echo "<td class = 'edit' id='primary_load, ". $row['phd_id']."'>" . $row['primary_load'] . "</td>";
	echo "<td class = 'edit' id='non_primary, ". $row['phd_id']."'>" . $row['non_primary'] . "</td>";
	echo "<td ><mark>$pt</mark></td>";
	
	echo "<td class = 'edit2' id='honors, ". $row['masters_id']."'>" . $row['honors'] . "</td>";
	echo "<td class = 'edit2' id='60pt_project, ". $row['masters_id']."'>" . $row['60pt_project'] . "</td>";
	echo "<td class = 'edit2' id='90pt_thesis, ". $row['masters_id']."'>" . $row['90pt_thesis'] . "</td>";
	echo "<td class = 'edit2' id='120pr_thesis, ". $row['masters_id']."'>" . $row['120pr_thesis'] . "</td>";
	echo "<td class = 'edit2' id='mphil, ". $row['masters_id']."'>" . $row['mphil'] . "</td>";
	echo "<td ><mark>$mt</mark></td>";
	
	echo "<td class = 'edit3' id='project, ". $row['bcis_id']."'>" . $row['project'] . "</td>";
	
	echo "<td ><mark>$total</mark></td>";
	
	if($total<=3){
	echo "<td >Low</td>";
	$supervision_total=0;
	}
	if($total>3&&$total<7){
	echo "<td >Moderate</td>";
	$supervision_total=0.5;
	}
	if($total>6){
	echo "<td >High</td>";
	$supervision_total=1;
	}
	
	$sql2 = "UPDATE lecturer set supervision_load = '$supervision_total' WHERE lecturer_id = " . $row['lecturer_id'] . "";
		$result2 = $conn->query($sql2);
	echo "</tr>";
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