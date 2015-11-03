<div class="row ajax-resize-content">
	<div class="col-sm-8 col-sm-offset-2">
		
	</div>
	<!-- col -->
</div>
<!-- row -->

<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo url() ?>"><strong>Admin</strong>LTE</a>
	</div><!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to admin area</p>
		<form method="post" action="<?php echo url('login') ?>">
			<?php include('login_form.php') ?>
		</form>
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->