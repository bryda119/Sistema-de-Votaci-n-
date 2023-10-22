<?php
session_start();
if (isset($_SESSION['admin'])) {
  header('location: admin/home.php');
}

if (isset($_SESSION['voter'])) {
  header('location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="images/sj.jpeg">
    <title>Inicio de Sesión - San José Técnico</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
      body {
        background: url('images/colegio.jpeg') no-repeat center center fixed;
        background-size: cover;
        background-color: #f4f4f4; /* Fallback color */
      }
      .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      .login-box {
        width: 400px;
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
      }
      .login-logo img {
        max-width: 100px;
        display: block;
        margin: 0 auto;
      }
      .login-logo h3 {
        margin-top: 10px;
        color: #333;
      }
      .login-box-msg {
        font-size: 18px;
        margin-top: 15px;
        color: #333;
      }
      .form-group {
        margin-bottom: 15px;
      }
      .form-control {
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 3px;
        padding: 5px;
        font-size: 16px;
      }
      .btn-primary {
        background-color: #0073e6;
        color: #fff;
        border: none;
        font-size: 18px;
        width: 100%;
        cursor: pointer;
      }
      .btn-primary:hover {
        background-color: #0056b3;
      }
      .callout {
        margin-top: 20px;
      }
    </style>
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <div class="login-logo">
        <img src="images/sj.jpeg" alt="San José Técnico">
        <h3>Sistema de Votaciones Estudiantiles</h3>
      </div>
      <p class="login-box-msg">Iniciar Sesión</p>
      <form action="login.php" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="voter" placeholder="Cédula del Estudiante" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="login">
            <i class="fa fa-sign-in"></i> Iniciar Sesión
          </button>
        </div>
      </form>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
      echo "<div class='callout callout-danger text-center'>
          <p>" . $_SESSION['error'] . "</p>
        </div>";
      unset($_SESSION['error']);
    }
    ?>
  </div>

  <!-- Puedes incluir los scripts necesarios aquí -->

</body>
</html>
