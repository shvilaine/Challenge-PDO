<?php

require '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

$query = 'SELECT * FROM companion';
$statement = $pdo->query($query);
$companions = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);

        $query = "INSERT INTO companion (firstname, lastname) VALUES (:firstname, :lastname)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

        $statement->execute();
        $query = "INSERT INTO companion (firstname, lastname) VALUES ('Yazmin', 'Khan')";
        header('Location: /companions.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>compagnons</title>
</head>

<body>
    <h1>Les compagnons du Docteur</h1>
    <form action="" method='POST'>

        <ul>
            <?php foreach ($companions as $companion) :?>
                <li><?= $companion['firstname'] . ' ' . $companion['lastname']; ?></li>
            <?php endforeach; ?>
        </ul>
        <ul>
       
        <label for='firstname'>Prénom:</label>
        <input type='text' id='firstname' name='firstname' required=''>


        <label for='lastname'>Nom:</label>
        <input type='text' id='lastname' name='lastname' required=''>

        <button>Nouveau compagnon</button>
    </form>
</body>
</html>