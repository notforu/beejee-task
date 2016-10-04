<?php  include ROOT . '/views/layouts/header.php' ?>

<div class="comment-list" id="content">
	<div class="page-header">
		<?php if ($comments): ?>
			<h1 class="text-center">Comments</h1>
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<h4>Sort by:</h4>
						<a class='btn btn-default' href='/comments/sort/date'>Date</a>
						<a class='btn btn-default' href='/comments/sort/name'>Name</a>
						<a class='btn btn-default' href='/comments/sort/email'>Email</a>
					</div>
				</div>
			</div>
		<?php else: ?>
			<h1 class="text-center">There are no confirmed comments</h1>
		<?php endif; ?>
	</div>
	<div class="container">
		<?php if ($result && !Users::isAdmin()): ?>
			<h3 class="text-center">Your comment have been sent! We will publish it after moderation.</h3>
		<?php endif; ?>
		<?php foreach ($comments as $comment): ?>
			<div class="row comment-row">
				<div class="col-md-4 col-sm-12">
					<?php if ($comment['image']): ?>
						<img class="image center" src="<?php echo $comment['image']; ?>" />
					<?php else: ?>
						<h3 class="text-center image center">No image</h3>
					<?php endif; ?>
				</div>
				
				<div class="col-md-4 col-sm-12">
					<h4 class="text-center">Published by <?php echo $comment['name'] ?> at <?php echo $comment['date'] ?>:</h4>
					<div class="content text-center"><?php echo $comment['text'] ?></div>
					<div class="email text-center">Author's e-mail: <?php echo $comment['email'] ?></div>
					<?php if ($comment['was_edited']): ?>
						<div class="edit-date text-center">Edited by admin (<?php echo $comment['edit_date']; ?>)</div>
					<?php endif; ?>
				</div>
				
				<div class="col-md-4 col-sm-12">
					<div class="center">
						<?php if (Users::isAdmin()): ?>
							<h2 class="text-center">Actions</h2>
							<div class="center">
								<a class='edit-button btn btn-default' href='/comment/edit/<?php echo $comment['id']; ?>'>
									Edit
								</a>
								<div class='confirm-button btn btn-default' data-id="<?php echo $comment['id']; ?>">
									<?php echo $comment['confirmed'] ? 'Reject' : 'Confirm'; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		
		<div class="row">
			<h2 class="text-center">Add comment</h2>
			<div class="col-md-6 col-md-offset-3 comment-form">
				<form action="#" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">Your name:</label>
						<input id="comment-name" class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $name ?>" />
					</div>
					<div class="form-group">
						<label for="email">Email address:</label>
						<input id="comment-email" class="form-control" type="email" name="email" placeholder="E-mail" value="<?php echo $email ?>" />
					</div>
					<div class="form-group">
						<label for="text">Your comment:</label>
						<textarea id="comment-text" class="form-control" name="text" placeholder="Enter text here"><?php echo $commentText ?></textarea>
					</div>
					<div class="form-group">
						<label for="image">Add image:</label>
						<input id="comment-image" class="form-control" type="file" name="image" accept="image/jpeg,image/png,image/gif" />
					</div>
					<input class="btn btn-default" type="submit" name="submit" value="Submit" />
					<a class="btn btn-default" id="show-preview" data-toggle="modal" data-target="#preview">
						Show preview
					</a>
				</form>
			</div>
			
			<div class="col-md-3">
				<ul class="errors">
					<?php if (isset($errors) && is_array($errors)): ?>
						<?php foreach($errors as $error): ?>
							<li> - <?php echo $error; ?></li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php  include ROOT . '/views/layouts/preview.php' ?><!-- preview modal window -->

<?php  include ROOT . '/views/layouts/footer.php' ?>