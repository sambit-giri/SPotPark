
<html>

<head>
<style>
.quarterCircleTopLeft{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 190px 0 0 0;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 4px 2px;
     cursor: pointer;
}
.quarterCircleTopRight{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 0 190px 0 0;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 4px 2px;
     cursor: pointer;
}
.quarterCircleBottomLeft{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 0 0 0 190px;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 4px 2px;
     cursor: pointer;
}
.quarterCircleBottomRight{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 0 0 190px 0;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 2px 2px;
     cursor: pointer;
}

form {
  text-align: center;
}

</style>
</head>

<br>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<p align='center'> <font color=red  size='5pt'>
Number Plate <br><input align="middle" type="text" name="number_plate" value='0000'> <br>
</font> </p> <br>

<input align="middle" type="submit" class="quarterCircleTopLeft" name="quadrant" value="1"/> 
<input align="middle" type="submit" class="quarterCircleTopRight" name="quadrant" value="2"/>
<br>
<input align="middle" type="submit" class="quarterCircleBottomLeft" name="quadrant" value="3"/> 
<input align="middle" type="submit" class="quarterCircleBottomRight" name="quadrant" value="4"/> 

</form>

 <?php

function savedata_IOT($num_plate, $time_in, $time_out, $block) {
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "SpotPark";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO Parking_IOT (`Number_Plate`, `Time_In`, `Time_Out`, `Block`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $num_plate, $time_in, $time_out, $block);
$stmt->execute();

//echo "<p align='center'>New records created successfully in the IOT.</p>";

$stmt->close();
$conn->close();
}

function get_spot($block,$num_plate){
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "SpotPark";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($block=='1'){
$sql = "SELECT Spot, Number_Plate FROM `Block A`";
}
if($block=='2'){
$sql = "SELECT Spot, Number_Plate FROM `Block B`";
}
if($block=='3'){
$sql = "SELECT Spot, Number_Plate FROM `Block C`";
}
if($block=='4'){
$sql = "SELECT Spot, Number_Plate FROM `Block D`";
}

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // output data of each row
    $spot = '0';
    while($row = $result->fetch_assoc()) {
        //echo "Spot: " . $row["Spot"]. " - Number_Plate: " . $row["Number_Plate"]. "<br>";
	if($row["Number_Plate"]===NULL){
		if($spot=='0'){
			$spot = $row["Spot"];
			if($block=='1'){$sql1 = "UPDATE `Block A` SET Number_Plate=$num_plate WHERE Spot=$spot";}
			if($block=='2'){$sql1 = "UPDATE `Block B` SET Number_Plate=$num_plate WHERE Spot=$spot";}
			if($block=='3'){$sql1 = "UPDATE `Block C` SET Number_Plate=$num_plate WHERE Spot=$spot";}
			if($block=='4'){$sql1 = "UPDATE `Block D` SET Number_Plate=$num_plate WHERE Spot=$spot";}
			$conn->query($sql1);
		}
	}
	else{
	$spot = 0;	
	}
    }
} else {
    echo "0 results";
	}


$conn->close();
return $spot;
}

if(isset($_POST['quadrant'])){

// set parameters and execute
$num_plate = $_POST['number_plate'];//"4321";
$time_in   = date("Y-m-d h:i:sa");
$time_out  = date("Y-m-d h:i:sa");
$block     = $_POST['quadrant'];

savedata_IOT($num_plate, $time_in, $time_out, $block);
$spot = get_spot($block,$num_plate);
//echo $spot;

echo "<p align='center'> <font color=blue  size='6pt'>";
if($spot>0){
echo "Go to Block $block Spot $spot";
}
else{
echo "Sorry.";
echo "We have no Spot in Block $block.";
}
echo "</font> </p>";

}

?>

</html>
