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
		<h1>Teaching Allocation</h1>
		</header>
	  <main>
	    <div class="container">
	      <section>
	        <h2>Assigning Course</h2>
			<form action="insertteaching.php" method="POST">
	        <p>Year, Semester, Paper Code, Paper Name</p>
			<?php
		  require_once("conn.php");
		  $sql ="SELECT offer.offer_id, offer.year, offer.semester, paper.internal_id, paper.name FROM offer, paper WHERE offer.paper_id=paper.paper_id";
		  $result = $conn->query($sql);
		 
		  echo "<select name='offerid' required='required'>";
		  echo "<option value=''></option>";
		  if ($result->num_rows >0) {
			  while($row = $result->fetch_assoc()){
			echo "<option value='".$row['offer_id']."'>Year: ".$row['year'].", Semester: ".$row['semester'].", Paper Code: ".$row['internal_id'].", Paper Name :".$row['name']."</option>";
		}}
		echo "</select>";
		?>
			<br><br>
			<p>Lecturer 1</p>
			<?php
			require_once("conn.php");
			$sql ="SELECT * FROM lecturer";
			$result = $conn->query($sql);
			echo "<select name='lecturer' required='required'>";
			echo "<option value=''></option>";
			if ($result->num_rows >0) {
			while($row = $result->fetch_assoc()){
			echo "<option value='".$row['lecturer_id']."'>".$row['first_name']."  ".$row['last_name']."</option>";
		}}
		echo "</select>";
			?>
			<br><br>
			<p>Lecturer 2(Optional)</p>
			<?php
			require_once("conn.php");
			$sql ="SELECT * FROM lecturer";
			$result = $conn->query($sql);
			echo "<select name='lecturer2'>";
			echo "<option value=''></option>";
			if ($result->num_rows >0) {
			while($row = $result->fetch_assoc()){
			echo "<option value='".$row['lecturer_id']."'>".$row['first_name']."  ".$row['last_name']."</option>";
		}}
		echo "</select>";
			?></br></br>
			<input type="submit" value="Submit">
			</form>
			<br/><br/>
<?php
			require_once("conn.php");
	        $sql = "SELECT paper.name, paper.internal_id FROM paper,offer WHERE offer.offer_id IN (SELECT offer_id FROM offer WHERE offer_id NOT IN (SELECT offer_id FROM teaching)) AND paper.paper_id = offer.paper_id" ;
			$result = $conn->query($sql);
    
	echo "<table>
	
<th>Paper Name</th>
<th>Paper Code</th>

</tr>";

	
if ($result->num_rows >0) {
	
	while($row = mysqli_fetch_array($result)){
		
	echo "<tr>";
    echo "<td >" . $row['name'] . "</td>";
	echo "<td >" . $row['internal_id'] . "</td>";

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