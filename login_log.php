<?php
class afo_login_log{
	
	function __construct(){
		add_action( 'admin_menu', array( $this, 'login_log_afo_menu' ) );
	}
	
	function login_log_afo_menu () {
		add_options_page( 'Login Logs', 'Login Logs', 'activate_plugins', 'login_log_afo', array( $this, 'login_log_afo_options' ));
	}
	
	function  login_log_afo_options () {
		global $wpdb;
		$lmc = new login_message_class;
		$lmc->show_message();
		?>
        <h1>Login Log</h1>
        <div style="height:300px; width:90%; overflow-y:scroll;background-color:#FFFFFF; border:1px solid #999999; padding: 5px; margin-top:10px;">
		<table width="100%" border="0">
		 <tr>
			<td width="30%"><strong>IP</strong></td>
            <td width="30%"><strong>Message</strong></td>
            <td width="20%"><strong>Time</strong></td>
            <td width="20%"><strong>Status</strong></td>
		  </tr>
          <?php
		  $data = $wpdb->get_results( "SELECT `ip`,`msg`,`l_added`,`l_status` FROM `".$wpdb->prefix."login_log` ORDER BY `l_added` DESC LIMIT 1000", ARRAY_A );
		  foreach ( $data as $d ) {
		  ?>
          <tr>
			<td><?php echo $d['ip'];?></td>
            <td><?php echo $d['msg'];?></td>
            <td><?php echo $d['l_added'];?></td>
            <td><?php echo $d['l_status'];?></td>
		  </tr>
          <?php } ?>
		</table>
        </div>
		
		 <div style="width:90%;background-color:#FFFFFF; border:1px solid #999999; padding: 5px; margin-top:10px;">
		<table width="100%" border="0">
		<tr>
		<td>
        Use <strong><a href="http://www.aviplugins.com/fb-login-widget-pro/" target="_blank">PRO</a></strong> version that has added security with <strong>Blocking IP</strong> after 5 wrong login attempts. <strong>Blocked IPs</strong> can be <strong>Whitelisted</strong> from admin panel or the <strong>Block</strong> gets automatically removed after <strong>1 Day</strong>.
        </td>
	  </tr>
	</table>
		</div>
		<?php
	}
}