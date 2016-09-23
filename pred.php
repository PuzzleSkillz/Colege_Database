<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Предмет</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body class="content">
  <div class="buttonpred">
    Добавление предмета<br><br>
    <form action="pred.php" method="post">
    <?

    $host='rksidb';  
    $database='amdbrksi';  
    $user='root';  
    $pswd='9STARS';  
     
    $dbh = mysql_connect($host, $user, $pswd);
    mysql_select_db($database);
    mysql_set_charset("utf8"); 
    ?>


    <?
    $predmet =  ($_POST['predmet']);
    $f = $_POST['flag'];
    if($predmet!="")
    {
    $query = "INSERT INTO `subjects` (`name`) VALUES('$predmet')";
    $result = mysql_query($query);
    // echo "Предмет успешно добавлен<br><br>";
    } else {
    if ($f != "") { echo "Не введено название предмета<br>"; }
    }
    ?>


    Введите название предмета<br>
    <input type ="text" name ="predmet" maxlength="180"  size="40"> 
    <br>
    <input type='hidden' value='true' name='flag'>
    <br><br>
    <input type="submit" class="btn btn-success" value="Добавить">
    </form><br>
  </div>
  <div class="buttonrpred">
    Удаление предмета<br>
    <form action="pred.php" method="post">
      <?

      $host='rksidb';  
      $database='amdbrksi';  
      $user='root';  
      $pswd='9STARS';  
       
      $dbh = mysql_connect($host, $user, $pswd);
      mysql_select_db($database);
      mysql_set_charset("utf8"); 

      $predmetz =  ($_POST['predmetz']);

      if($predmetz!="")
      {
      $queryz = "DELETE FROM `subjects` WHERE `name`='$predmetz'";
      $resultz = mysql_query($queryz);
      // echo "Предмет успешно удален<br>";
      }
      echo "<br>Выберите предмет<br>";
      $resultz =  mysql_query("SELECT DISTINCT  `name` FROM `subjects`ORDER BY `name`");
      echo "<select name='predmetz'>";
      echo "<option value=''>";
      while($row = mysql_fetch_array($resultz))
      { 
         echo "<option value='".$row['name']."'>".$row['name']."</option>";
      }
      echo "</select>","</br>";

      ?>
      <br>
      <br>
      <input type='hidden' value='true' name='flag2'>
      <input type="submit" class="btn btn-danger" value="Удалить"><br><br>
    </form>
  </div>
  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
</body>
