<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM user WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/estilos.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php require 'partials/header.php' ?>

        <?php if(!empty($user)): ?>
           <br> Bienvenido.  <?= $user['email']; ?>
           <br>Se a logueado exitosamente en
           <a href="logout.php">Logout</a> 

        <?php else: ?>
            <h1>Por favor loguese o registrese</h1>
            <a href="login.php">Login</a>
            <a href="signup.php">registrese</a>
        <?php endif; ?>
    </body>
</html>