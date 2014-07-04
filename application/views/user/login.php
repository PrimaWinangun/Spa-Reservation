<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>The Banjar Bali - Reservation System</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/select2/select2_metro.css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo" style="margin-bottom:20px">
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
	<?php if ($trial == ''){	
		echo '<img src="'.base_url().'wp-content/themes/thebanjarbali/rsv/images/thebanjarbali.png" alt="The Banjar Bali"/>';}
	?>
        <form class="form-vertical login-form" action="<?php echo base_url(); ?>index.php/login/cek_login" method="post">
			<?php if ($trial != ''){
				echo '<h3><strong>Trial Version</strong></h3>';
			} else {
				echo '<h3><strong>LOGIN <span style="font-size:17px">Reservation System</span></h3>';
			}?>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
                        <?php echo form_input('username','','class="m-wrap placeholder-no-fix" autocomplete="off" placeholder="Username"'); ?>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<?php echo form_password('password','','class="m-wrap placeholder-no-fix" autocomplete="off" placeholder="Password"'); ?>
			</div>
			</div>
            <?php if($message != NULL) { ?><div class="alert alert-error"><?php echo $message; ?></div><?php } ?>
			<div class="form-actions">
				<input  type="submit" class="btn blue pull-right" name="login" value="Login">
			</div>
		</form>
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		2014 &copy; <a href="#" target="_blank" style="color:#eee">
        The Banjar Bali</a><br /><small>APP.RSV.ALCD ver 1.0.0</small>
	</div>
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/excanvas.min.js"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/plugins/select2/select2.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/scripts/app.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/login/scripts/login-soft.js" type="text/javascript"></script>      
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		  
		  <?php if($this->session->flashdata('messages_register') != NULL) { ?>
		  jQuery('.login-form').hide();
	      jQuery('.register-form').show();
		  <?php } ?>
		  
		  
		  <?php if($this->session->flashdata('messages_reset') != NULL) { ?>
		  jQuery('.login-form').hide();
	      jQuery('.forget-form').show();
		  <?php } ?>
		  
		  <?php if($this->session->flashdata('go_reset') != NULL) { ?>
		  jQuery('.login-form').hide();
	      jQuery('.reset-form').show();
		  <?php } ?>
		  
		  $(".alert-error").delay(3000).fadeOut(500);
		  
		  
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>