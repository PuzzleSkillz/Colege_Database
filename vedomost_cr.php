<!DOCTYPE html>
<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Создать ведомость</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body class="content">
	<div class="veddob">
		<?
		$host='localhost';  
		$database='amdbrksi';  
		$user='root';  
		$pswd='9STARS'; 
		 
		$dbh = mysql_connect($host, $user, $pswd);
		mysql_select_db($database);
		mysql_set_charset("utf8"); 



		$group=($_GET['group']);
		$predmet=($_GET['predmet']);
		$prepody=($_GET['prepody']);
		$semestr=($_GET['semestr']);

		// if($group != ""){
  //       $result =  mysql_query("SELECT `id_gr` FROM `groups` where `grname`='$group'");
  //       $id_gr = mysql_result ($result,$group);
  //       echo $id_gr;
  //       $query = "INSERT INTO `ved` (`id_st`,`id_tch`,`id_sub`,`id_gr`,`value`,`semestr`) values ('$id_s','$prepody','$predmet','$id_gr','$number',$semestr)";
  //       $result = mysql_query($query);
		// $id_session = mysql_insert_id();
  //     	};


		for($ai=0;$ai<count($_GET['value']); $ai++)
		{
		$prop=$_GET['value'][$ai];
		$id_s=floor($prop/10);
			$number=$prop%10;//echo $number;

			$query = "INSERT INTO `ved` (`id_st`,`id_tch`,`id_sub`,`value`,`semestr`) values ('$id_s','$prepody','$predmet','$number',$semestr)";
			//echo "<br> $query";
			$result = mysql_query($query);
			$id_session = mysql_insert_id();
			// if ($number<=2)
			// {
			// $query = "INSERT INTO `losers` (`id_session`,`id_ref`) values ('$id_session','0')";
			// $result = mysql_query($query);
			// }
			}
		if(!(($group)&&($predmet)&&($prepody)&&($semestr)))
		{//-------------------------------------Select's
		echo "
		<form action=vedomost_cr.php method=get>
		<br>Выбрать группу <br>";


		// $result =  mysql_query("SELECT `id_gr` FROM `groups` where `grname`='$group'");
  //       $id_gr = mysql_result ($result,$group);

		$result =  mysql_query("SELECT DISTINCT  `grname` FROM `groups` ORDER BY `kurs`,`grname`");
		// $id_gr = mysql_result ($result,);
		echo "<select name='group'>";
		while($row = mysql_fetch_array($result))
		if($row['grname']==$group)
		echo "<option selected value='".$row['grname']."'>".$row['grname']."</option>";
		else echo "<option value='".$row['grname']."'>".$row['grname']."</option>";
		echo"</select> <br><br>";

		echo "Выбрать предмет<br>";
		$result =  mysql_query("SELECT DISTINCT * FROM `subjects` order by `name`");
		echo "<select name='predmet'>";
		while($row = mysql_fetch_array($result))
		{
		   echo "<option value='".$row['id_sub']."'>".$row['name']."</option>";
		}
		echo "</select>","<br><br>";

		echo "Выбрать преподавателя<br>";
		$result =  mysql_query("SELECT DISTINCT * FROM `teachers` order by `fio_tch`");
		echo "<select name='prepody'>";
		while($row = mysql_fetch_array($result))
		{
		   echo "<option value='".$row['id_tch']."'>".$row['fio_tch']."</option>";
		}
		echo "</select>","<br><br>";

		echo "Выберите семестр<br>";
		echo "<select name='semestr'>";
		for($i=1;$i<=8;++$i)
		{
		   echo "<option value='".$i."'>".$i."</option>";
		}
		echo "</select>","<br><br>
		<input type=submit class=\"btn btn-success\" value='Добавить'>";
		//----------------------------------------end select's
		}
		else
		{
		?>
		
		<form action="vedomost_cr.php" method="get">
		<table align="center" class="table table-bordered">
		<td>ФИО студента</td>
		<td>Оценка</td>
		<tr>
		<?
		$zap="SELECT DISTINCT * FROM `groups`,`students` WHERE (`groups`.`grname`='$group') AND (`students`.`id_gr` = `groups`.`id_gr`) ORDER BY `students`.`fio`";
		echo "<b>$group</b><br>";
		$query = mysql_query($zap);
		while ($array = mysql_fetch_array($query))
		echo"<td> ".$array['fio']."</td> 
		<td>
		<select name=value[]>
		<option value=".$array['id_st']."0>не явка</option>
		<option value=".$array['id_st']."1>н/а</option>
		<option value=".$array['id_st']."2>нет оценки</option>
		<option value=".$array['id_st']."3>3</option>
		<option value=".$array['id_st']."4>4</option>
		<option value=".$array['id_st']."5>5</option>
		<option value=".$array['id_st']."6>зачет</option>
		</td><tr>";
		echo"
		<input type=hidden name=prepody value=$prepody>
		<input type=hidden name=semestr value=$semestr>
		<input type=hidden name=predmet value=$predmet>";
		?>
		<br>
		</table><input type=submit class="btn btn-success" value="Добавить">
		<?
		}
		?>
	</div>

  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
</body>
