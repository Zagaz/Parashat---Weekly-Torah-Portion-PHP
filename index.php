<?php
require 'parashat.php';
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
<?php
$myTempDate = DateTime::createFromFormat('Y-m-d', $parashat_date);
$formatParashatDate = $myTempDate->format('m/d/Y');


?>
  <h2><?php echo $formatParashatDate;  ?></h2>
  <h1>This week's parashat: <?php echo $parashat_title; ?></h1>
  <h3>Hebrew name: <?php echo $parashat_hebrew; ?></h3>
  <p>Torah book: <?php echo $parashat_torah; ?></p>
  <p><?php echo $haftorah; ?></p>


  
</body>
</html>