<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Студенты</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body class="content">
  <div class="studentsleft">
    <form action="students.php" method="post">
    Добавление студента<br><br>
      <?

      $host='rksidb';  
      $database='amdbrksi';  
      $user='root';  
      $pswd='9STARS'; 
       
      $dbh = mysql_connect($host, $user, $pswd);
      mysql_select_db($database);
      mysql_set_charset("utf8"); 
      ?>
    <form action="students.php" method="post">
      <?
      $group = ($_POST['group']);
      $student =  ($_POST['student']);
      $f = $_POST['flag'];
      if ($student == ''){$msg = "<font color=\"white\">Не введено ФИО студента</font><br>";};
      if ($group == '') {$msg = $msg."<font color=\"white\">Не выбрана группа</font><br>";};
      if($student != "" && $group != ""){
        $result =  mysql_query("SELECT `id_gr` FROM `groups` where `grname`='$group'");
        $id_gr = mysql_result ($result,0);
        //echo $id_gr;
        $query = "INSERT INTO `students` (`fio`, `id_gr`) VALUES
        ('$student', '$id_gr')";
        $result = mysql_query($query);
        $msg="<font color=\"black\">Студент успешно добавлен</font>";
      };
      if ($f != '') {
        echo $msg;
        echo "<br>"; 
      };

      $result =  mysql_query("SELECT DISTINCT  `grname`,`kurs` FROM `groups`ORDER BY `kurs`,`grname`");
      echo "Выберите группу<br><br>";
      echo "<select name='group'>";
      echo "<option value=''> </option>";
      while($row = mysql_fetch_array($result))
      {  if ($row['grname']==$group){
         echo "<option value='".$row['grname']."' selected>".$row['grname']."</option>";}
         else {echo "<option value='".$row['grname']."'>".$row['grname']."</option>";}
      }  
      echo "</select>";
      echo "<br>";
      echo "<input value='true' type='hidden' name='flag'>";
      ?>
      <br>Введите имя студента<br>
      <input type ="text" name ="student" maxlength="80"  size="40"> 
      <br><br>
      <tr> <td><input type="submit" class="btn btn-success" value="Добавить"></td><br>
    </form>
     </p></center>
    </div>
  </div>

  <div class="studentsright">
        Удаление студента<br>
    <form action="students.php" method="post">
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
    $groupd = ($_POST['groupd']);
    $msgd = $_POST['msgd'];


    $resultd =  mysql_query("SELECT DISTINCT  `grname` FROM `groups` ORDER BY `kurs`,`grname`");
    echo $msgd."<br>";
    echo "Выберите группу<br>";
    echo "<select name='groupd'>";
    echo "<option value=''>";
    while($row = mysql_fetch_array($resultd))
    { 
       if ($row['grname']!=$groupd) 
       {echo "<option value='".$row['grname']."'>".$row['grname']."</option>";}
       else {echo "<option value='".$row['grname']."' selected>".$row['grname']."</option>";};
    }
    echo "</select>","</br><br>";
    echo "<td><input type='submit' class=\"btn btn-primary\" value='Выбрать группу'></td>";

    ?>

    </form>
    <form action="students.php" method="POST">
    <?
    $groupd = ($_POST['groupd']);
    $studentd = ($_POST['studentd']);
    // echo $studentd;
    if($studentd!="")
    {
    $queryd = "DELETE FROM `students` WHERE `fio`='$studentd'";
    $resultd = mysql_query($queryd);
    $msgd="Студент успешно отчислен";
    echo $msgd;
    }


    if ($groupd!=''){
    echo "<br>Выбирете студента<br>";
    $resultd =  mysql_query("SELECT DISTINCT `students`.`fio`,`groups`.`grname` FROM `students`,`groups` WHERE `students`.`id_gr`=`groups`.`id_gr` ORDER BY `fio`,`grname`");

    echo "<select name='studentd'>";
    echo "<option value=''></option>";
    while($row = mysql_fetch_array($resultd))
    {
      if ($row['grname']==$groupd){
      echo "<option value='".$row['fio']."'>".$row['fio']."</option>";
    }; 
    }

    echo "</select>","</br><br>";
    echo "<input type='hidden' value='$groupd' name='groupd'>";
    echo "<input type='hidden' value='$msgd' name='msgd'>";
    echo "<td><input type='submit' class=\"btn btn-danger\" value='Отчислить студента!'></td>";
    }
    ?>
  </div>
  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
</body>
