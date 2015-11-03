<!DOCTYPE html>
<?php
	use Scienceguard\SG_Util;

	include(view_path('admin/template/vars'));
?>
<html>
	<head>
		

		<?php include(view_path('admin/template/head')); echo "\n"; ?>

		<!-- Ionicons -->
		<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="skin-blue sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">

			<?php include(view_path('admin/template/header')) ?>

			

			<!-- =============================================== -->

			<!-- Left side column. contains the sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<?php include(view_path('admin/template/sidebar')) ?>
				</section>
				<!-- /.sidebar -->
			</aside>

			<!-- =============================================== -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" id="content">
				<!-- Content Header (Page header) -->
				<?php if($subheader): ?>
					<section class="content-header navbar">
						<div class="navbar-left">
							<?php echo SG_Tags::pageTitle($page_title, $page_title_params); ?>
						</div>
						<div class="navbar-right">
							<?php 
								$breadcrumb = (isset($breadcrumb)) ? $breadcrumb : $request_path;
								echo SG_Tags::breadcrumb($breadcrumb);
							?>
						</div>
					</section>
				<?php endif; ?>

				<!-- Main content -->
				<section class="content">
					<?php
						echo Notification::container();
						Notification::clearAll();

						$error_messages = $errors->all();
						if($error_messages){
							echo Notification::errorInstant($error_messages);
						}
					?>
					<?php include(view_path($content)); echo "\n"; ?>

				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

			<footer class="main-footer">
				<?php include(view_path('admin/template/footer')); echo "\n"; ?>
			</footer>
			
			<!-- Control Sidebar -->      
			<aside class="control-sidebar control-sidebar-dark">

			</aside>
			<!-- /.control-sidebar -->
			<!-- Add the sidebar's background. This div must be placed
					 immediately after the control sidebar -->
			<div class='control-sidebar-bg'></div>
		</div><!-- ./wrapper -->


		<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="80%" style="display: none;"></div>
		<!-- ajax modal -->

		<script src="<?php echo asset($admin_asset_url.'/assets/js/vendors.min.js') ?>"></script>
		<script src="<?php echo asset($admin_asset_url.'/assets/js/functions.js') ?>"></script>
		
		<?php echo \Lib\Template::printScript(); echo "\n"; ?>
		<script src="<?php echo asset($admin_asset_url.'/assets/js/script.js') ?>"></script>


	</body>
</html>