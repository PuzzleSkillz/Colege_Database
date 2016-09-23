<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Сводная ведомость</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body class="content">
	
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
		// $predmetp=($_GET['predmetp']);





		if(!(($group)&&($semestr)))
		{//-------------------------------------Select's
		echo "<div class=\"veddob2\">";
		echo "
		 <form action=svod.php method=get>
		<br>Выбрать группу <br>";
		$result =  mysql_query("SELECT DISTINCT  `grname` FROM `groups` ORDER BY `kurs`,`grname`");
		echo "<select name='group'>";
		while($row = mysql_fetch_array($result))
		if($row['grname']==$group)
		echo "<option selected value='".$row['grname']."'>".$row['grname']."</option>";
		else echo "<option value='".$row['grname']."'>".$row['grname']."</option>";


		echo"</select> <br><br>";
		echo "Выберите семестр<br>";
		echo "<select name='semestr'>";
		for($i=1;$i<=8;++$i)
		{
		   echo "<option value='".$i."'>".$i."</option>";
		}
		echo "</select>","<br><br>
		<input type=submit class=\"btn btn-success\" value='Вывести'>";
		echo"</div>";
		//----------------------------------------end select's  НЕ ТРОГАТЬ!
		}
		else
		{
		echo"<div class=\"svod\">";
		print "<table border = 1 class=\"table table-bordered\"> <td>ФИО</td>";





		$table_head = "SELECT distinct `subjects`.`name`, `teachers`.`fio_tch`
		FROM `teachers` ,  `subjects`, `ved`, `students`, `groups`
		WHERE 
		(`ved`.`id_sub` =  `subjects`.`id_sub`)
		AND (`ved`.`id_tch` =  `teachers`.`id_tch`)
		AND (`students`.`id_st`) = (`ved`.`id_st`)
		AND (`groups`.`id_gr` = `students`.`id_gr`)
		and (`groups`.`grname` = '$group')
		AND (`semestr`='$semestr')
		ORDER BY `subjects`.`id_sub`
		";
		//echo $table_head;
		$table_head = mysql_query($table_head);
		$head_length = mysql_num_rows($table_head);
		while ($head = mysql_fetch_array($table_head))
		echo"<td>".$head['name']."<br>".$head['fio_tch']."</td>";
		echo"<tr>";


		//CREATE TABLE svved(id_sv int(100) NOT NULL PRIMARY KEY auto_increment,id_gr int(5),id_st int(10),id_sub int(5),id_teach int(5));

		$zap=
		"SELECT distinct `students`.`fio`, `groups`.`grname`, `subjects`.`name`, `teachers`.`fio_tch`, `ved`.`value`,`ved`.`semestr`,`ved`.`id_st`
		FROM  `ved` ,  `teachers` ,  `subjects` ,  `students`, `groups` 
		WHERE 
		(`ved`.`id_st` =  `students`.`id_st`)
		AND (`ved`.`id_sub` =  `subjects`.`id_sub`)
		AND (`ved`.`id_tch` =  `teachers`.`id_tch`)
		AND (`groups`.`id_gr` = `students`.`id_gr`)
		-- AND (`subjects`.`id_sub` = `teachers`.`id_sub`)
		-- AND (`ved`.`id_sub` = `teachers`.`id_sub`)
		AND (`semestr`='$semestr')
		AND (`grname`='$group')
		ORDER BY  `students`.`fio` ,  `subjects`.`id_sub` "
		;
		echo "<h3 align=center>$group</h3>";
			// echo $zap;
		$zap = mysql_query($zap);
		$i=0;


			// echo "КУКУ = ".$qq."krch";

		while ($array = mysql_fetch_array($zap))
		{
		// echo "КУКУ = ".$qq."krch";
		// echo "<br><br>arrrrr = ".$array['value']."<br>";
		
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
		for ($i=0; $i<$head_length-1; $i++)
		{
// Echo "<br>кря = ".$array['value']." Крякнул <br>";		
		$array = mysql_fetch_array($zap);

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

		echo "<td>".$qq."</td>";
		}
		echo "<tr>"; 
		}
			// echo "Елка = ".$qq."йцу";

		echo"
		<input type=hidden name=prepody value=$prepody>
		<input type=hidden name=semestr value=$semestr>
		<input type=hidden name=predmetp value=$predmetp>";
		echo"</div>";
		?>
		</table><!-- <input type=submit value=go!> -->
		<?}?>
 		</p></center>
	</div> <!-- end of content wrapper -->

  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
</body>