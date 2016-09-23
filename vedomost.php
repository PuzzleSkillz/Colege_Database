<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Просмотреть ведомость</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body class="content">
	<div class="veddob">
		<?

		  
		  
		$host='rksidb';  
		$database='amdbrksi';  
		$user='root';  
		$pswd='9STARS'; 
		 
		$dbh = mysql_connect($host, $user, $pswd);
		mysql_select_db($database);
		mysql_set_charset("utf8");
		// Подключились к БД

		$group=($_GET['group']);
		$semestr=($_GET['semestr']);
		$predmetp=($_GET['predmetp']);





		if(!(($group)&&($semestr)))
		{//-------------------------------------Select's
		echo "
		 <form action=vedomost.php method=get>
		<br>Выбрать группу <br>";
		$result =  mysql_query("SELECT DISTINCT  `grname` FROM `groups` ORDER BY `kurs`,`grname`");
		echo "<select name='group'>";
		while($row = mysql_fetch_array($result))
		if($row['grname']==$group)
		echo "<option selected value='".$row['grname']."'>".$row['grname']."</option>";
		else echo "<option value='".$row['grname']."'>".$row['grname']."</option>";
		echo"</select> <br><br>";

		echo "Выберите предмет<br>";
		$resultp =  mysql_query("SELECT DISTINCT  `name` FROM `subjects` ORDER BY `name`");
		echo "<select name='predmetp'>";
		while($row = mysql_fetch_array($resultp))
		if($row['name']==$predmetp)
		echo "<option selected value='".$row['name']."'>".$row['name']."</option>";
		else echo "<option value='".$row['name']."'>".$row['name']."</option>";
		echo"</select> <br><br>";

		echo "Выберите семестр<br>";
		echo "<select name='semestr'>";
		for($i=1;$i<=8;++$i)
		{
		   echo "<option value='".$i."'>".$i."</option>";
		}
		echo "</select>","<br><br>
		<input type=submit class=\"btn btn-success\" value='Вывести'>";
		//----------------------------------------end select's  НЕ ТРОГАТЬ!
		}
		else
		{
		print "<table border = 1 class=\"table table-bordered\"> <td>ФИО</td>";





		$table_head = "SELECT DISTINCT `subjects`.`name`, `teachers`.`fio_tch`
		FROM `teachers` ,  `subjects`, `ved`, `students` , `groups`
		WHERE 
		(`ved`.`id_sub` =  `subjects`.`id_sub`)
		 AND (`ved`.`id_tch` =  `teachers`.`id_tch`)
		 and(`groups`.`id_gr` = `students`.`id_gr`)
		 AND (`students`.`id_st`) = (`ved`.`id_st`)
		 AND (`subjects`.`name` = '$predmetp')
		 AND (`semestr`='$semestr')
		 AND (`groups`.`grname` = '$group')
		ORDER BY `subjects`.`id_sub`";
		//echo $table_head;
		$table_head = mysql_query($table_head);
		$head_length = mysql_num_rows($table_head);
		while ($head = mysql_fetch_array($table_head))
		echo"<td>".$head['name']."<br>".$head['fio_tch']."</td>";
		echo"<tr>";


		//CREATE TABLE svved(id_sv int(100) NOT NULL PRIMARY KEY auto_increment,id_gr int(5),id_st int(10),id_sub int(5),id_teach int(5));

		$zap=
		"SELECT distinct `students`.`fio`, `groups`.`grname`, `subjects`.`name`, `teachers`.`fio_tch`, `ved`.`value`,`ved`.`semestr`,`ved`.`id_st`
		FROM  `ved` ,  `teachers` ,  `subjects` ,  `students` , `groups` 
		WHERE 
		(`ved`.`id_st` =  `students`.`id_st`)
		AND (`ved`.`id_sub` =  `subjects`.`id_sub`)
		and(`groups`.`id_gr` = `students`.`id_gr`)
		AND (`ved`.`id_tch` =  `teachers`.`id_tch`)
		AND (`subjects`.`name` = '$predmetp')
		AND (`semestr`='$semestr')
		AND (`grname`='$group')
		-- AND (`ved`.`id_sub` = '4')
		-- AND (`subjects`.`id_sub` = `teachers`.`id_sub`)
		-- AND (`ved`.`value` = '$qq')
		ORDER BY  `students`.`fio` ,  `subjects`.`id_sub` "
		;
		echo "<h3 align=center>$group</h3>";
		$zap = mysql_query($zap);
		$i=0;

		while ($array = mysql_fetch_array($zap))
		{
			switch ($array['value'])
			{
			case 0: $qq = "не явка";break;
			case 1: $qq = "н/а";break;
			case 2: $qq = "нет оценки";break;
			case 3: $qq = "3";break;
			case 4: $qq = "4";break;
			case 5: $qq = "5";break;
			case 6: $qq = "зачет";break;
			}
		echo "<td>".$array['fio']."</td>";
		echo "<td>".$qq."</td>";
			// for ($i=0; $i<$head_length-1; $i++)
			// {
			// $array = mysql_fetch_array($zap);



			// echo "<td>".$qq."</td>";
			// }
		echo "<tr>"; 
		}


		echo"
		<input type=hidden name=prepody value=$prepody>
		<input type=hidden name=semestr value=$semestr>
		<input type=hidden name=predmetp value=$predmetp>"
		?>
		</table><!-- <input type=submit value=go!> -->
		<?}?>
 		</p></center>
	</div> <!-- end of content wrapper -->


  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
</body>
