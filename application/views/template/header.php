<!DOCTYPE html>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title.' - '.ucfirst($modul)?></title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/stylesheets/pagination.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/font-awesome/css/font-awesome.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/ui-lightness/jquery-ui-1.10.3.custom.min.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/datetimepicker/jquery.datetimepicker.css">
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/js/jquery-1.9.1.js" type="text/javascript"></script>
   <script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script> 
  <script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/datetimepicker/jquery.datetimepicker.js" type="text/javascript" charset="utf-8"></script>

<script>
	jQuery(function ($) {
        $("a").tooltip()
    });
	
  	$(function() {
    	$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy' });
  	});
	
</script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    
    
    <div class="navbar">
    
    
        <div class="navbar-inner">
        
				<?php $trial = $this->session->userdata('trial');
				if ($trial == ''){?>
					<a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/images/thebanjarbali.png" /></a>
				<?php } else {
					echo '<br/><strong><span style="font-size:30px">Trial Version<span></strong>';
				}?>
    
                
                <ul class="nav pull-right">
                	<li><a href=""><?php echo ucwords($page_title); ?></a></li>
                	<?php
                    $session_data = $this->session->userdata('log_data');
					if($this->session->userdata('log_data'))
	    			{
					?>
                    	<li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo ucfirst($session_data['username']); ?>
                            <i class="icon-caret-down"></i>
                        </a>

                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?php echo base_url(); ?>index.php/login/logout/">Logout</a></li>
                            </ul>
                    	</li>
					
                    <?php
					}
					else
					{
					?>
						<li><a href="<?php echo base_url(); ?>index.php/login/" class="hidden-phone visible-tablet visible-desktop" role="button">Login</a></li>
                       
					<?php
                    }
					?>
                </ul>
                
        </div>
    </div>
    
    

