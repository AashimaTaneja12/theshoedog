<?php 

/* Template Name: allhighestbid */


get_header();

$url = get_bloginfo('wpurl'); 


   $query_high = $wpdb->get_results("SELECT * from wp_highest_bid ORDER BY  highest_bid "); //select max 4 hihest bid
   foreach($query_high as $high)
  {
  		$highest = $high->highest_bid;
  		$lowest = $high->lowest_bid;

  		if($highest!= 0 && $lowest!= 0 )
  		{
         $pid = $high->pid;
         
         $get_postvalue = $wpdb->get_results("SELECT * from wp_posts where ID = '$pid'"); //select title etc from post table
         
        
         //die();
       $query_post1 = $wpdb->get_results("SELECT * from wp_posts where post_parent ='$pid'"); //select id for attachment from parent id fron post tbale
       $attachid = $query_post1[0]->ID;
       
       $img_high =  $wpdb->get_results("SELECT * from  wp_postmeta where (meta_key ='_wp_attached_file' && post_id = '$attachid')");  //select attachment path from post meta table
       
       ?>

	<div class="popular_white_border">
		<a href="<?php echo $get_postvalue[0]->guid;?>"><img src ="<?php echo $url;?>/wp-content/uploads/<?php echo $img_high[0]->meta_value;?>" width="230" height ="180"/></a>
		<h5><?php echo $get_postvalue[0]->post_title;?></h5>
		<p>Highest Bid</p>
		<?php
		$price_query = $wpdb->get_results("SELECT * from  wp_postmeta where(meta_key ='buy_now' && post_id = $pid)");  //select price from postmeta table
        
         $price_value = $price_query[0]->meta_value;
         $delfloat = explode('.',$price_value); 
		?>
		<p class="bold-p">R<?php echo $highest;?></p>
	</div>
	<?php
}
}


get_footer();
?>