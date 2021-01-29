<?php
/**
 * Plugin Name:     Optin Form
 * Plugin URI:      https://tubemint.com/wordpress-optin-form
 * Description:     This plugin creates a optin form on your posts and saves email to your database and thanks the subscriber.
 * Author:          Amulya Shahi
 * Author URI:      https://tubemint.com/
 * Text Domain:     wordpress-optin-form
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Optin_Form
 */

// defined( 'ABSPATH' ) || exit;

// plugin css and js file enqueue function


function enqueue_related_pages_scripts_and_styles(){
        wp_enqueue_style('related-styles', plugins_url('./optinform.css', __FILE__));
        wp_enqueue_script('releated-script', plugins_url( './optinform.js' , __FILE__ ));
    }
add_action('wp_enqueue_scripts','enqueue_related_pages_scripts_and_styles');





// add optin form above blog post

add_action('loop_start', 'add_optin_form' );

function add_optin_form(){
  echo '<div class="optinbox">

 <form method="post" >
	<input type="text" name="name" placeholder="Full Name" />
	<input type="email" name="email" placeholder="john@fb.com" />
	<input type="submit"  name="submitbtn" value="Join">
</form>

</div>';
}





// database connection 

function insert_email()
{
if (isset($_POST['submitbtn'])) {

	global $wpdb;

	if ($_POST['email'] == '') {
		
		echo "<script> alert('email field is required')</script>";
		
	}else{

	$insert_opt = $wpdb->insert('subs', array(
		 'name' => $_POST['name'],
		 'email' => $_POST['email'] 
		 ) );

	}
}

if ($insert_opt) {
	echo "<script> alert('Thanks for joining!!')</script>";
}

}

insert_email();



// action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '"



// shortcode function





// user [optin_form] as a shortcode on your pages and posts