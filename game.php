<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orel & reshka_game</title>
</head>
<body>
  <h1>Орел та решка</h1>
    <?php
    echo("<p style='color: ");
    $level = $_POST["level"];
    $count = $_POST["count"];
    $win = $_POST["win"];
    if (isset($_POST["game"])){
      $count += 1;
      $choose = $_POST["game"];
      $rand = rand(0,1);
      if($choose == $rand){
        switch ($level) {
          case "hard":
            $rand = rand(0,1);
            if($choose == $rand){
              $win += 1;
              echo("green'>");
              echo("Ура! Ви вгадали!");
            }else{
              echo("red'>");
              echo("Майже вгадали.");
            }
          break;
          default:
            $win += 1;
            echo("green'>");
            echo("Ура! Ви вгадали!");
        }
      }else{
        switch ($level) {
          case "easy":
           $rand = rand(0,1);
           if($choose == $rand){
             $win += 1;
             echo("green'>");
             echo("Тобі пощастило!");
           }else{
            echo("red'>");
             echo("Не вгадав!");
           }
        break;
        default:
          echo("red'>");
          echo("Не вгадав!"); 
        }
      }
    }else{
      echo("blue'>");
      echo("Гра розпочалась!");
    }
    echo("</p>");
  ?>
  <form action="<?php
    if($count < 10){
      echo('game.php');
    }else{
      echo('resultats.php');
    }
    ?>" method="POST">
     <input type="hidden" name="level" value="<?php echo($level); ?>">
     <input type="hidden" name="count" value="<?php echo($count); ?>">
     <input type="hidden" name="win" value="<?php echo($win); ?>">
     <input type="hidden" name="diff" value="<?php echo($_POST['diff']); ?>">
     <input type="hidden" name="game" value="0">
     <input type="hidden" name="money" value="<?php echo($_POST['money']); ?>">
     <input type="submit" value="Орел">
  </form>
  <form action="<?php
    if($count < 10){
      echo('game.php');
    }else{
      echo('resultats.php');
    }
    ?>" method="POST">
     <input type="hidden" name="level" value="<?php echo($level); ?>">
     <input type="hidden" name="count" value="<?php echo($count); ?>">
     <input type="hidden" name="win" value="<?php echo($win); ?>">
     <input type="hidden" name="game" value="1">
     <input type="hidden" name="diff" value="<?php echo($_POST['diff']); ?>">
     <input type="hidden" name="money" value="<?php echo($_POST['money']); ?>">
     <input type="submit" value="Решка">
  </form>
</body>
</html>





  
    