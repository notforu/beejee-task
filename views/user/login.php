<?php  include ROOT . '/views/layouts/header.php' ?>

<section>
	<div class="page-header">
		<h1 class="text-center">Login</h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="signup-form col-md-6 col-md-offset-3">
				
				<form action="#" method="post">
					<div class="form-group">
						<label for="login">Login:</label>
						<input class="form-control" type="text" name="login" placeholder="Login" value="<?php echo $login ?>" />
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo $password ?>" />
					</div>
					<input class="btn btn-default" type="submit" name="submit" value="Sign in" />
				</form>
			</div>
			<?php if (isset($errors) && is_array($errors)): ?>
				<div class="col-md-3">
					<ul class="errors">
						<?php foreach($errors as $error): ?>
							<li> - <?php echo $error; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php  include ROOT . '/views/layouts/footer.php' ?>