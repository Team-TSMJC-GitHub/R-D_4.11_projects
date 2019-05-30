<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Papers Form</title>
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
	 $('.edit').editable('savePaper.php', { 
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
			<h1> Papers </h1>
		</header>
	  <main>
	    <div class="container">

	<form action="paperprocess.php" method="POST">

	      <section>
	        <h1></h1>

	       <p>Paper ID</p>
			<input type="text" required="required" name="internalid"><br><br>
 		<p>Add paper name</p>
			<input type="text" required="required" name="papername"><br><br>

		 <p>Course Type</p>
			<select name="coursetype">
		<option value="undergraduate">Undergraduate Course</option>
		<option value="postgraduate">Postgraduate Course</option>
		</select><br><br>
		
		 <p>Workload</p>
		<input type="text" required="required" name="Workload" value="1">
	<br/><br>
	<br/><button type="post" value="Post">Post</button>
	<button type="reset" value="Reset">Reset</button>
	<br/>

		</form>


<?php
			require_once("conn.php");
	        $sql = "SELECT paper.paper_id, paper.name, paper.internal_id FROM paper" ;
			$result = $conn->query($sql);
    
	echo "<table>
	
<th>Paper Name</th>
<th>Paper Code</th>

</tr>";

	
if ($result->num_rows >0) {
	
	while($row = mysqli_fetch_array($result)){
		
	echo "<tr>";
    echo "<td class = 'edit' id='name,". $row['paper_id']."'>" . $row['name'] . "</td>";
	echo "<td class = 'edit' id='internal_id,". $row['paper_id']."'>" . $row['internal_id'] . "</td>";


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