<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="/img/favicon.ico" rel="icon" type="image/x-icon" />
    <script src="vendor/js/jquery-1.11.3.min.js"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <title></title>
  </head>
  <body>
  <nav class="navbar navbar-default" >
    <div class="container-fluid">
      <!--Brand and toggle get grouped for better mobile display-->
      <div class="navbar-header">
        <button class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="#/"><img class="lol" src="assets/images/oit2.png" /></a>
      </div>
      <!--Collect the nav links, forms, and other content for toggling-->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li ng-class="{active: url=='home'}">
            <a href="/index.php">Главная</a>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" role="button" href="#" data-toggle="dropdown" aria-expanded="false">Ведомости <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/vedomost_cr.php">Создать</a></li>
              <li><a href="/vedomost.php">Просмотреть</a></li>
              <li><a href="/svod.php">Сводная</a></li>
            </ul>
          </li>
          <li ng-class="{active: url=='students'}">
            <a href="/students.php">Студенты</a>
          </li>
          <li class="divider-vertical"></li>
          <li ng-class="{active: url=='teachers'}">
            <a href="teachers.php">Преподаватели</a>
          </li>
          <li ng-class="{active: url=='pred'}">
            <a href="/pred.php">Предметы</a>
          </li>
          <li ng-class="{active: url=='groups'}">
            <a href="/groups.php">Группы</a>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" role="button" href="#" data-toggle="dropdown" aria-expanded="false">Направления <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/new.php">Создать</a></li>
              <li><a href="/view.php">Просмотреть</a></li>
              <li><a href="/add.php">Оценки по направлениям</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search">
<!--           <div class="form-group">
            <input class="form-control" placeholder="Поиск" type="text" />
          </div> -->
<!--           <button class="btn btn-default" type="submit"> Поиск</button> -->
        </form>
        </ul>
      </div>
    </div>
  </nav>
  <script src="/vendor/js/angular.min.js"></script>
  <script src="/vendor/js/angular-route.min.js"></script>
  <script src="/assets/js/app/app.js"></script>