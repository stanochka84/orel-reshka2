<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea</title>
</head>
<body>
  <?php
    $qualityText = "";
    $diff = $_POST["diff"];
    $money = $_POST["money"];
    if(isset($_POST["order"])){
      $order = $_POST["order"];
      $water = $_POST["water"];
      $size = $_POST["size"];
      $sugar = $_POST["sugar"];
      $quality = $_POST["quality"];
      $sizeText = $_POST["sizeText"];
      if($sizeText == "none"){
        $sizeText = "Не вибрано";
      } else if ($sizeText == 50){
        $sizeText = "Долоня";
      } else if ($sizeText == 100){
        $sizeText = "Стопка";
      } else if ($sizeText == 200){
        $sizeText = "Стакан";
      } else if ($sizeText == 250){
        $sizeText = "Кружка";
      } else if ($sizeText == 400){
        $sizeText = "Черпак добрий";
      }
    }else{
      $order = "false";
      $water = 50;
      $size = "none";
      $sugar = 0;
      $quality = 90;
      $sizeText = "Не вибрано";
    }
    $sugarAmount = $sugar / $water * 50;
    if($size != "none"){
      $qualityAmount = $quality / ($size / 50);
    }
?>
<h1>Замовте чай!</h1>
<p><i>Оберіть наступні параметри:</i></p>
<form action="tea.php" method="POST">
        <p> 
          <label>Кількість води:</label>
          <input id="water" name="water" type="range" min="50" max="1000" step="50" value="<?php echo($water); ?>" oninput="this.nextElementSibling.value = this.value">
          <output><?php echo($water); ?></output> мл
        </p>
        <p>
          <label>Оберіть тару:</label>
          <select id="size" name="size" oninput="this.nextElementSibling.value = this.value">
            <option value="<?php echo($size); ?>" selected><?php echo($sizeText); ?></option>
            <option value="50">Долоня</option>
            <option value="100">Стопка</option>
            <option value="200">Стакан</option>
            <option value="250">Кружка</option>
            <option value="400">Черпак добрий</option>
          </select>
          <input type="hidden" name="sizeText" value="<?php echo($size); ?>">
        </p>
        <p> 
          <label>Кількість цукру:</label>
          <input name="sugar" type="range" value="<?php echo($sugar); ?>" min="0" max="12" step="0.5" oninput="this.nextElementSibling.value = this.value">
          <output><?php echo($sugar); ?></output> ч.л.
        </p>
        <p>
          Міцність чаю:
          <input type="radio" name="quality" value="60" <?php 
            if($quality == 60){
              $qualityText = "Помийки";
              echo("checked");
            } 
          ?> ><label>Помийки</label>
          <input type="radio" name="quality" value="90" <?php 
            if($quality == 90){
              $qualityText = "Стандарт";
              echo("checked");
            } 
          ?> ><label>Стандарт</label>
          <input id="quality" type="radio" name="quality" value="120" <?php 
            if($quality == 120){
              $qualityText = "Чіфір";
              echo("checked");
            }  
          ?> ><label>Чіфір</label>
        </p>
        <?php
         if($order == "true"){
           echo("<h2>Підтвердіть своє замовлення</h2>");
           echo("<p><i>Ви обрали:</i></p>");
           echo("<p>Кількість води: ". $water ." мілілітрів</p>");
           echo("<p>Вибрана тара: ". $sizeText ." </p>");
           echo("<p>Кілкість цукру: ". $sugar ." чайних ложок</p>");
           echo("<p>Міцність чаю: ". $qualityText ."</p>");
         } 
         if($order != "true"){
           echo("<input type='hidden' name='order' value='true'>");
         }else{
           echo("<input type='hidden' name='order' value='start'>");
         }
        ?>
          <input type="hidden" name="diff" value="<?php echo($diff); ?>">
          <input type="hidden" name="money" value="<?php echo($money); ?>">
          <p><strong>Загальна вартість чаю: <span id="total"></span> грн</strong></p>
          <input type="submit" value="<?php
           if($order == "false"){
             echo("Зробити замовлення");
           }else if($order == "true"){
             echo("Прийняти замовлення");
           }else if($order == "start"){
            echo("Замовити ще чайок");
           }
          ?>">
    </form>
    <?php 
     if($order == "true"){
       echo("
       <form action='tea.php' method='POST'>
         <input type='hidden' name='water' value='50'>
         <input type='hidden' name='size' value='50'>
         <input type='hidden' name='sizeText' value='Не вибрано'>
         <input type='hidden' name='sugar' value='0'>
         <input type='hidden' name='quality' value='60'>
         <input type='hidden' name='order' value='false'>
         <input type='submit' value='Відмінити замовлення'>
         <input type='hidden' name='diff' value='". $diff ."'>
         <input type='hidden' name='money' value='". $money ."'>
       </form>
       ");
     }
     if($order == "start"){
      echo("<h2>Чайник закипів</h2>");
      while($water > 0){
        $sugarPerOneCup = 0;
        $qualityPerOneCup = 0;
        for($ml = 50, $i = 1; $water > 0 && $ml <= $size; $ml += 50, $i++, $water -= 50, $sugarPerOneCup += $sugarAmount, $qualityPerOneCup += $qualityAmount){
          echo("<p>". $i .". Налито ". $ml ." мілілітрів води в тару ". $sizeText ."</p>");
        }
        if($water > 0){
          echo("<p><strong>Вибрана тара ". $sizeText ." повна, беремо наступну тару ". $sizeText ."</strong></p>");
        }else{
          echo("<p><strong>Обраний об'єм води використаний, але Ви можете замовити ще чай.</strong></p>");
        }
        echo("<p><em>Кладемо в тару ". $sizeText ." ". $sugarPerOneCup ." чайних ложок цукру</em></p>");
        echo("<p><em>Для того, щоб вийшов смачний чай міцністю ". $qualityText ." опускаємо в тару ". $sizeText); 
        if($quality != 120){
          echo(" один чайний пакетик ");
        }else{
          echo(" два чайних пакетика ");
        }
        echo(" і тримаємо в окропі ". $qualityPerOneCup ." секунд</em></p>");
        echo("<p>Розмішуємо до ідеального стану</p>");
        if($water > 0){
          echo("<p>Беремо наступну тару ". $sizeText ."</p>");
        }else{
          echo("<p><strong>Смачного чаювання!</strong></p>");
        }
      }
     }
    ?>
    <script>
      let total = document.getElementById("total"),
          water = document.getElementById("water"),
          size = document.getElementById("size"),
          sugar = document.getElementById("sugar"),
          quality = document.getElementById("quality"),
          sizeValue, qualityValue,
          sum = 0

      water.addEventListener("input", changeSum)
      size.addEventListener("input", changeSum)
      sugar.addEventListener("input", changeSum)
      quality.addEventListener("input", changeSum)

      function changeSum (){
        if(size.value >= 100){
          sizeValue = size.value * 0.001
        }else{
          sizeValue = 0
        }
        if(quality.checked){
          qualityValue = 10
        }else{
          qualityValue = 5
        }
        sum = (water.value * 0.0015) + sizeValue + (sugar.value * 0.5) + qualityValue
        total.innerHTML = sum
      }    
      changeSum()
    </script>
</body>

