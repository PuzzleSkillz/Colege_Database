<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Группы</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body class="content">
  <div class="buttonl">
    Добавление группы<br><br>
    <form action="groups.php" method="post">
      <?

      $host='rksidb';  
      $database='amdbrksi';  
      $user='root';  
      $pswd='9STARS'; 
       
      $dbh = mysql_connect($host, $user, $pswd);
      mysql_select_db($database);
      mysql_set_charset("utf8"); 
      ?>
    <form action="groups.php" method="post">

      <?
      $group = ($_POST['group']);
      $kurs = ($_POST['kurs']);
      $f = $_POST['flag'];
      if ($kurs == ''){$msg = "Не выбран курс<br>";};
      if ($group == '') {$msg = $msg."Не написано наименование группы<br>";};

      if($group!="" && $kurs!='') {
      $result =  mysql_query("SELECT `kurs` FROM `groups` where `kurs`='$kurs'");
      $query = "INSERT INTO `groups` (`grname`, `kurs`) VALUES
      ('$group', '$kurs')";
      $result = mysql_query($query);
      $msg = "Группа успешно добавлена <br>";
      }
      if ($f != ""){
      echo $msg."<br>";
      }
      ?>

      Введите название новой группы<br>
      <?
      if ($kurs == "") {
      echo "<input type ='text' name ='group' maxlength='180'  size='40' value='$group'> <br><br>";
      } else {
      echo "<input type ='text' name ='group' maxlength='180'  size='40'> <br><br>";
      }
      ?>

      Выбор курса<br>
      <select name='kurs'>
      <option value=''> </option>
      <?
      for ($i=1;$i<=4;$i++){
        if ($i != $kurs) {
          echo "<option value='$i'>$i курс</option>";
          } else {
          echo "<option value='$i' selected>$i курс</option>";
          }
        }
      ?>
    </select>
    <input type='hidden' value='true' name='flag'>
    <br><br>
    <input type="submit" class="btn btn-success" value="Добавить">
    </form><br>
  </div>
  <div class="buttonr">
    Удаление группы<br>
    <form action="groups.php" method="post">
      <?

      $host='rksidb';  
      $database='amdbrksi';  
      $user='root';  
      $pswd='9STARS'; 
         
      $dbh = mysql_connect($host, $user, $pswd);
      mysql_select_db($database);
      mysql_set_charset("utf8"); 

      $groupd = ($_POST['groupd']);
      $f = $_POST['flag2'];
      if ($groupd!=""){
      $queryd = "DELETE FROM `groups` WHERE `grname`='$groupd'";
      $resultd = mysql_query($queryd);
      $msg2 = "Группа успешно удалена <br>";
      }
      if ($f != ""){
      echo $msg."<br>";
      }
      echo "<br>Выбирете группу<br><br>";
      $resultd =  mysql_query("SELECT DISTINCT `grname` FROM `groups`ORDER BY `grname`");
      echo "<select name='groupd'> <option value=''>";
      while($row = mysql_fetch_array($resultd))
      { 
         echo "<option value='".$row['grname']."'>".$row['grname']."</option>";
      }
      echo "</select>","</br>";

      ?>
      
      <br><br>
      <p> </p>
      <input type='hidden' value='true' name='flag2'>
      <input type="submit" class="btn btn-danger" value="Удалить"><br><br>
      </form>
  </div>
  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
</body>
