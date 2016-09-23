<html ng-app="angular"></html>
<head>
  <meta charset="UTF-8" />
  <title>Оценки по направлениям</title>
  <?php include("fragments/header.php");?>
  <link href="/vendor/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/tcal.css" rel="stylesheet" />
</head>
<body class="content">
<div class="napradd">
<?	
$host='rksidb';  
$database='amdbrksi';  
$user='root';  
$pswd='9STARS'; 
$dbh = mysql_connect($host, $user, $pswd);
mysql_select_db($database);
mysql_set_charset("utf8"); 
for ($ai=0;$ai<count($_POST['val']); $ai++){
    $prop=$_POST['val'][$ai];if($prop==0)continue;
	$dt=$_POST['dt'][$ai];
	$val=$prop%10;
	$id=floor($prop/10);}


// echo "id=$id   val=$val dt=$dt<br>";
$nomer=$_POST['nomer'];
$val= ($_POST['val']);
$query="UPDATE  `reference` SET  `d_date` =  '$dt', `num`='$val' WHERE  `id`='$nomer'";
//echo $query;



mysql_query($query);

/*
$list = $_POST['list'];

$mxlist=$list+1;
$mnlist=$list-1;
if($list)
echo "<br>
<form action=add.php method=POST>
<input type=hidden value=$mnlist name=list>
<input type=submit value=back >
</form>";

echo "
<form action=add.php method=POST>
<input type=hidden value=$mxlist name=list>
<input type=submit value=next >
</form>
";

*/





echo "Введите номер направления<br><br>";

     echo "<form action=add.php method=POST>";
echo"<input name='nomer' type='text' value=".$nomer.">","<br><br>";
echo"<input type='submit' class=\"btn btn-primary\" value='Поиск'><br><br>";
if ($nomer!=""){
echo "<table border=4 align=center>";
print "<tr>";
print "<td>";
print_r("Номер");
print "</td>";
print "<td>";
print_r("Оценка");
print "</td>";
print "<td>";
print_r("Дата выставления");
print "</td>";
//$min = 0+$list*50;
//$max = 50+$list*50;
$query = mysql_query("SELECT * 
FROM `reference` 
WHERE `id` = '$nomer'");
print "<tr>";
print "<td>";
print_r($nomer);
print "</td>";
print "<td>";
echo"<select name='val'>
<option value='' selected></option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='зач'>зач</option>
</td>
<td>
<input type=\"text\" name=\"dt[]\" class=\"tcal\" value=\"\"/>
</td>
";

echo "</table><br><br>";

echo "<input type='submit' class=\"btn btn-success\" value='Добавить'>";
}
?>



</form>
</p></center>
</div> 

  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>
  <script type="text/javascript" src="tcal.js"></script>
</body>