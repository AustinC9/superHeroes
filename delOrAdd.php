<html>
<body>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
Remove Friend <input class='form-control' type="text" name="remFr">
<input class='btn btn-danger' type='Submit' value="Remove Friend" style='background: linear-gradient(to right, #b02e0c, #EB4511)'><br>
Add Friend <input class='form-control' type="text" name="addFrn">
<input class='btn btn-primary' type='Submit' value="Add Friend" style='background: linear-gradient(to right, #0062E6, #33AEFF)'>
<br>
Add Foe <input class='form-control' type="text" name="addFoe">
<input class='btn btn-primary' type='Submit' value="Add Foe" style='background: linear-gradient(to right, #b02e0c, #EB4511)'>
</form>

<?php
require 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //collect value of input field
    $name = $_POST['fname'];
    $abtME = $_POST['aboutMe'];
    $bio = $_POST['biography'];
    $names = '';
    if (empty($name)) {
        echo "Name is empty";
    }else {
        echo $name . '<br>' . $abtME . '<br>' . $bio;
    }
}
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$sql= "INSERT INTO heroes (name, about_me, biography)
VALUES ('$name', '$abtME','$bio')";
if ($conn->query($sql) === TRUE) {
    echo '';
}else {
    echo '';
}
// $newSql = "SELECT (name, about_me, biography) FROM heroes";
// $result = $conn->query($newSql);
// $output = '';
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       $output .= "<li> Name: " . $row["name"]. "<br>  About Me: " . $row["about_me"]. "<br> Biography: " . $row["biography"]. "</li>";
//         var_dump($result);
//     }
//   } else {
//     echo "0 results";
//   }

$conn->close();


?> 

</body>
</html>