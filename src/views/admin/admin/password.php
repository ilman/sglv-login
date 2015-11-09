<?php 
	use Scienceguard\SG_Util;
	use Scienceguard\SG_Form;
	
	$attr = array(
		'class' => 'form-control'
	);
?>
<form method="post" action="<?php echo url('admin/password') ?>">
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 content-main">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo trans('heading.password_form') ?></div>
			<!-- panel heading -->
			<div class="panel-body">

				<div class="form-group">
					<label><?php echo trans('label.new_password') ?></label>
					<?php echo SG_Form::field('text', 'new_password', $values, $attr) ?>
				</div>

				<div class="form-group">
					<label><?php echo trans('label.confirm_new_password') ?></label>
					<?php echo SG_Form::field('text', 'confirm_new_password', $values, $attr) ?>
				</div>

				<div class="form-group text-right">
					<button class="btn btn-primary" type="submit"><?php echo trans('label.btn_submit') ?></button>
				</div>
				
				


			</div>
			<!-- panel body --> 
		</div>
		<!-- panel -->

		
	</div>
	<!-- content-main -->
</div>
<!-- row --> 
</form>