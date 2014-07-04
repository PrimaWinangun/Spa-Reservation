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
			if(! isset($modul)){$modul='';}
			
			foreach ($sidebar['modul'] as $row)
			{ ?>
				<!-- <?php echo 'start of '.$row->modul.' sidebar'; ?>-->
				 <a href="#accounts-<?php echo $row->modul?>" class="nav-header <?php if($modul == $row->modul){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-<?php echo $row->modul?>"></i><?php echo ucfirst($row->modul)?></a>
				<ul id="accounts-<?php echo $row->modul?>" class="nav nav-list collapse <?php if($modul == $row->modul){echo 'in';}?>">
				<?php 
				foreach ($sidebar[$row->modul] as $list)
				{
					$show = 'sidebar_'.strtolower(str_replace(' ','_', $list->sidebar));?>
					<li <?php if(isset($$show)){ echo $view; } ?>>
					<?php echo anchor($list->sub_modul, $list->sidebar ); ?>
					</li>
				<?php }
				?>
				</ul>
				<!-- <?php echo 'end of '.$row->modul.' sidebar'; ?>-->
			<?php }?>
		
		<!-- Information Sidebar -->
        <a href="#information-menu" class="nav-header <?php if($modul == 'information'){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-info-sign"></i>Information</a>
        <ul id="information-menu" class="nav nav-list collapse <?php if($modul == 'information'){echo 'in';}?>">
		<?php if ($this->session->userdata('log_data') != NULL) {?>
            <li><?php echo anchor('login/logout', 'Logout', 'Home'); ?></li>
		<?php } else {?>
            <li><?php echo anchor('login', 'Login', 'Home'); ?></li>
		<?php } ?>
        </ul>
		<!-- Information Sidebar -->
       
        
              
    </div>