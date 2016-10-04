<?php
return array(
	
	'user/login' => 'user/login',
	'user/logout' => 'user/logout',
	'comment/edit/([0-9]+)' => 'comments/edit/$1',
	'comment/changeConfirmation/([0-9]+)' => 'comments/changeConfirmation/$1',
	'comments/validatePreview' => 'comments/validatePreview',
	'comments/sort/([a-z]+)' => 'comments/index/$1',
	'' => 'comments/index',
	
);
