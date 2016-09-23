<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Создать направление</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/tcal.css" rel="stylesheet" />
</head>
<body class="content">

<div class="glav2">

	<form action="print.php" method="post">
	<?


	  
	  
	  
	$host='rksidb';  
	$database='amdbrksi';  
	$user='root';  
	$pswd='9STARS'; 
	 
	$dbh = mysql_connect($host, $user, $pswd);
	mysql_select_db($database);
	mysql_set_charset("utf8"); 


	?>




	<TABLE  align="center">
	        <TR>
	                <TD>
					
					
					
					
					
					
					
	<?
	$predmet = (mysql_fetch_array (mysql_query ("select * from `subjects` where `id_sub`='".$_GET['predmet']."'")));
	$fio = (mysql_fetch_array (mysql_query ("select * from `teachers` where `id_tch`='".$_GET['fio']."'")));
	$student = (mysql_fetch_array (mysql_query ("select * from `students` where `id_st`='".$_GET['student']."'")));

	//student=mysql_query("select `student` from `newstudents` where `id`='$student'");


	$a=($_GET['a']);

	echo "Выбрать студента<br>";
	if($a) {echo"<input type=text name='id' value='0'><br><input type=text name='start' class='tcal' value='0' /><br>";}
	//else{echo"<input type=hidden name='id' value='0'><br> <input type=hidden name='start' class='tcal' value='0' /><br>";}
	$result =  mysql_query("SELECT * FROM `students`,`groups` WHERE `students`.`id_gr` = `groups`.`id_gr` ORDER BY `fio`");
	echo "<select name='student'>
	<option selected value='".$student['id_st']."'>".$student['fio']." ".$student['grname']."</option>

	";
	while($row = mysql_fetch_array($result))
	{ 
	   echo "<option value='".$row['id_st']."'>".$row['fio']." ".$row['grname']."</option>";
	}
	echo "</select>","</br><br>";










	echo "Выбрать предмет<br>";
	$result =  mysql_query("SELECT * FROM `subjects` order by `name`");
	echo "<select name='predmet'>
	<option selected value='".$predmet['id_sub']."'>".$predmet['name']."</option>
	";
	while($row = mysql_fetch_array($result))
	{
	   echo "<option value='".$row['id_sub']."'>".$row['name']."</option>";
	}
	echo "</select>","<br><br>";

	echo "Выбрать преподавателя<br>";
	$result =  mysql_query("SELECT * FROM `teachers` order by `fio_tch`");
	echo "<select name='prepody'>
	<option value='".$fio['id_tch']."'>".$fio['fio_tch']."</option>
	";
	while($row = mysql_fetch_array($result))
	{
	   echo "<option value='".$row['id_tch']."'>".$row['fio_tch']."</option>";
	}
	echo "</select>","<br>
	","<br>";
	// <input type=hidden name = loser value=".$_GET['loser'].">
	echo "Направление действительно до:";





	?>
	<input type="text" name="end" class="tcal" value="" />
	</TD> 




	
	<TD>

	
	<p >Выбрать тип пересдаваемой дисциплины</p>
	<input type="radio" name="type" value="зачет" checked>зачет</br>
	<input type="radio" name="type" value="экзамен">экзамен</br>
	<input type="radio" name="type" value="курсовая работа">курсовая работа</br>
	<input type="radio" name="type" value="курсовой проект">курсовой проект</br>
	</TD>




	<? 

	//echo"$query";
	$result = mysql_query($query);
	$number=mysql_insert_id();
	echo "<input type=hidden name='reference' value=$numer>";
	?>



	<tr> <td><input type="submit" class="btn btn-success" value="Добавить"></td>









	</table>
	</form>
	 </p>
</div> <!-- end of content wrapper -->

  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
  <script type="text/javascript" src="tcal.js"></script>
</body>