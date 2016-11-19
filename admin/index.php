<!DOCTYPE html>
<html lang="en">
<head>
  <title>Salesripe Support Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body ng-app="myApp" ng-cloak>

  <!-- Navbar -->
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" ui-sref="home"><img src="img/logo_new.png" alt="Logo"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a ui-sref="home">All</a></li>
          <li><a ui-sref="new">New</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <!-- Main Container -->
  <div class="container main">
    <div class="row">
     <div ui-view></div>
   </div>
 </div>

 <!-- Footer -->
 <footer class="container-fluid bg-4 text-center">
  <p>Theme By <a href="http://www.droitlab.com">Droitlab</a></p> 
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!-- Scripts -->
<script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<!-- Angular Core plugins -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-resource.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.1/angular-ui-router.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/sortable.js"></script>
<!-- Angular tinymce plugin -->
<script type="text/javascript" src="../node_modules/angular-ui-tinymce/src/tinymce.js"></script>
<!-- Custom Angular files  -->
<script type="text/javascript" src="js/route-config.js"></script>
<script type="text/javascript" src="js/service.js"></script>
<script type="text/javascript" src="js/controller/home.controller.js"></script>
<script type="text/javascript" src="js/controller/new.controller.js"></script>
<script type="text/javascript" src="js/controller/single.controller.js"></script>
<!--  Angular pagination plugin -->
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.1.min.js"></script>
<script src="js/dirPagination.js"></script>

</body>
</html>
