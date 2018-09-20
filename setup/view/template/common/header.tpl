<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
<script src="view/javascript/bootstrap/js/bootstrap.js" type="text/javascript"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
</head>
<body>
<div class="container">
	<header>
		<div class="row">
			<div class="col-sm-6">
				<div id="logo" class="pull-left"><img src="view/image/logo.png" alt="hthung" title="hthung" style="height:40px;"/></div>
			</div>
		</div>
	</header>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <?php if($route == 'install/home') echo 'class="active"'; ?>><a href="index.php?route=install/home">Home</a></li>
				<li <?php if($route == 'install/config') echo 'class="active"'; ?>><a href="index.php?route=install/config">Config</a></li>
				<li <?php if($route == 'install/module') echo 'class="active"'; ?>><a href="index.php?route=install/module">Module</a></li>
				<li <?php if($route == 'install/licence') echo 'class="active"'; ?>><a href="index.php?route=install/licence">License</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</nav>