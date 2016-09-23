<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Просмотр направлений</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="templatemo_style.css" rel="stylesheet" type="text/css" />
</head>

<body class="content">
 
 <form name='f1'action="" method="post">
 <div class="container-fluid wievnapr">
<?

	
$host='rksidb';  
$database='amdbrksi';  
$user='root';  
$pswd='9STARS';  
$dbh = mysql_connect($host, $user, $pswd);
mysql_select_db($database);
mysql_set_charset("utf8"); 
$page = $_GET['page'];
if ($page=='') {
$page=1;
};
$id = mysql_fetch_array(mysql_query("SELECT id FROM `reference` order by id DESC limit 0,1"));
$max_id = $id['id'];
$max = $max_id-4*($page-1);
$aaa = mysql_query("SELECT * FROM reference");
$pages = ceil(mysql_num_rows($aaa)/4);
//echo $pages;
echo "<center>";
if ($page>2) {
$page_2 = $page-2;
$page_1 = $page-1;
$page2 = $page+2;
$page1 = $page+1;
echo "<a href='http://rksidb/view.php?page=1' name='page' value=1><<&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page_2' name='page' value=$page_2>$page_2 &#9;&#9; </a>";
echo "<a href='http://rksidb/view.php?page=$page_1' name='page' value=$page_1>$page_1&#9;&#9;</a>";
echo "<b>$page&#9;&#9;</b>";
echo "<a href='http://rksidb/view.php?page=$page1' name='page' value=$page1>$page1&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page2' name='page' value=$page2>$page2&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$pages' name='page' value=$pages>>>&#9;&#9;</a>";
echo "<br><br>";
};
if ($page==2) {
$page_1 = $page-1;
$page2 = $page+2;
$page1 = $page+1;
$page3 = $page+3;
echo "<a href='http://rksidb/view.php?page=1' name='page' value=1><<&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page_1' name='page' value=$page_1>$page_1&#9;&#9;</a>";
echo "<b>$page&#9;&#9;</b>";
echo "<a href='http://rksidb/view.php?page=$page1' name='page' value=$page1>$page1&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page2' name='page' value=$page2>$page2&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page3' name='page' value=$page3>$page3&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$pages' name='page' value=$pages>>>&#9;&#9;</a>";
echo "<br><br>";
};
if ($page==1) {
$page2 = $page+2;
$page1 = $page+1;
$page3 = $page+3;
$page4 = $page+4;
echo "<a href='http://rksidb/view.php?page=1' name='page' value=1><<&#9;&#9;</a>";
echo "<b>$page&#9;&#9;</b>";
echo "<a href='http://rksidb/view.php?page=$page1' name='page' value=$page1>$page1&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page2' name='page' value=$page2>$page2&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page3' name='page' value=$page3>$page3&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$page4' name='page' value=$page4>$page4&#9;&#9;</a>";
echo "<a href='http://rksidb/view.php?page=$pages' name='page' value=$pages>>>&#9;&#9;</a>";
echo "<br><br>";
};
echo "</center>";
echo "<table class=\"table table-bordered\" background:white>";
print "<tr>";
print "<td>";
print_r("Номер");
print "</td>";
print "<td>";
print_r("Курс");
print "</td>";
print "<td>";
print_r("Группа");
print "</td>";
print "<td>";
print_r("Студенет");
print "</td>";
print "<td>";
print_r("Дисциплина");
print "</td>";
print "<td>";
print_r("Преподаватель");
print "</td>";
print "<td>";
print_r("Контроль");
print "</td>";
print "<td>";
print_r("Дата выдачи");
print "</td>";
print "<td>";
print_r("Дата сдачи");
print "</td>";
print "<td>";
print_r("Оценка");
print "</td>";





?>
<td class=inviz></td><?
$fio=$_POST['fio'];
$num_id=$_POST['num_id'];
$num = $_POST['num'];
$ref= $_POST['reference'];
if ($ref && $num==3) {
$z = count($ref);
for($i=0;$i<$z;$i++){
$q1 = "DELETE FROM `reference` WHERE `id` = '$ref[$i]'";
$sql = mysql_query($q1);
}
}
switch ($num)
{ case 1: $q1 = "SELECT * FROM `reference` WHERE `student` = '$fio'"; break;
case 2: $q1 = "SELECT * FROM `reference` WHERE `id` = '$num_id'"; break;
}
if ($fio || $num_id){$query = mysql_query($q1);} else {
$query = mysql_query("SELECT * FROM `reference` where `id`<=$max order by`id` DESC  limit 4");};
while ($array = mysql_fetch_array($query)) {
print "<tr>";
print "<td>";
$i=$array[id];
print_r($i);
print "</td>";
print "<td>";
print_r($array['kurs']);
print "</td>";
print "<td>";
print_r($array['group']);
print "</td>";
print "<td>";
print_r($array['student']);
print "</td>";
print "<td>";
print_r($array['predmet']);
print "</td>";
print "<td>";
print_r($array['prepod']);
print "</td>";
print "<td>";
print_r($array['type']);
print "</td>";
print "<td>";
print_r($array['s_date']);
print "</td>";
print "<td>";
print_r($array['d_date']);
print "</td>";
print "<td>";
if($array['num']==9) print "зачет"; else print_r($array['num']);
print "</td>";
print "<td class=inviz>";
$i=$array[id];
echo "<input type=checkbox name='reference[]' value=$i>";
print "</td>";

}
print "</table>";
echo "<input type='hidden' value='$num' name='num'>";
?>
</div> 
<div class = "knoprkinapr">
<input name='fio' type='text' align=left style="margin:10px 10px 0px 10px">
<input type='submit' class="btn btn-primary" onClick="document.f1.num.value='1';document.f1.action='view.php'; document.f1.submit();" value='Поиск по ФИО' align=left>
<input type="submit" class="btn btn-primary" onClick="document.f1.action='print.php'; document.f1.submit();" font= 6 value="Перепечатать выбранные направления" style="position: absolute; right: 10px; top:25px;"><br>
<input name='num_id' type='text' align=left style="margin:10px 10px 0px 10px">
<input type='submit' class="btn btn-primary" onClick="document.f1.num.value='2';document.f1.action='view.php'; document.f1.submit();" value='Поиск по номеру направления' align=left>
<input type="submit" class="btn btn-danger mar-top-5" onClick="document.f1.num.value='3'; document.f1.action='view.php'; document.f1.submit();" font= 6 value="Удалить направления" style="position: absolute; right: 10px; top:65px;" >
</div>
</form>
</body>
</html>