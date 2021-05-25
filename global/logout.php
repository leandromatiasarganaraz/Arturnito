<?php

session_start();

session_destroy();



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Logout</title>
</head>

<body class=" container-login">


  <style type="text/css">
    .container-login {
      width: 100%;
      min-height: 100vh;
      display: -webkit-flex;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      padding: 15px;
      background: -webkit-linear-gradient(to right, #84a9ac, #204051);
      background: linear-gradient(to right, #84a9ac, #204051);
    }
  </style>

  <div class="container d-flex justify-content-center">

    <h2>Cerrando sesión...<br> <br>
      <div class="spinner-grow text-white" role="status"> </div>
      <div class="spinner-grow text-white" role="status"> </div>
      <div class="spinner-grow text-white" role="status"> </div>
      <div class="spinner-grow text-white" role="status"> </div>
      <div class="spinner-grow text-white" role="status"> </div>
      <div class="spinner-grow text-white" role="status"> </div>
    </h2>
  </div>

  <div class="container-fluid justify-content-center">

  </div>
</body>

</html>

<script>
  setTimeout("location.href = '../index.php';", 2000);
</script>