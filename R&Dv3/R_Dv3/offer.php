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
<body>
	<div id="wrapper" class="wrapper">
	  <header class="header htmleaf-header">
			<h1> <span> </span></h1>
		</header>
	  <main>
	    <div class="container">
	      <section>
		  <form action="insertoffer.php" method = "POST">
			<h1>Add Offering</h1>
			<p>Paper Code, Name</p>
		<?php
		  require_once("conn.php");
		  $sql ="SELECT * FROM paper";
		  $result = $conn->query($sql);
		  echo "<select name='paper' required='required'>";
		  echo "<option value=''></option>";
		  if ($result->num_rows >0) {
			  while($row = $result->fetch_assoc()){
			echo "<option value='".$row['paper_id']."'>".$row['internal_id']." ,". $row['name']. "</option>";
		
		}}
		echo "</select>";
		
		?>
			<p>Year</p>
			<input type="text" required="required" name="year"><br><br>
			<p>Semester</p>
			<select name="sem">
				<option value="1">S1</option>
				<option value="2">S2</option>
			</select><br><br>
			<p>Time</p>
			<input type="time" required="required" name="time1"> --- <input type="time" required="required" name="time2"><br><br>
			<p>Day of week</p>
			<select name="day">
				<option value="Monday">Monday</option>
				<option value="Tuesday">Tuesday</option>
				<option value="Wednesday">Wednesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Friday">Friday</option>
			</select>
			<br><br>
			<input type="submit" value="Submit">
			<br><br>
			</form>
			
<?php
			
	        $sql = "SELECT offer.year, offer.semester, offer.time, paper.internal_id, paper.name FROM offer, paper WHERE offer.paper_id = paper.paper_id";
			$result = $conn->query($sql);
    
	echo "<table>
<th>Paper Code</th>
<th>Paper Name</th>
<th>Time</th>
<th>semester</th>
<th>Year</th>

</tr>";

	
if ($result->num_rows >0) {
	
	while($row = mysqli_fetch_array($result)){
	echo "<tr>";
    echo "<td >" . $row['internal_id'] . "</td>";
	echo "<td >" . $row['name'] . "</td>";
	echo "<td >" . $row['time'] . "</td>";
	echo "<td >" . $row['semester'] . "</td>";
	echo "<td >" . $row['year'] . "</td>";
	
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