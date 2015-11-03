<!DOCTYPE html>
<?php
	use Scienceguard\SG_Util;

	include(view_path('admin/template/vars'));
?>
<html>
	<head>
		<?php include(view_path('admin/template/head')); echo "\n"; ?>
	</head>
	<body class="login-page">
		<?php
			echo Notification::container();
			Notification::clearAll();

			$error_messages = $errors->all();
			if($error_messages){
				echo Notification::errorInstant($error_messages);
			}
		?>
		<?php include(view_path($content)); echo "\n"; ?>
		

	</body>
</html>