<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AUT</title>
	<link rel="shortcut icon"  href="img/AUT-logo-tab.jpg" >
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

function showLecturer(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            
            xmlhttp = new XMLHttpRequest();
        } else {
            
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","showLecturer.php?l="+str,true);
        xmlhttp.send();
    }
}

</script>
<body>
	<div id="wrapper" class="wrapper">
	  <header class="header htmleaf-header">
			<h1>Lecturer <span> </span></h1>
		</header>
	  <main>
	    <div class="container">
		<form action="insertlect.php" method="POST">
	      <section>
	        <h1> </h1>
			<p>Title</p>
		<select name="title">
			<option value="Mr">Mr</option>
			<option value="Ms">Ms</option>
			<option value="Dr">Dr</option>
			<option value="Prof">Prof</option>
			<option value="Assoc Prof">Assoc Prof</option>
			<option value="Adj Prof">Adj Prof</option>
			<option value="Professor">Professor</option>
		</select>
		
			</br></br>
			<p>First name:</p>
			<input type="text" required="required" name="firstname"><br><br>
			
			<p>Last name:</p>
			<input type="text" required="required" name="lastname"><br><br>
			
			<p>Department:</p>
			<input type="text" required="required" name="dept"><br><br>
		
			<p>Special Admin duties / Arrangements:</p>
			<input type="text"  name="sad"><br><br>
			
			<p>Special Admin duties Workload:</p>
			<input type="text" required="required" name="sadwl" value="0"><br><br>
			
			<p>Workload Factor</p>
			<input type="text" required="required" name="workload" value="5"><br><br>

			<input type="submit" value="Submit">
			<br><br>
			<p><a href="supervision.php">Supervision</a></p>
		</form>
		<p><a href="showLecturers.php">Show All</a></p>
		
<?php
		  require_once("conn.php");
		  $sql ="SELECT * FROM lecturer ORDER BY lecturer_id desc";
		  $result = $conn->query($sql);
		  echo "<select name='lecturer' onchange='showLecturer(this.value)''>";
		  echo "<option value=''>Select lecturer</option>";
		  if ($result->num_rows >0) {
			  while($row = $result->fetch_assoc()){
			echo "<option value='".$row['lecturer_id']."'>".$row['first_name']."  ". $row['last_name']. "</option>";
		
		}}
		echo "</select>";
		
		?>
			<div id="txtHint">
<?php
require_once("conn.php");
$sql = "SELECT lecturer_id, title, first_name, last_name, special_admin_duties FROM lecturer ORDER BY lecturer_id desc LIMIT 1" ;
$result = $conn->query($sql);

echo "<table>
<th>Title</th>
<th>Last Name</th>
<th>First Name</th>
<th>Special Admin duties / Arrangements</th>
</tr>";

if ($result->num_rows >0) {
	

	
	while($row = mysqli_fetch_array($result)){
	echo "<tr>";
    echo "<td >" . $row['title'] . "</td>";
	echo "<td class = 'edit' id='last_name,". $row['lecturer_id']."'>" . $row['last_name'] . "</td>";
	echo "<td class = 'edit' id='first_name,". $row['lecturer_id']."'>" . $row['first_name'] . "</td>";
	echo "<td class = 'edit' id='special_admin_duties,". $row['lecturer_id']."'>" . $row['special_admin_duties'] . "</td>";
	echo "</tr>";
	}
}
	echo "</table>";


?>
			
			
			</div>

		
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