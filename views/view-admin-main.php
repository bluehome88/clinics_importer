<?php

/*
	Admin page has two tabs "Clinics" and "Practitioners"
*/

if( !defined('ABSPATH')){
	exit;
}

icp_log( "view-admin-main.php line (11)" );

?>

<div class="wrap icp_main">
    <form method="post" id="mainform" action="" enctype="multipart/form-data">
        <div class="icon32 icon32-icp-configuration" id="icon-icp"><br /></div>
        <h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
		<?php
			foreach ($tabs as $name => $label)
			    echo '<a href="' . admin_url('admin.php?page=icp&tab=' . $name) . '" class="nav-tab ' . ( $current_tab == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';

			do_action('icp_configuration_tabs');
		?>
        </h2>

		<?php
			do_action('icp_configuration_'.$current_tab);
			do_action('icp_configuration_tabs_'.$current_tab);
		?>        
    </form>
</div>