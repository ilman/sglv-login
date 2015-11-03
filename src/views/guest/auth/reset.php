<?php 
	use Scienceguard\SG_Form;

	$attr = array(
		'class' => 'form-control'
	);
?>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-login">
			<div class="panel-body">
				<form method="post" action="<?php echo url('reset') ?>">
					<div class="form-group">
						<label><?php echo trans('label.password') ?></label>
						<?php $attr['tabindex'] = 1; ?>
						<?php echo SG_Form::field('text', 'password', $values, $attr) ?>
					</div>
					<div class="form-group">
						<label><?php echo trans('label.confirm_password') ?></label>
						<?php $attr['tabindex'] = 2; ?>
						<?php echo SG_Form::field('text', 'password_confirmation', $values, $attr) ?>
					</div>
					<div class="form-group">
						<?php echo SG_Form::field('hidden', 'username', $values) ?>
						<?php echo SG_Form::field('hidden', 'code', $values) ?>
						<button class="btn btn-block btn-default" type="submit"><?php echo trans('label.btn_submit') ?></button>
					</div>
				</form>
			</div>
		</div>
		<!-- panel -->
	</div>
	<!-- col -->
</div>
<!-- row -->