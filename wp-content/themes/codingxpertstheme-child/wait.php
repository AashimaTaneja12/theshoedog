<?php
/*
Template Name: wait
*/

if ( !is_user_logged_in() ) {
    
    wp_redirect(home_url());
    exit();
}

		$referer_url = $_SERVER['HTTP_REFERER'];


	    if (strpos($referer_url,'paypal') !== false)
	    {
	    	global $wpdb;
			$site_url = get_bloginfo('wpurl');
	    	$url = home_url()."/thank-you";
	    	
	    	?>
	    		<div id="loading" style="text-align:center;">
					<p><img src="<?php echo $site_url;?>/wp-content/themes/codingxpertstheme-child/images/loader8.gif" />Please do not refresh the page and wait while we are processing your payment.</p>
				</div>
				<script>
					var url = "<?php echo $url;?>";
					setTimeout(function(){ window.location.href=url; }, 50000);
					
			    </script>

			<?php
	    	
	    }

	    else
	    {
	    	wp_redirect(home_url());
    		exit();

	    }