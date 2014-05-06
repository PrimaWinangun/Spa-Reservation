 <!-- /**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id : 
	 * App code : wmsdps
	 *
	 * sidebar views
	 *
	 * url : http://dom.wms.dps.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : panca dharma wisesa (pandhawa digital)
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 *
	 * copyright by panca dharma wisesa (pandhawa digital)
	 * Do not copy, modified, share or sell this script 
	 * without any permission from developer
	 */
-->
 
 <div class="sidebar-nav">
        <?php 
			$session = $this->session->userdata('log_data'); 
			$view = 'class="active"';
		?>
		<?php if(! isset($modul)){$modul='';}?>
		
		<!-- Reservation Sidebar -->
		<?php if ($session['position'] == 'reservation' OR $session['authority'] > 1 OR $session['position'] == 'therapist') {?>
        <a href="#accounts-reservation" class="nav-header <?php if($modul == 'reservation'){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-briefcase"></i>Reservation</a>
        <ul id="accounts-reservation" class="nav nav-list collapse <?php if($modul == 'reservation'){echo 'in';}?>">
		<?php if ($session['position'] == 'reservation' OR $session['authority'] > 1) {?>
        	<li <?php if(isset($sidebar_new_reservation)){ echo $view; } ?>>
				<?php echo anchor('reservation/admin', 'New Reservation' ); ?>
			</li>
            <li <?php if(isset($sidebar_list_reservation)){ echo $view; } ?>>
				<?php echo anchor('reservation/admin/list_reservation', 'Reservation List' ); ?>
			</li>
		<?php } ?>
		<?php if ($session['position'] == 'therapist' OR $session['position'] == 'reservation' OR $session['authority'] > 1){?>
			<li <?php if(isset($sidebar_room_available)){ echo $view; } ?>>
				<?php echo anchor('reservation/admin/room_available', 'Available Room' ); ?>
			</li>
		<?php } ?>
        </ul>
		<?php } ?>
		<!-- Reservation Sidebar -->
		
		<!-- Cashier Sidebar -->
		<?php if ($session['position'] == 'cashier' OR $session['authority'] > 1) {?>
		<a href="#accounts-billing" class="nav-header <?php if($modul == 'cashier'){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-glass"></i>Billing</a>
        <ul id="accounts-billing" class="nav nav-list collapse <?php if($modul == 'cashier'){echo 'in';}?>">
        	<li <?php if(isset($sidebar_new_payment)){ echo $view; } ?>>
				<?php echo anchor('cashier/payment', 'New Payment' ); ?>
			</li>
            <li <?php if(isset($sidebar_list_payment)){ echo $view; } ?>>
				<?php echo anchor('cashier/payment/payment_list', 'Payment List' ); ?>
			</li>
			<li <?php if(isset($sidebar_payment_report)){ echo $view; } ?>>
				<?php echo anchor('cashier/payment/payment_report', 'Payment Report' ); ?>
			</li>
        </ul>
		<?php } ?>
		<!-- Cashier Sidebar -->
		
		<!-- Report Sidebar -->
		<?php if ($session['position'] == 'report' OR $session['authority'] > 1 OR $session['position'] == 'therapist') {?>
		<a href="#accounts-report" class="nav-header <?php if($modul == 'report'){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-file"></i>Report</a>
        <ul id="accounts-report" class="nav nav-list collapse <?php if($modul == 'report'){echo 'in';}?>">
			<?php if ($session['position'] == 'report' OR $session['authority'] > 1){?>
        	<li <?php if(isset($sidebar_report_payment)){ echo $view; } ?>>
				<?php echo anchor('report/generate/payment', 'Payment Report' ); ?>
			</li>
			<li <?php if(isset($sidebar_report_product)){ echo $view; } ?>>
				<?php echo anchor('report/generate/product', 'Product Report' ); ?>
			</li>
			<?php } ?>
			<?php if ($session['position'] == 'therapist' OR $session['position'] == 'report' OR $session['authority'] > 1){?>
            <li <?php if(isset($sidebar_report_therapist)){ echo $view; } ?>>
				<?php echo anchor('report/generate/therapist', 'Therapist Report' ); ?>
			</li>
			<?php } ?>
        </ul>
		<?php } ?>
		<!-- Report Sidebar -->
		
		<!-- Setting Sidebar -->
		<?php if ($session['position'] == 'setting' OR $session['authority'] > 1) {?>
		<a href="#accounts-setting" class="nav-header <?php if($modul == 'setting'){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-wrench"></i>Setting</a>
        <ul id="accounts-setting" class="nav nav-list collapse <?php if($modul == 'setting'){echo 'in';}?>">
        	<li <?php if(isset($sidebar_list_user)){ echo $view; } ?>>
				<?php echo anchor('setting/user', 'List User' ); ?>
			</li>
			<li <?php if(isset($sidebar_list_room_cat)){ echo $view; } ?>>
				<?php echo anchor('setting/admin/new_room_cat', 'List Room Category' ); ?>
			</li>
			<li <?php if(isset($sidebar_list_room)){ echo $view; } ?>>
				<?php echo anchor('setting/admin/new_room', 'List Room' ); ?>
			</li>
			<li <?php if(isset($sidebar_list_therapist)){ echo $view; } ?>>
				<?php echo anchor('setting/admin/new_therapist', 'List Therapist' ); ?>
			</li>
			<li <?php if(isset($sidebar_list_product_cat)){ echo $view; } ?>>
				<?php echo anchor('setting/admin/new_product_cat', 'List Product Category' ); ?>
			</li>
			<li <?php if(isset($sidebar_list_product)){ echo $view; } ?>>
				<?php echo anchor('setting/admin/new_product', 'List Product' ); ?>
			</li>
			<li <?php if(isset($sidebar_list_travel)){ echo $view; } ?>>
				<?php echo anchor('setting/admin/new_travel', 'List Travel' ); ?>
			</li>
			<li <?php if(isset($sidebar_payment_type)){ echo $view; } ?>>
				<?php echo anchor('setting/admin/new_payment_type', 'List Payment Type' ); ?>
			</li>
        </ul>
		<?php } ?>
		<!-- Setting Sidebar -->
		
		<!-- Information Sidebar -->
        <a href="#information-menu" class="nav-header <?php if($modul == 'information'){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-info-sign"></i>Information</a>
        <ul id="information-menu" class="nav nav-list collapse <?php if($modul == 'information'){echo 'in';}?>">
		<?php if ($this->session->userdata('log_data') != NULL) {?>
            <li><?php echo anchor('login/logout', 'Logout', 'Home'); ?></li>
		<?php } else {?>
            <li><?php echo anchor('login', 'Login', 'Home'); ?></li>
		<?php } ?>
            <li><?php echo anchor('privacy_policy', 'Privacy Policy', 'Privacy Policy'); ?></li>
        </ul>
		<!-- Information Sidebar -->
       
        
              
    </div>