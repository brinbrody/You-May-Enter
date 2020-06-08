<!DOCTYPE html>
<html lang="en" class="background">
<?php
if(isset($_POST['username']) && isset($_POST['pwd'])){
  session_start();
  require_once('../include/db.php');
  $user = mysqli_fetch_assoc($db->query('SELECT * FROM `users` WHERE `username`='.$_POST['username']));
  if(md5($_POST['pwd'])==$user[password]){
    $_SESSION['userId']=$user['id'];
    header("Location: ../");
  }else{
    unset($_POST['username']);
    unset($_POST['pwd']);
    $_POST['loginFail']=true;
    header("refresh:10");
  }
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>You May Enter</title>

  <link rel="stylesheet" type="text/css" href="../css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">
</head>

<body>
  <div class="mainContainer">
    <div>
      <div class="mainContainerText">
        <h1 class="mainContainerTitle">You May Enter</h1>
        <form action="" method="POST">
          <br>
          <img src="../icons/person-circle.svg" class="sizeIcon">
          <input type="text" id="username" name="username" class="inputs" placeholder="Username"><br>
          <img src="../icons/lock.svg" class="sizeIcon">
          <input type="password" id="password" name="pwd" class="inputs" placeholder="Password"><br>
          <?php if(isset($_POST['loginFail'])){
            echo '<p>Login failed!</p>';
          }
          ?>
          <div class="centerText">
            <input type="submit" value="Log In" class="signInButton">
            <input type="submit" value="Register" class="registerButton">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
