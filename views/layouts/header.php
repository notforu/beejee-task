<!DOCTYPE html>
<html>
	<head>
		<title>Test page with some comments</title>
		<link rel="stylesheet" type="text/css" href="/template/css/index.css">
		<link rel="stylesheet" type="text/css" href="/template/css/bootstrap.min.css">
	</head>
	<body>
		<div class="wrapper">
		  	<header>
				<nav class="navbar navbar-default">
				  <div class="container">
				    <div class="navbar-header">
				    	<a class="navbar-brand" href="/">Main</a>
				    </div>
				
				      <ul class="nav navbar-nav navbar-right">
				      	<?php if (Users::isGuest()): ?>
							<li>
								<a class="navbar-brand" href="/user/login/">Login</a>
							</li>
						<?php else: ?>
							<li>
								<a class="navbar-brand" href="/user/logout/">Logout</a>
							</li>
						<?php endif; ?>
				      </ul>
				  </div>
				</nav>
			</header>