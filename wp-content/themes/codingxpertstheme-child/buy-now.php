<?php
/*
Template Name: bye-now
*/
if ( !is_user_logged_in() ) {
    
    wp_redirect(home_url());
    exit();
}
else{

		get_header();

		global $wpdb;
		$url = get_bloginfo('wpurl');   //get base url
		$pid = $_GET['pid'];

		$query = $wpdb->get_results("SELECT * from wp_posts where ID = $pid");//get title

		$product_name = $query[0]->post_title;


		$query_price = $wpdb->get_results("SELECT * from wp_postmeta where post_id = $pid && meta_key = 'buy_now'"); //get price

		$product_price = $query_price[0]->meta_value;

		$per_price = (2 / 100) * $product_price; //2% of bye now price

		$query_attachment = $wpdb->get_results("SELECT * from wp_posts where post_parent = $pid"); // get the attachment(post_parent) id

		$attachment_id =  $query_attachment[0]->ID;

		$query_image = $wpdb->get_results("SELECT * from wp_postmeta where post_id = $attachment_id && meta_key = '_wp_attached_file'"); // get attachment id in postmeta table
		 $image = $query_image[0]->meta_value;
		 ?>

		 <!-- ================Display Description===================== -->
		 <div class="mx-auto_product_detail shadow-lg pt-2 border rounded">

			<h2 class="bg-infom rounded m-0 p-3 text-whte">Product Details</h2>
			<div class="pl-4 pr-4 pb-4">
			<p class="Confirm_product">Confirm your product details below</p>
			<img class="buy_now_img" src="<?php echo $url;?>/wp-content/uploads/<?php echo $image;?>" />
				<!--  -->
				<div class="px-5">
					<h3 class="font-weight-bold"><?php echo "R".$product_price;?> </h3>
					<table class="border_table" width="100%">
						<!--  -->
						<tr>
							<td width="40%"> <p>Processing Fee : </p> </td>
							<td class="text-right"> <p> <?php echo "R".$per_price;?></p> </td>
						</tr>
						<!--  -->
						<tr>
							<td width="40%"> <p> Shipping :</p> </td>
							<td class="text-right"> <p> R100  </p> </td>
						</tr>
						<!--  -->
						<tr>
							<td width="40%"> <p> Authentication Fee : </p> </td>
							<td class="text-right"> <p>Free</p> </td>
						</tr>
						<!--  -->
						<tr>
							<td width="40%"> <p class="font-weight-bold"> Total(ZAR) : </p> </td>
							<td class="text-right"> <p class="font-weight-bold"> <?php echo "R".($product_price+$per_price+100);?></p> </td>
						</tr>
						<!--  -->
					</table>
					<span class="d-block mx-auto">
						 <?php
						 $total_price = $product_price+$per_price+100;
							//SHortcode of wp-paypal plugin
							//echo do_shortcode('[wp_paypal button="buynow" name="'.$product_name.'"  amount="'.$product_price.'" return="'.$url.'/thank-you?pid='.$pid.'"]');
							echo do_shortcode('[wp_paypal button="buynow" name="'.$product_name.'"  amount= "'.$total_price.'"]');
						 ?>
					</span>
				</div>
		 	</div>
		 </div>
		 <!-- =================End to display description of buy now product============ -->

		 <?php
		

		get_footer();
	}
?> 