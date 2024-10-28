<?php

// check um_fetch_user
if ( function_exists('um_fetch_user') ) {
	function pass_user_data_to_js() {
		// Check if the user is logged in
		if ( is_user_logged_in() ) {
				// Get the current logged-in user
				$current_user = wp_get_current_user();
	
				// Prepare user data (you can add more attributes here)
				$user_data = array(
						'username' => $current_user->user_login,
						'email'    => $current_user->user_email,
						'registeredAt' => $current_user->user_registered,
				);
	
				// Get Ultimate Membership attributes (Ultimate Member plugin data)
				if (function_exists('um_fetch_user')) {
						um_fetch_user($current_user->ID); // Load the Ultimate Member user data
						$user_data["user_login"] = um_user("user_login");
						$user_data["first_name"] = um_user("first_name");
						$user_data["last_name"] = um_user("last_name");
						$user_data["wechat_name"] = um_user("wechat_name");
						$user_data["user_email"] = um_user("user_email");
						$user_data["phone_number"] = um_user("phone_number");
	
						$user_data["company_name"] = um_user("company_name");
						$user_data["company_eng_name"] = um_user("company_eng_name");
						$user_data["position"] = um_user("position");
						$user_data["company_address"] = um_user("company_address");
						$user_data["company_gov_id"] = um_user("company_gov_id");
						$user_data["company_gov_cer"] = um_user("company_gov_file");
						$user_data["where_knows"] = um_user("where_knows");
				}
	
					
				// Output the inline JavaScript with the user data as a global JS object
				echo "<script type='text/javascript'>
						var wpUserData = " . json_encode($user_data) . ";
				</script>";
		}
	}
	
	// Hook to wp_head to ensure it outputs in the header section
	add_action('wp_head', 'pass_user_data_to_js');

	
}
