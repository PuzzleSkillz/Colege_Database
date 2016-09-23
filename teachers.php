<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Преподаватели</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body class="content">
  <div class="buttonpred">
    <form action="teachers.php" method="post">
      Добавление преподавателя<br><br>
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
      $prepod =  ($_POST['prepod']);
      // $sub =  ($_POST['sub']);
      $f = $_POST['flag'];

      // $result =  mysql_query("SELECT DISTINCT  `name` FROM `subjects` ORDER BY `name`");
      // echo "Выберите predmet<br><br>";
      // echo "<select name='sub'>";
      // echo "<option value=''> </option>";
      // while($row = mysql_fetch_array($result))
      // {  if ($row['name']==$sub){
      //    echo "<option value='".$row['name']."' selected>".$row['name']."</option>";}
      //    else {echo "<option value='".$row['name']."'>".$row['name']."</option>";}
      // }  
      // echo "</select>";
      // echo "<br><br>";

      echo"Введите фио преподавателя<br><br>";

      if($prepod!=""){
      // $resultik =  mysql_query("SELECT DISTINCT  `id_sub` FROM `subjects` WHERE `name`='$sub'");
      // $id_gr = mysql_result ($resultik,$sub);
      // echo $id_gr;
      $query = "INSERT INTO `teachers` (`fio_tch`) VALUES ('$prepod')";
      $result = mysql_query($query);
      echo "Преподаватель успешно добавлен<br>";
      } else {
      if ($f != "") { echo "Не введено ФИО преподавателя<br>"; }
      }
      ?>

 <!--      <font color="white">Введите фио преподавателя</font><br><br> -->
      <input type ="text" name ="prepod" maxlength="180"  size="40"> 
      <br>

      <br>
      <input type='hidden' value='true' name='flag'>
      <tr> <td><input type="submit" class="btn btn-success" value="Добавить"></td>
    </form>
  </div>
  <div class="teachr">
    Удаление преподавателя<br>
    <form action="teachers.php" method="post">
      <?

      $host='rksidb';  
      $database='amdbrksi';  
      $user='root';  
      $pswd='9STARS'; 
       
      $dbh = mysql_connect($host, $user, $pswd);
      mysql_select_db($database);
      mysql_set_charset("utf8"); 

      $prepodd =  ($_POST['prepodd']);
      if($prepodd!=""){
      $queryd = "DELETE FROM `teachers` WHERE `fio_tch`='$prepodd'";
      $resultd = mysql_query($queryd);
      echo "Преподаватель успешно уволен<br>";
      }

      echo "<br>Выберите преподавателя<br><br>";
      $resultd =  mysql_query("SELECT DISTINCT `fio_tch` FROM `teachers` ORDER BY `fio_tch`");
      echo "<select name='prepodd'><option value=''>";
      while($row = mysql_fetch_array($resultd))
      { 
         echo "<option value='".$row['fio_tch']."'>".$row['fio_tch']."</option>";
      }
      echo "</select>","</br>";
      ?>
      <br>
      <td><input type="submit" class="btn btn-danger" value="Уволить!"></td>
    </form>
  </div>
  
  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
</body>
