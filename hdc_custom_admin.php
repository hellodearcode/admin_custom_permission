<?php
/**
 * Plugin Name: Custom Admin Role Menu
 * Plugin URI: http://pmknutsen.no
 * Description: customized admin menu by role assign
 * Version: 1.0
 * Author: Pal Mattias
 * Author URI: http://pmknutsen.no
 * License: GPL2
 */

function add_roles_on_hdc_plugin_activation() {
    add_role( 'dry_user', 'Dry User', get_role( 'editor' )->capabilities );
}
register_activation_hook( __FILE__, 'add_roles_on_hdc_plugin_activation' );


function remove_roles_on_hdc_plugin_deactivation() {
    remove_role( 'dry_user' );
}
register_deactivation_hook( __FILE__, 'remove_roles_on_hdc_plugin_deactivation' );

add_action('admin_menu', 'remove_admin_menu_links',999);
function remove_admin_menu_links(){
    $user = wp_get_current_user();

    if($user && isset($user->roles) && 'dry_user' == $user->roles[0] ) {
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'themes.php' );
        remove_menu_page( 'index.php' );
        remove_menu_page( 'options-general.php' );
        remove_menu_page( 'plugins.php' );
        remove_menu_page( 'users.php' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'edit-tags.php?taxonomy=category' );
        remove_menu_page( 'import.php' );
        remove_menu_page( 'page.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'edit.php?post_type=page' ); 
        remove_menu_page( 'edit.php?post_type=videos' );
        remove_menu_page( 'wc-admin&path=/analytics/revenue' );
        remove_menu_page( 'edit.php' );
        
        remove_submenu_page( 'woocommerce', 'wc-status' );
        remove_submenu_page( 'woocommerce', 'wc-addons' );
        remove_submenu_page( 'woocommerce', 'wc-settings' );
        remove_submenu_page( 'woocommerce', 'wc-admin' );
        
    }
}

function wpse_260669_remove_new_content_items(){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'new-post' ); // hides post CPT
    $wp_admin_bar->remove_menu( 'new-page' ); // hides page CPT
    $wp_admin_bar->remove_menu( 'new-media' ); // hides media
    $wp_admin_bar->remove_menu( 'new-user' ); // hides media
    $wp_admin_bar->remove_menu( 'new-shop_coupon' ); // hides media
    $wp_admin_bar->remove_menu( 'new-shop_order' ); // hides media
    $wp_admin_bar->remove_menu( 'comments' ); // hides media
}
add_action( 'wp_before_admin_bar_render', 'wpse_260669_remove_new_content_items',999 );

?>