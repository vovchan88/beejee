<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">

<head>
    <style>
	#str{
	color: red;	
	}
	
	</style>

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Задачник</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Задачник</a>
            </div>
            <!-- /.navbar-header -->

            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="glyphicon glyphicon-list"></i> Список задач</a>
                        </li>
						<li>
                            <a href="index.php?view=authorization"><i class="fa fa-gears"></i> Панель администратора</a>
                        </li>
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Добавить задачу</h1>
						<p id="str"><?= $an_empty_string ?></p>
						<form action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="action" value="add">
						<div class="row">
						<div class="col-md-2">Имя пользователя</div>
						<div class="col-md-3"><input class="form-control" name="username"></div>
						</div><br>
						<div class="row">
						<div class="col-md-2">Почта</div>
						<div class ="col-md-3">     
							  <div class="form-group input-group" class="col-md-3">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="e-mail" name="e-mail">
                             </div>
						</div>
						</div>
						<div class="row">
						<div class="col-md-2">Задача</div>
						<div class="col-md-3"><textarea class="form-control" rows="7" name="text"></textarea></div>
						</div><br>
						<div class="row">
						<div class="col-md-2">Загрузить картинку</div>
						<input type="file" name="picture">
						</div><br>
						<div class="row">
						<div class="col-md-2"></div>
						<button type="submit" class="btn btn-warning">Сохранить</button>
						</div>
						</form>
					</div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
