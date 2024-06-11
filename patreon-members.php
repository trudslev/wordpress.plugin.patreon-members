<?php
/*
 * Plugin Name: Patreon Members
 * Description: Enables members in Wordpress based on Patreon Subscriptions
 * Version:     1.0
 * Author:      Sune Trudslev
 * Author URI:  https://foodgeek.dk
 */

//if ( ! defined( 'ABSPATH' ) ) {
//    exit; // Don't access directly.
//}

function custom_patreon_role_manager() {
    $user = wp_get_current_user();

    $pledge_amount = Patreon_Wordpress::getUserPatronage( $user->ID );
	if($patreon_amount > 0) {
        $user->set_role( 'member' );
	}
	else {
        $user->remove_role( 'member' );
    }
}
add_action( 'patreon_action_after_wp_logged_user_is_updated', 'custom_patreon_role_manager' );
add_action( 'patreon_do_action_after_user_logged_in_via_patreon', 'custom_patreon_role_manager' );
add_action( 'patreon_do_action_after_new_user_created_from_patreon_logged_in', 'custom_patreon_role_manager' );
add_action( 'patreon_do_action_after_existing_user_from_patreon_logged_in', 'custom_patreon_role_manager' );

function patreonmembers_log($str) {
    file_put_contents('./log_'.date("j.n.Y").'.log', $str . PHP_EOL, FILE_APPEND);
}
