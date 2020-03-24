<?php
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $database = "dynamische_applicatie";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    $query = $conn->prepare("SELECT * FROM characters");

    // $query->bindParam(":id", $subject);
    $query->execute();

    $result = $query->fetchAll();
 
    $query = $conn->prepare("SELECT * FROM characters WHERE id = :id");
    $query->execute([':id' => $_GET['id']]);
    $person = $query->fetch();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Character - Bowser</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet"/>
</head>
<body>
<header><h1><?php  echo $person['name']; ?> </h1>
    <a class="backbutton" href="index.php"><i class="fas fa-long-arrow-alt-left"></i> Terug</a></header>
<div id="container">
    <div class="detail">
        <div class="left">                              
            <img class="avatar" src="resources/images/<?php echo $person['avatar']; ?>">
            <div class="stats" style="background-color: <?php echo $person['color']?>">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-heart"></i></span> <?php echo $person ['health']?></li>
                    <li><span class="fa-li"><i class="fas fa-fist-raised"></i></span> <?php echo $person ['attack']?></li>
                    <li><span class="fa-li"><i class="fas fa-shield-alt"></i></span> <?php echo $person ['defense']?></li>
                </ul>
                <ul class="gear">
                    <li><b>Weapon</b>: <?php  echo $person['weapon']; ?></li>
                    <li><b>Armor</b>: <?php  echo $person['armor']; ?></li>
                </ul>
            </div>
        </div>
        <div class="right">
            <p>
                <?php echo $person ['bio']?>
            </p>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<footer>&copy; Rick Snijders - 2020</footer>
</body>
</html>