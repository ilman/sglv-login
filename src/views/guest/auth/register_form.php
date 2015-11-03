<?php 
	use Scienceguard\SG_Util;
	use Scienceguard\SG_Form;

	$attr = array( 'class' => 'form-control' );
?>
<div class="panel panel-login">
	<div class="panel-body">
		<a class="btn btn-block btn-default" href="<?php echo url('login-facebook') ?>">
			<i class="fa fa-facebook fa-fw"></i> <?php echo trans('label.btn_login_facebook') ?>
		</a>
		
		<?php echo SG_Tags::divider() ?>

		<div class="form-group">
			<label><?php echo trans('label.username') ?></label>
			<?php $attr['tabindex'] = 1; ?>
			<?php echo SG_Form::field('text', 'username', $values, $attr); ?>
		</div>
		<div class="form-group">
			<label><?php echo trans('label.email') ?></label>
			<?php $attr['tabindex'] = 2; ?>
			<?php echo SG_Form::field('text', 'email', $values, $attr); ?>
		</div>
		<div class="form-group">
			<label><?php echo trans('label.phone') ?></label>
			<?php $attr['tabindex'] = 3; ?>
			<?php echo SG_Form::field('text', 'phone', $values, $attr); ?>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label><?php echo trans('label.password') ?></label>
					<?php $attr['tabindex'] = 4; ?>
					<?php echo SG_Form::field('text', 'password', $values, $attr); ?>
				</div>
			</div>
			<!-- col -->
			<div class="col-sm-6">
				<div class="form-group">
					<label><?php echo trans('label.confirm_password') ?></label>
					<?php $attr['tabindex'] = 5; ?>
					<?php echo SG_Form::field('text', 'confirm_password', $values, $attr); ?>
				</div>
			</div>
			<!-- col -->
		</div>
		<!-- row -->

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block" tabindex="4">
				<?php echo trans('label.btn_register') ?>
			</button>
		</div>

		<?php echo SG_Tags::divider() ?>

		<div class="form-group login-row-last">
			<p class="text-center"><?php echo trans('label.already_have_account') ?>?</p>
			<a class="btn btn-block btn-default bg-white" href="<?php echo url('login') ?>">
				<?php echo trans('label.btn_login') ?>
			</a>
		</div>
	</div>
	<!-- panel body -->
</div>