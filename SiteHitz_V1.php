<?php
/**
 * @package Site Hitz
 * @version 1
 */
/*
Plugin Name: 	Site Hitz 
Plugin URI: 
Description: 	This is a plugin to count the site visitors to your website.
Author: 		Attorney Celeste
Version: 		1
Author URI: 	attorneyceleste.com
Text Domain:    Site-Hitz
License:        GPL3 - As modified
License URI:    https://www.gnu.org/licenses
License: Site Hitz is free software - You CANNOT redistribute it and/or 
modify it under any circumstances, without the permission of the author.
If you receive permission of the author you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version. Site Hitz  is distributed in the hope 
that it will be useful, but WITHOUT ANY WARRANTY; without even the implied 
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. A copy of 
the GNU General Public License is available at <https://www.gnu.org/licenses/>.
*/ 
//----------//----------//----------
register_activation_hook( __FILE__, 'pluginprefix_function_to_run' );
register_uninstall_hook(__FILE__, 'pluginprefix_function_to_run');
register_deactivation_hook( __FILE__, 'pluginprefix_function_to_run' );
//----------//----------//----------
function Site_Hitzlol_Admins_VisitorStatz_DailyCount() {
		global $wpdb;		
		foreach($wpdb->get_results('SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) = CURDATE();' ) as $key => $row) {
		echo '<h3><img src="' . plugin_dir_url( __FILE__ ) . './public/images/Site Hitz Visitor Counter.png" alt="Site Hitz Visitor Counter" width="12%" height="auto"> Today\'s Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}} 
add_action( 'admin_notices', 'Site_Hitzlol_Admins_VisitorStatz_DailyCount' );
//----------//----------//----------
function Site_Hitzlol_VisitorPageVisited(){	
		$post_author = wp_get_current_user();
		$post_content = ' <B>IP ADDRESS(ES):</B> ' . $_SERVER['REMOTE_ADDR'] .	', '. $_SERVER['HTTP_X_FORWARDED_FOR'] . '||| <B>BROWSER:</B> ' . $_SERVER['HTTP_USER_AGENT'] . '||| <B>PAGE VISITED:</B> ' . get_the_title() . ' ';
		$post_title = "SITE HITZ VISITOR STATS";
		$SS_post = array( 'post_title' => wp_strip_all_tags( $post_title ), 'post_content' => $post_content, 'post_author' => $post_author->ID .': '. $post_author->user_login, 'post_status' => 'private', 'post_type' => 'post', 'post_category' => array( 'Site_Hitz' ) );
		wp_insert_post( $SS_post );
}
function cf_shortcode_Site_Hitzlol_VisitorPageVisited(){
	ob_start();
	Site_Hitzlol_VisitorPageVisited();
	return ob_get_clean();
}
add_shortcode( 'Site_Hitzlol_VisitorPageVisited', 'cf_shortcode_Site_Hitzlol_VisitorPageVisited' );
//----------//----------//----------
function Site_Hitzlol_VisitorStatz_List(){
		global $wpdb;
		echo '<table>
			  <tr>
			   <img src="' . plugin_dir_url( __FILE__ ) . './public/images/Site Hitz Visitor Counter.png" alt="Site Hitz Visitor Counter" width="45%" height="auto"> 
			  </tr>
			  <tr><th>Date</th><th>IP Address</th></tr>';
			foreach($wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" ORDER BY 1 DESC' ) as $key => $row) { 
				echo '<tr><td>' . $row->post_date . '</td><td>' . $row->post_content  . '</td></tr>';}
		echo '</table>';
		}
function cf_shortcode_Site_Hitzlol_VisitorStatz_List(){
	ob_start();
	Site_Hitzlol_VisitorStatz_List();
	return ob_get_clean();
}
add_shortcode( 'Site_Hitzlol_VisitorStatz_List', 'cf_shortcode_Site_Hitzlol_VisitorStatz_List' );
//----------//----------//----------
function Site_Hitzlol_VisitorStatz_DailyCount(){
		global $wpdb;		
		foreach($wpdb->get_results(
		'SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) = CURDATE();' ) as $key => $row) { 
			echo '<h3>Today\'s Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}
		}
function Site_Hitzlol_VisitorStatz_Past3DayCount(){
		global $wpdb;		
		foreach($wpdb->get_results(
		'SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) >= ( CURDATE() - INTERVAL 3 DAY );' ) as $key => $row) { 
			echo '<h3>3-Day Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}
		}
function Site_Hitzlol_VisitorStatz_Past10DayCount(){
		global $wpdb;		
		foreach($wpdb->get_results(
		'SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) >= ( CURDATE() - INTERVAL 10 DAY );' ) as $key => $row) { 
			echo '<h3>10-Day Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}
		}
function Site_Hitzlol_VisitorStatz_Past30DayCount(){
		global $wpdb;		
		foreach($wpdb->get_results(
		'SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) >= ( CURDATE() - INTERVAL 30 DAY );' ) as $key => $row) { 
			echo '<h3>1-Month Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}
		}
function Site_Hitzlol_VisitorStatz_Past60DayCount(){
		global $wpdb;		
		foreach($wpdb->get_results(
		'SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) >= ( CURDATE() - INTERVAL 60 DAY );' ) as $key => $row) { 
			echo '<h3>2-Month Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}
		}
function Site_Hitzlol_VisitorStatz_Past90DayCount(){
		global $wpdb;		
		foreach($wpdb->get_results(
		'SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) >= ( CURDATE() - INTERVAL 90 DAY );' ) as $key => $row) { 
			echo '<h3>3-Month Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}
		}
function Site_Hitzlol_VisitorStatz_Past120DayCount(){
		global $wpdb;
		foreach($wpdb->get_results(
		'SELECT COUNT(*) AS COUNTSZ FROM ' . $wpdb->prefix . 'posts WHERE post_title = "SITE HITZ VISITOR STATS" AND DATE(`post_date`) >= ( CURDATE() - INTERVAL 120 DAY );' ) as $key => $row) { 
			echo '<h3>4-Month Visitor Count: ' . $row->COUNTSZ . '</h3><br>';}
		}
function cf_shortcode_Site_Hitzlol_VisitorStatz_Counts(){
	ob_start();
	echo '<div>
			<img src="' . plugin_dir_url( __FILE__ ) . './public/images/Site Hitz Visitor Counter.png" alt="Site Hitz Visitor Counter" width="40%" height="auto">';
		  Site_Hitzlol_VisitorStatz_DailyCount();
		  Site_Hitzlol_VisitorStatz_Past3DayCount();
		  Site_Hitzlol_VisitorStatz_Past10DayCount();
		  Site_Hitzlol_VisitorStatz_Past30DayCount();
		  Site_Hitzlol_VisitorStatz_Past60DayCount();
		  Site_Hitzlol_VisitorStatz_Past90DayCount();
		  Site_Hitzlol_VisitorStatz_Past120DayCount();
	echo '</div>';	  
	return ob_get_clean();
}
add_shortcode( 'Site_Hitzlol_VisitorStatz_Counts', 'cf_shortcode_Site_Hitzlol_VisitorStatz_Counts' );