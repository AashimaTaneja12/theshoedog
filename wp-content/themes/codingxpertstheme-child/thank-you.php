<?php
/*
Template Name: thank-you
*/
if ( !is_user_logged_in() ) {
    
    wp_redirect(home_url());
    exit();
}
else{

		get_header();
	  

	   
		global $wpdb;
		$current_user = wp_get_current_user();
		$uid = $current_user->ID;

		?>




<!--  this content is not displaying in the browser -->
		<div class="row" style="display: none;">
			<div class="col-lg-4 col-md-4">
				<h2>Order received</h2>
				<p>Thank you.Your order has been received</p>
				<p>ORDER NUMBER : </p>

				<?php

				$query = $wpdb->get_results("SELECT * from wp_paypal_payment where user_id = '$uid' ORDER BY id DESC LIMIT 1");
				$post_id = $query[0]->post_id;
				?>

				<p><?php echo $post_id;?></p><hr/>
				<p>DATE : </p>
				<p><?php echo date('Y-m-d');?></p><hr/>
				<?php

				$get_total_price = $wpdb->get_results("SELECT * from wp_postmeta where (meta_key ='_mc_gross' && post_id = $post_id)");
				$total_price = $get_total_price[0]->meta_value;
				?>
				<p>Total : </p>
				<p>R<?php echo $total_price;?></p><hr/>
				<p>ORDER METHOD</p>
				<p>Paypal transfer</p>
			</div>
		</div>
<!-- // this content is not displaying in the browser // -->



		<?php
		
			$query_post = $wpdb->get_results("SELECT * from wp_posts where ID = '$post_id'");
		
			$data = $query_post[0]->post_excerpt;

			$value = explode("-",$data);
			$product_id = $value[1];

			$get_product = $wpdb->get_results("SELECT * from wp_posts where ID= '$product_id'");
			$attachment_id = $wpdb->get_results("SELECT * from wp_posts where post_parent = '$product_id'");
			
			$image_id = $attachment_id[0]->ID;
			
			$query_post_meta = $wpdb->get_results("SELECT * from  wp_postmeta where (meta_key ='_wp_attached_file' && post_id = $image_id)");

			$get_original_price = $wpdb->get_results("SELECT * from wp_postmeta where (meta_key = 'buy_now' && post_id = '$product_id')");

			//echo $get_product[0]->post_title;
			$url = get_bloginfo('wpurl');
		?>
		 <!-- <a href="<?php //echo $get_product[0]->guid;?>"><img src = "<?php //echo $url;?>/wp-content/uploads/<?php //echo $query_post_meta[0]->meta_value;?>" width="100" height = "100"/> -->
		<div class="row">
			<div class="col-lg-4 col-md-4" style="height: 100%;">
					<h3 class="font-weight-bold mb-4">Order received</h3>
				<div class="p-4 border rounded fix_height">
					<p class="font-weight-bold">Thank you.Your order has been received</p>
					<p class="font-weight-bold">ORDER NUMBER : </p>

					<?php

					$query = $wpdb->get_results("SELECT * from wp_paypal_payment where user_id = '$uid' ORDER BY id DESC LIMIT 1");
					$post_id = $query[0]->post_id;
					?>

					<p><?php echo $post_id;?></p><hr class="border_hr">
					<p class="font-weight-bold">DATE : </p>
					<p><?php echo date('Y-m-d');?></p><hr class="border_hr">
					<?php

					$get_total_price = $wpdb->get_results("SELECT * from wp_postmeta where (meta_key ='_mc_gross' && post_id = $post_id)");
					$total_price = $get_total_price[0]->meta_value;
					?>
					<p class="font-weight-bold"> TOTAL : </p>
					<p>R<?php echo $total_price;?></p><hr class="border_hr">
					<p class="font-weight-bold">ORDER METHOD</p>
					<p>Paypal transfer</p>
				</div>
			</div>
		<!--  -->
		<div class="col-lg-8 col-md-8">
			<div class="">
			<h3 class="font-weight-bold mb-4">Order details</h3>
			<table class="thank-you-table">
			  <tr>
			    <th>PRODUCT</th>
			    <th>TOTAL</th>
			  </tr>
			  <tr>
			    <td><?php echo $get_product[0]->post_title;?></td>
			    <td>R<?php echo $get_original_price[0]->meta_value;?></td>
			  </tr>
			  <tr>
			    <td>Quantity</td>
			    <td>1</td>
			  </tr>
			   <tr>
				    <td>Payment method : </td>
				    <td>Paypal transfer</td>
			  	</tr>
			  </tr>
			  <tr>
			    <td>Image : </td>
			    <td><a href="<?php echo $get_product[0]->guid;?>"><img src = "<?php echo $url;?>/wp-content/uploads/<?php echo $query_post_meta[0]->meta_value;?>" width="100" height = "100"/> </a></td>
			  </tr>
			   <tr>
			    <td>Total : </td>
			    <td>R<?php echo $total_price;?></td>
			  </tr>
			</table>
			</div>
		</div>
	</div>

		<?php
		get_footer();

}
?>

<style>
	table {
	  border-collapse: collapse;
	  border-spacing: 0;
	  width: 100%;
	  border: 1px solid #ddd;
	}

	th, td {
	  text-align: left;
	  padding: 16px;
	}

	tr:nth-child(even) {
	  background-color: #f2f2f2
	}
</style>