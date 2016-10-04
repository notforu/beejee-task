<?php  include ROOT . '/views/layouts/header.php' ?>


	<div class="page-header">
		<h1 class="text-center">Edit comment</h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<?php if ($comment['image']): ?>
							<img class="image center" src="<?php echo $comment['image']; ?>" />
						<?php else: ?>
							<h3 class="text-center image center">No image</h3>
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2 class="name comment-field text-center"><?php echo $comment['name'] ?>'s comment</h2>
						<div class="email comment-field text-center">Email: <?php echo $comment['email'] ?></div>
						<div class="date comment-field text-center">Date of publication: <?php echo $comment['date'] ?></div>
					</div>
				</div>
				<div class="row comment-field">
					<div class="col-md-8 col-md-offset-2 col-sm-12">
						<form action="#" method="post">
							<div class="form-group">
								<label for="text">Edit comment text:</label>
								<textarea class="form-control" name="text" placeholder="Enter text here"><?php echo $text ?></textarea>
							</div>
							<div class="row">
								<div class="col-md-4 col-md-offset-4 col-sm-12">
									<input id="edit-button" class="btn btn-default" type="submit" name="submit" value="Submit" />
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-2 col-sm-12">
						<?php if (isset($errors) && is_array($errors)): ?>
							<ul class="errors">
								<?php foreach($errors as $error): ?>
									<li> - <?php echo $error; ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>	
		</div>
	</div>
<?php  include ROOT . '/views/layouts/footer.php' ?>