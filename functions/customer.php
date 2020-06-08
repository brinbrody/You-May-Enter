<?php
require_once $_SERVER['DOCUMENT_ROOT']."/You-May-Enter/include/db.php";
session_start();
//Check if a userCode was passed AND that a worker is logged in
if(isset($_GET['userCode'])){
    if(isset($_SESSION['userId'])){
        scanQR();
        echo '<script>window.close();</script>';
    }else{
        header("Location: ../");
    }
}

function getCustomer($id){
    global $db;
    return mysqli_fetch_assoc($db->query("SELECT * FROM `customers` WHERE `id`=$id"));
}

//Return 0 when customer is in queue, and 1 when customer is in store, -1 if customer not found, 2 if they've left the store
function findCustomer($id){
    global $db;
    $customer = $db->query("SELECT `location` FROM `customers` WHERE `id`=$id")->fetch_object();
    return ($customer==null ? -1 : $customer->location);
}

//Either move the user to their next position, or create them if they do not exist
//Use case for known missing users: moveAlong(-1,someNameHere)
function moveAlong($id, $name=""){
    global $db;
    if($id==-1){
        $db->query("INSERT INTO `customers` (`name`,`location`) VALUES ('$name',0)");
        return;
    }
    $customer = mysqli_fetch_assoc($db->query("SELECT * FROM `customers` WHERE `id`=".$id));
    //Customer doesn't exist? No problem; we'll make one and stick them on the queue.
    if($customer == null){
        $db->query("INSERT INTO `customers` (`name`,`location`) VALUES ('$name',0)");
        return;
    }
    $loc= $customer['location'];
    switch($loc){
        case "0":
            $db->query("UPDATE `customers` SET `location`=1 WHERE `id`=".$id);
            break;
        case "1":
            $db->query("UPDATE `customers` SET `location`=2 WHERE `id`=".$id);
            break;
        default:
            $db->query("UPDATE `customers` SET `location`=-1 WHERE `id`=".$id);
    }
}

function scanQR(){ 
    //User codes will be passed as GET headers in format id_name
    //This function wil only run if the user is authenticated already - no security hazard here
    moveAlong($_GET['userCode']);
    header("Location: ../Phone_webpages/waiting_page");
}

?>