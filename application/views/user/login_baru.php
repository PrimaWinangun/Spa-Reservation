<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PT Gapura Angkasa DPS - Administration Management System</title>
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">   
	<link href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/css/pages/login.css" rel="stylesheet" type="text/css"/>
	<link href="http://localhost/siak_ika/uploads/login/css/style-responsive.css" rel="stylesheet" type="text/css"/>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
<body class="login">
	<div class="logo" style="margin-bottom:20px">
    <img src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/images/logo/gapura-angkasa.png" alt="PT. Gapura Angkasa DPS"/>
	</div>
	<div class="content">		
        <form class="form-vertical login-form" action="<?php echo base_url(); ?>user/cek_login" method="post">
			<h3>LOGIN <span style="font-size:18px">WMS GAPURA DPS</span></h3>
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
			</div>
            <?php if($message != NULL) { ?><div class="alert alert-error"><?php echo $message; ?></div><?php } ?>
			<div class="form-actions">
				<input  type="submit" class="btn blue pull-right" name="login" value="Login">
			</div>
			<div class="privacy">
				<p><div style="float:right"><a href="javascript:;" id="privacy" style="color:#eee">Privacy Policy</a></div>
                <div style="clear:both"></div>
                </p>
			</div>
		</form>        	
	</div>
    <div class="fullwidth_content" style="display:none">
    	<div class="scroller" style="height:400px;">
       <?php $this->load->view('template/privacy_policy_forlogin'); ?>
       </div>
       <p>&nbsp;</p>
       <button id="back-btn" type="button" class="btn blue">Back</button>
    </div>
	<div class="copyright">
		2013 &copy; <a href="http://dps.gapura.co.id/" target="_blank" style="color:#eee">
        WMS GAPURA DENPASAR</a><br /><small>APP.08090102 WMS DPS v3.0</small>
	</div>
<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>   
<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>   
<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/new-wms/lib/pages/login.js" type="text/javascript"></script>      
</body>
</html>