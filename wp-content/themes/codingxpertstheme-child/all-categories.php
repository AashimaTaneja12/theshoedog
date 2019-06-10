<?php 

/* Template Name: allcategories */


get_header();



global $wpdb;

$url = get_bloginfo('wpurl');
$get_categories = $wpdb->get_results("SELECT * from wp_terms");

?>
<p class="Popular_brands_text"><?php echo "Popular Brands";?></p>
<hr class="border-top m-0 p-0">
<div class="loop">
<?php

foreach($get_categories as $cat)
{
	/*echo "<pre>";
	print_r($get_categories);
	echo "</pre>";
	die();*/
	
	$cat_id = $cat->term_id;
	$cat_name = $cat->name;

	$fetch_cat_postmeta = $wpdb->get_results("SELECT * from wp_postmeta where meta_key = 'category_image' && meta_value = '".$cat_id."'");

	
	foreach($fetch_cat_postmeta as $post)
	{
		$post_id = $post->post_id;

		$fetch_attachment = $wpdb->get_results("SELECT * from wp_postmeta where meta_key = '_wp_attached_file' && post_id = '".$post_id."'");

		foreach($fetch_attachment as $fetch_image){

			 $get_image = $fetch_image->meta_value;

			 $var1 = explode('.',$get_image);
			 /*echo "<pre>";
			 print_r($var1);
			 echo "</pre>";*/

			 $extension =  $var1[1];

			 $image_path = $var1[0]."-193x140";

		$get_slug = $wpdb->get_results("SELECT * from wp_terms where  term_id= '".$cat_id."'");

		
		$slug = $get_slug[0]->slug;

			
		?>
		<div class="float-left mr-5 mt-5">
			<a href="<?php echo $url;?>/section/<?php echo $slug;?>"><img src="http://localhost/wordpresstest/wp-content/uploads/<?php echo $image_path;?>.<?php echo $extension;?>" width="230" height ="180"/></a>
			
			<p class="nike_heading_text">
				<a href="<?php echo $url;?>/section/<?php echo $slug;?>"> <?php echo $cat_name;?> </a></p>
		</div>
		<?php

		}


		


	}
}

?>

</div>
<?php



get_footer();

?>