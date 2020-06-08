<!DOCTYPE html>
<html lang="en" class="background">

<?php
  session_start();
  require_once('../include/db.php');
  require_once('../functions/customer.php');
  include('../vendor/phpqrcode/qrlib.php');
  if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $location = findCustomer($id);
    $lineNumber = mysqli_fetch_assoc($db->query("SELECT COUNT(`id`) AS numUsers FROM `customers` WHERE `id`<$id AND `location`=0"))['numUsers'];
    $name = getCustomer($id)['name'];
  }else{
    header("Location: ../");
  }
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="30">
  <title>You May Enter</title>

  <link rel="stylesheet" type="text/css" href="../css/waiting_page.css">
  <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">
</head>

<body>
  <div class="mainContainer">
    <div class="mainContainerText">
      <div class="thanksParagraph">Hello <?php echo $name; ?>. 
      <?php 
      switch($location){
        case -1:
          moveAlong(-1,$name);
          header("refresh: 0");
          break;
        case 0:
          echo 'Once it is your turn, please show this QR code at the door.';
          break;
        case 1:
          echo "You're in the store! When you're ready to leave, show this QR code at the door.";
          break;
        default:
          header("Location: ../index");
      }
      ?>
       </div>
      <?php 
        $code = QRcode::png('http://brinbrody.com/You-May-Enter/functions/customer.php?userCode='.$id.'_'.$name); 
        echo '<img src="$code"/>';
      ?>
      <!-- <div class="progressBar"></div> -->
      <?php if($location==0){ ?><br><div class="positionInLine">Position in Line: <?php echo $lineNumber; ?></div><br> <!-- if implementing progress bar, take out the br at end of the div and place before the div --> <?php } ?>
      <!--<button type="button" class="getOffTheLine">Get off the Line</button>-->
    </div>
  </div>
</body>

</html>
