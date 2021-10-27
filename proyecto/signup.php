<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>

<html>
<head>
<meta charset="UTF-8">
<title>Proyecto</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php require 'partials/header.php'  ?>
<?php if(!empty($message)): ?>
    <p><?=$message?></p>
<?php endif; ?>  


<h1>Registrese</h1>
<span>or<a href="login.php">loguese</a></span>

<form method="POST" action="signup.php" name="signin-form">
    <div class="form-element">
        <label>EMAIL</label>
        <input type="text" name="email" placeholder="ingrese su correo" required/>
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="password" placeholder="ingrese su password"  required>
    </div>
    <div class="form-element">
        <label>Confirme el Password</label>
        <input type="password" name="C_password" placeholder="ingrese su password"  required>
    </div>
    <button type="submit" name="login" value="login">Ingresar</button>    
</form>
</body>
</html>