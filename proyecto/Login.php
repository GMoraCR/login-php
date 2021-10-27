<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /proyecto');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM user WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /proyecto");
    } else {
      $message = 'Sorry, those credentials do not match';
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

<h1>Login</h1>
<span>or <a href="signup.php">registrese</a></span>

<form method="POST" action="login.php" name="signin-form">
    <div class="form-element">
        <label>EMAIL</label>
        <input type="text" name="email" placeholder="ingrese su correo" required/>
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="password" placeholder="ingrese su password"  required>
    </div>
    <button type="submit" name="login" value="login">Ingresar</button>    
</form>
</body>
</html>