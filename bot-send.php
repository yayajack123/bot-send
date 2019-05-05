<?php

include __DIR__.'/vendor/autoload.php';

use Discord\Discord;
 
$discord = new Discord([
  'token' => 'NTcyMzEwNTY2ODYyMDYxNTk4.XMgn5Q.P8gvuqmswtR-YeEFB0EZP86aNIc'
]);


 
$discord->on('ready', function ($discord) { 
  $discord->on('message', function ($message, $discord) {
    $con=mysqli_connect("remotemysql.com","o0LTXYuQII","WbVXwbo7Wo","o0LTXYuQII");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 $result = mysqli_query($con, "SELECT id, text_send from tb_chat WHERE flag = '0'");
	
	while ( $row = mysqli_fetch_assoc($result)) {
            $idd = $row["id"];
            $text = $row["text_send"];
            echo $idd;
            $get_id = mysqli_query($con, "SELECT id from tb_chat WHERE id = $idd");
            $message->channel->sendMessage($text);
            print_r($text);
            mysqli_query($con, "UPDATE tb_chat set flag = '1' where id=$idd");
    }

    
    
    mysqli_close($con);
    });
});
$discord->run();

?>
