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
				<form method="post" action="<?php echo url('forgot') ?>">
					<div class="form-group">
						<label><?php echo trans('label.username_email') ?></label>
						<?php $attr['tabindex'] = 1; ?>
						<?php echo SG_Form::field('text', 'email', $values, $attr) ?>
					</div>
					<div class="form-group">
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