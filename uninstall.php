<?php
/**
 * a3 Lazy Load Uninstall
 *
 * Uninstalling deletes options, tables, and pages.
 *
 */
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

// Delete Google Font
delete_option('pvc_google_api_key');
delete_option('pvc_google_api_key' . '_enable');
delete_transient('pvc_google_api_key' . '_status');
delete_option('pvc' . '_google_font_list');

if ( get_option('pvc_clean_on_deletion') == 1 ) {
	delete_option('pvc_toggle_box_open');
	delete_option('pvc' . '-custom-boxes');
//Delete meta data
	delete_metadata( 'user', 0, 'pvc' . '-' . 'plugin_framework_global_box' . '-' . 'opened', '', true );
//Delete pvc settings
	delete_option('pvc_settings');
	delete_option('a3_pvc_version');
	delete_option('a3rev_pvc_plugin');
	delete_option('a3rev_auth_pvc');
	delete_option('pvc_clean_on_deletion');

	global $wpdb;
	$wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'pvc_total');
	$wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'pvc_daily');

	$wpdb->query( "DELETE FROM ".$wpdb->postmeta." WHERE meta_key='_a3_pvc_activated' " );
}
