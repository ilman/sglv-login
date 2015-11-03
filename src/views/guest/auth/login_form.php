<?php 
	use Scienceguard\SG_Util;
	use Scienceguard\SG_Form;

	$attr = array( 'class' => 'form-control' );
?>

<div class="form-group">
	<?php 
		$attr['tabindex'] = 1; 
		$attr['placeholder'] = 'Username'; 
	?>
	<?php echo SG_Form::field('text', 'username', $values, $attr) ?>
</div>
<div class="form-group">
	<?php 
		$attr['tabindex'] = 2;
		$attr['placeholder'] = 'Password';
	?>
	<?php echo SG_Form::field('text', 'password', $values, $attr) ?>
</div>
<div class="row">
	<div class="col-xs-8">          
	</div>
	<!-- col -->
	<div class="col-xs-4">
		<button type="submit" class="btn btn-primary btn-block btn-flat">
			<?php echo trans('label.btn_login') ?>
		</button>
	</div>
	<!-- col -->
</div>