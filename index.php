<?php

require 'dbconnect.php';
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

$output = '';
//get profile by id
//SELECT * FROM heroes
//display in jumbotron
//<div jumbotron>
//$output name about_me bio
//where $row[id] display 
//display jumbotron by clicked on 


if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    //var_dump($row);
    $output .= "<a href='/index.php?profileid=$row[id]'>" . $row["name"] . "</a> <br>";
  }
} else {
  echo "0 results";
}
$ally = "SELECT * FROM heroes WHERE heroes.id
IN (SELECT hero2_id FROM relationships WHERE hero1_id = " . $_GET['profileid'] . " AND type_id = '1')";
$newAlly = $conn->query($ally);
$enemy = "SELECT * FROM heroes WHERE heroes.id
IN (SELECT hero2_id FROM relationships WHERE hero1_id = " . $_GET['profileid'] . " AND type_id = '2')";
$newEnemy = $conn->query($enemy);

$newOutput = '';
$profile = "SELECT name, about_me, biography, image_url FROM heroes WHERE id=" . $_GET['profileid'];
$getProf = $conn->query($profile);
$conn->close();
?>



<!doctype html>
<html lang="en">

<head>
  <title><?php echo $pageTitle ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel='stylesheet' href="style.css">
</head>
<?php include "header.php" ?>

<body>


  <ul>

    <?php

    echo $output;


    ?>

  </ul>
  <?php if ($getProf->num_rows > 0) {
    while ($row = $getProf->fetch_assoc()) { ?>
      <div class='jumbotron jumbotron-fluid text-center'>
        <div class='col-9 text-center'>

          <h2> <?php echo $row['name']; ?> </h2>
          <p> <?php echo $row['about_me']; ?></p> <br>
          <p><?php echo $row['biography']; ?> </p> <br>
          <img alt='HeroPicture' src="<?php echo $row['image_url']; ?>" />
          <div class='col-4'>
            <h3>Friends</h3>
            <?php if ($newAlly->num_rows > 0) {
              while ($allyrow = $newAlly->fetch_assoc()) { ?>
                <div class='card'>
                  <div class='row-4'>

                  <img class='card-img-top img-fluid rounded float-left' src="<?php echo $allyrow['image_url'];  ?>" />
                  <div class='card-body'>
                    <h4><?php echo $allyrow['name']; ?></h4>
                    <form method='POST' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                      <a type='submit' class='btn btn-danger'>Remove Friend</a>
                    </form>
                  </div>
              </div>

                </div>
                
                  

                </div>
            <?php
              }
            }
            ?>
            <div class='row-4'>
                  <h3>Amnemonemomnes</h3>
                  <?php if ($newEnemy->num_rows > 0) {
              while ($enemyrow = $newEnemy->fetch_assoc()) { ?>
                <div class='card'>

                  <img class='card-img-top img-fluid rounded float-left' src="<?php echo $enemyrow['image_url'];  ?>" />
                  <div class='card-body'>
                    <h4><?php echo $enemyrow['name']; ?></h4>
                    <form method='POST' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                      <a type='submit' class='btn btn-danger'>Remove Enemy</a>
                    </form>
                  </div>

                </div>
                <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
  <?php
    }
  }
  ?>





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<?php include 'footer.php'
?>

</html>

<?php //include "delOrAdd.php" 
?>