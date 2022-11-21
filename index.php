<?php
//Just place the 'parashat.php'
require 'parashat.php';

/*The it will place an array with the following array (example):

(
  [parashat_title] => Shoftim 
  [parashat_date] => 2022-09-03 
  [parashat_hebrew] => פרשת שופטים
  [parashat_torah] => Devarim/Deuteronômio
  [haftorah] => Isaiah 51:12-52:12
)
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h3>This is an example page.</h3>


  <h1>This week's parashat: <?php echo $parashat_title; ?></h1>
  <h3>Hebrew name: <?php echo $parashat_hebrew; ?></h3>
  <p>Torah book: <?php echo $parashat_torah; ?></p>
  <p><?php echo $haftorah; ?></p>


  
</body>
</html>