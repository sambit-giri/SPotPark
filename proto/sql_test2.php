 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SpotPark";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO Block A (Spot, Number_Plate) VALUES (?, ?)");
$stmt->bind_param("ss", $firstname, $lastname);

// set parameters and execute
$firstname = "1";
$lastname = "";
$email = "False";
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?>
