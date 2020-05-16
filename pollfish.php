<?php
include "db.php";
extract($_REQUEST);

$sql = mysqli_query($link,"INSERT INTO pollfish SET device_id = '$device_id',cpa='$cpa',request_uuid='$request_uuid',timestamp ='$timestamp',tx_id='$tx_id',signature='$signature',
reward_name='$reward_name',reward_value='$reward_value'");

if($sql) {
    $date = date("Y-m-d");
    $tracker = mysqli_query($link, "INSERT INTO tracker SET username = '$request_uuid',points='$reward_value',type='Servey Complete Point',date='$date' ");
    $points = mysqli_query($link, "UPDATE users SET points = points+'$reward_value' WHERE username='$request_uuid'");
}else {
    $sql = mysqli_query($link,"INSERT INTO pollfish SET device_id = 'null'");
}

?>