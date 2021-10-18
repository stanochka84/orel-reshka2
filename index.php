<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orel & reshka</title>
</head>
<body>
  <h1>Вітаємо на грі!</h1>
  <h2>Орел і решка</h2>
    <?php
      if(isset($_POST["diff"])){
        $diff = $_POST["diff"];
      }else{
        $diff = 0;
      }
      if(isset($_POST["money"])){
        $money = $_POST["money"];
      }else{
        $money = 20;
      }
      echo("<p>Ваш капітал: ". $money ." грн</p>");
      $money -= 5;
    ?>
    <form action="game.php" method="POST">
          <input type="hidden" name="level" value="easy">
          <input type="hidden" name="count" value="0">
          <input type="hidden" name="win" value="0">
          <input type="hidden" name="diff" value="<?php echo($diff); ?>">
          <input type="hidden" name="money" value="<?php echo($money); ?>">
          <input type="submit" value="Легенько">
    </form>
    <form action="game.php" method="POST">
          <input type="hidden" name="level" value="medium">
          <input type="hidden" name="count" value="0">
          <input type="hidden" name="win" value="0">
          <input type="hidden" name="diff" value="<?php echo($diff); ?>">
          <input type="hidden" name="money" value="<?php echo($money); ?>">
          <input type="submit" value="Середнячок" <?php if($diff < 1) echo("disabled"); ?>>
    </form>
    <form action="game.php" method="POST">
          <input type="hidden" name="level" value="hard">
          <input type="hidden" name="count" value="0">
          <input type="hidden" name="win" value="0">
          <input type="hidden" name="diff" value="<?php echo($diff); ?>">
          <input type="hidden" name="money" value="<?php echo($money); ?>">
          <input type="submit" value="Важко" <?php if($diff < 2) echo("disabled"); ?>>
    </form>
</body>
</html>

      