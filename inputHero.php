<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<body>
    <?php include 'header.php'
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        Hero Name: <input class='form-control' type="text" name="fname"><br>
        About Me: <input class='form-control' type="text" name="aboutMe"><br>
        Biography: <textarea class='form-control' /*style='background: linear-gradient(to right, #0062E6, #33AEFF)'*/ type='text' name='biography'></textarea><br>
        <input class='btn btn-primary' type='Submit' value="Create Hero" style='background: linear-gradient(to right, #0062E6, #33AEFF)' href='./index.php'>
    </form>

    <?php
    require 'dbconnect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //collect value of input field
        $name = $_POST['fname'];
        $abtME = $_POST['aboutMe'];
        $bio = $_POST['biography'];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO heroes (name, about_me, biography)
    VALUES ('$name', '$abtME','$bio')";
        if ($conn->query($sql) === TRUE) {
            echo '';
        } else {
            echo '';
        }
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
    if ($sql != null){
        header('Location: index.php');
        exit;
    }
    

include 'footer.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>