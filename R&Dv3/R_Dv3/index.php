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

.div-inline
{
	float:right;
	margin: 0.5%;
};
.auto{
	object-fit: cover;
};
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
	 $('.edit2').editable('saveOffer.php', { 
		 width     :80,
		 height    :20,
		 //onblur    : "ignore",
         cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
     });
	 $('.edit3').editable('saveLecturer.php', { 
		 width     :80,
		 height    :20,
		 //onblur    : "ignore",
         cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
     });
	 $('.edit4').editable('saveOffertime.php', { 
		 width     :80,
		 height    :20,
		 //onblur    : "ignore",
         cancel    : 'Cancel',
         submit    : 'Submit',
         indicator : '<img src="css/loader.gif">',
         tooltip   : 'Click to edit...',
     });
	 
	 $('.edit5').editable('saveOfferyear.php', { 
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
	  <div class="div-inline" >
			<img src="img/AUT-logo-block.jpg" alt="AUT-logo-block" width="200" height="200">
		</div>
		</header>
	  <main>
	    <div class="container">
	      <section>
		  
	        <?php
			require_once("conn.php");
	        $sql = "SELECT paper.paper_id, paper.internal_id, paper.name,paper.paper_load, offer.semester, offer.offer_id, offer.year, offer.time, lecturer.lecturer_id, lecturer.first_name, lecturer.last_name FROM paper, offer, lecturer 
			WHERE paper.paper_id = offer.paper_id AND offer.offer_id = lecturer.offer_id ORDER BY offer.year, paper.internal_id ASC";
			$result = $conn->query($sql);
    
	echo "<table>
<tr>
<th>Paper ID</th>
<th>Paper Name</th>
<th>Year</th>
<th>Semester</th>
<th>Paper Time</th>
<th>Paper Load</th>
<th>Lecturer Name</th>
<th>       </th>
</tr>";
if ($result->num_rows >0) {
	while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td class = 'edit' id='internal_id,". $row['paper_id']."'>" . $row['internal_id'] . "</td>";
	echo "<td class = 'edit' id='name,". $row['paper_id']."'>" . $row['name'] . "</td>";
	echo "<td class = 'edit5' id='year,". $row['paper_id']."' >" . $row['year'] . "</td>";
	echo "<td class = 'edit2' id='semester,". $row['paper_id']."' >S" . $row['semester'] . "</td>";
	echo "<td class = 'edit4' id='time,". $row['paper_id']."'>" . $row['time'] . "</td>";
	echo "<td class = 'edit' id='paper_load,". $row['paper_id']."'>" . $row['paper_load'] . "</td>";
	echo "<td>" . $row['first_name'] ." ". $row['last_name'] . "</td>";
	echo "<td><a href='delete.php?id=" . $row['offer_id'] . "'></ a>Delete Offer</td>";
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