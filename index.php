<!DOCTYPE html>
<html lang="en" class="background">
<?php 
session_start();
//If they had a username set (in a previous iteration of the page), we can work with it to add them to the queue
if(isset($_POST['username'])){
  require_once('include/db.php');
  require_once('functions/customer.php');
  moveAlong(-1,$_POST['username']);
  $_SESSION['id'] = $db->insert_id;
  header("Location: Phone_webpages/waiting_page");
}
if(isset($_SESSION['id'])){
  header("Location: Phone_webpages/waiting_page");
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>You May Enter</title>

  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">
</head>

<body>
  <div class="mainContainer">
    <div class="mainContainerText">
        <h1 class="mainContainerTitle">You May Enter</h1>
        <form action="" method="POST">
          <br>
          <img src="icons/person-circle.svg" class="sizeIcon">
          <input type="text" id="username" name="username" class="inputs" placeholder="Your Name"><br>
          <div class="centerText">
            <input type="submit" value="Get in Line" class="submitButton">
          </div>
        </form>
    </div>
    <div class="staffLogin"><a href="PC_webpages/login" >Staff Login</a></div>
  </div>
</body>

</html>
