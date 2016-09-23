<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style1.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>На печать</title>
 </head>
 <body>
 
 
 



 <form action="pr2.php" method="post">
 
<?
$host='rksidb'; 
$database='amdbrksi'; 
$user='root'; 
$pswd='9STARS';  
$dbh = mysql_connect($host, $user, $pswd) or die("MySQL.");
mysql_select_db($database);
mysql_set_charset("utf8"); 

$ref=($_POST['reference']);
$z = count($ref);


for($i=0;$i<$z;$i++){
$query = "SELECT * FROM reference WHERE `id`='$ref[$i]'";
$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
$kurs=$row['kurs'];
$group_n=$row['group'];
$student_n= $row['student'];
$predmet_n=$row['predmet'];
$prepod_n=$row['prepod'];
$type=$row['type'];
$end=$row['e_date'];
$start=$row['s_date'];
$number=$row['id'];


if($ref==0)
{

$st_id =  ($_POST['student']);
$query = "SELECT * FROM `students`,`groups` WHERE `id_st`='$st_id'";
$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
$student_n = $row['fio'];
$group_n = $row['grname'];
$kurs=$row['kurs'];


$prepod_id =  ($_POST['prepody']);
$query = "SELECT * FROM `teachers` WHERE `id_tch`='$prepod_id'";
$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
$prepod_n=$row['fio_tch'];


$predmet_id =  ($_POST['predmet']);
$query = "SELECT `name` FROM `subjects` WHERE `id_sub`='$predmet_id'";
$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
$predmet_n=$row['name'];
$type = ($_POST['type']);
$end = ($_POST['end']);
$start = date("d.m.Y");
$query = "SELECT `name` FROM `subjects` WHERE `id_sub`='$predmet_id'";
$sql = mysql_query($query);

if($_POST['id']) {
$number=$_POST['id'];
if ($_POST['start']){$start=$_POST['start'];}
$query=
"UPDATE `reference` SET `kurs` = '$kurs',
`group` = '$group_n',
`student` = '$student_n',
`predmet` = '$predmet_n',
`prepod` = '$prepod_n',
`type` = '$type',
`s_date` = '$start',
`e_date` = '$end'
WHERE `id` =".$number." LIMIT 1 ;";}
else
{

$query = 
"INSERT INTO `reference`( `kurs`, `group`, `student`, `predmet`, `prepod`, `type`,`s_date`,`e_date`) 
VALUES ('$kurs', '$group_n', '$student_n', '$predmet_n', '$prepod_n', '$type','$start','$end')";
}
//echo"$query";
$result = mysql_query($query);
$number+=mysql_insert_id();
}
// $loser = $_POST['loser'];
// $chec=mysql_query("UPDATE  `losers` SET  `id_ref` =  '$number' WHERE  `losers`.`id`='$loser'");


switch ($type)
{
case "зачет":$ttype="зачета";    break;
case "экзамен":$ttype="экзамена";    break;
case "курсовую работу":$ttype="курсовой работы";   break;
case "курсовой проект":$ttype="курсового проекта";   break;

}


if($prepod_n==""){$prepod_n="_______________";}
if($type=="курсовая работа"){$type="курсовую работу";}
echo
"


<table width=100% height=100% cellpadding=10 cellspacing=10 border=0>
<tr>
<td>

<center><font size = 5>Направление № $number<br></font>
<font size='3'><small>(остается у преподавателя)</small></font></center>




<p>Преподавателю <ins>$prepod_n</ins></br>
направляется на пересдачу <ins>$ttype</ins></br>
по учебной дисциплине <ins>$predmet_n</ins></br>
студент $kurs курса группы <ins>$group_n $student_n </ins></br>
Дата выдачи <ins>$start</ins>. Срок действия направления до <ins>$end</ins> г. </br>
Заведующий отделением ____________</p></br></br></br><hr></br></br>



<center><font size = 5>Справка № $number<br></font>
<font size='3'><small>(сдается преподавателем в учебный отдел)</small></font></br></center>



<p>Студент <ins> $student_n $kurs</ins> курса группы <ins>$group_n</ins> повторно сдал <ins>$type</ins></br>
по учебной дисциплине <ins>$predmet_n</ins></br>
с оценкой ________ Дата сдачи «_____» ____________ 201__г.</br>
Преподаватель _______________(<ins>$prepod_n</ins>)</br>
Заведующий отделением __________________</p></br></br></br><hr></br></br>




<center><font size = 5>Справка № $number<br></font>
<font size='3'><small>(сдается преподавателем на отделение)</small></font></br></center>



<p>Студент <ins> $student_n $kurs</ins> курса группы <ins>$group_n</ins> повторно сдал <ins>$type</ins></br>
по учебной дисциплине <ins>$predmet_n</ins></br>
с оценкой ________ Дата сдачи «_____» ____________ 201__г.</br>
Преподаватель _______________(<ins>$prepod_n</ins>)</br>
Заведующий отделением __________________</p>
<br><br><br><br><br><br><br><br><br>
</td>
</tr><br>";
}
?>
 <script type="text/javascript">
window.print();
//
</script>
<meta http-equiv=Refresh content="0; url=/new.php">




</body> </html>