
</div>
<head>
	<style type="text/css">
	.padd10, .padd10 a{
		padding: 7px 0!important;
		color: #fff!important;
		text-align: center;
	}
	.padd10{
		background-color: #4c1d0c;
		width: 150px;
		margin: 0 auto;
		position: relative;
		top: -33px;
		opacity: .8;
	}
	@media screen and (max-width: 1200px){
	.padd10{
		background-color: #4c1d0c;
		width: 150px;
		margin: 0 auto;
		position: relative;
		top: -54.5px;
		opacity: .8;
		margin: auto;
	}
	}

	</style>
</head>
<?php /* Template Name: homepage */


get_header();


$user_id = get_current_user_id();


dynamic_sidebar( 'custom-side-bar' );
$url = get_bloginfo('wpurl'); 
?>

<h4 class="Highest_setmargin" style="text-transform: uppercase;"> Most Popular <span class="more"><a href="<?php echo $url;?>/sold-products/"> SEE ALL </a></span></h4> <hr>

<div class="popular_flex" style="display: flex; justify-content: space-between;">


<?php
  global $wpdb;
  $res = $wpdb->get_results("SELECT p.*,pay.* FROM wp_posts p join wp_paypal_payment pay on p.ID=pay.post_id  ORDER BY pay.id DESC LIMIT 4");

/*====================================TO get one unique value (if id repeat)====================*/

 $arr1 = array();

  foreach($res as $re)
  {

	$excerpt = $re->post_excerpt;

	$var1 = explode('-' , $excerpt);

	$arr1[] = $var1[1];


  }

  	$arrfinal = array();

  	foreach($arr1 as $a)
  	{
  		 $arrfinal[] =array(
            
                    "id" => $a,
                    "count" =>count(array_keys($arr1, $a))
                );
 	}



$input = array_map("unserialize", array_unique(array_map("serialize", $arrfinal)));

  		 /* echo "<pre>";
  		  print_r($input);
  		  echo "</pre>";*/

 // die();


  foreach($input as $value)
  {

  		
  		$pid = $value['id'];

  	$getproduct = $wpdb->get_results("SELECT * from wp_posts where ID = $pid");

  	/*echo "<pre>";
  	print_r($getproduct);
  	echo "</pre>";
  	die();*/

  	$product_title = $getproduct[0]->post_title;

  	 $id = $getproduct[0]->ID;


  	/*if(array_filter($getproduct,$id)){*/



  	 
    $query = $wpdb->get_results("SELECT * from  wp_posts where post_parent = $pid");
    $attachment_id = $query[0]->ID;
        
    $img =  $wpdb->get_results("SELECT * from  wp_postmeta where (meta_key ='_wp_attached_file' && post_id = $attachment_id)");
   
         
?>


	<div class="popular_white_border">
		<a href="<?php echo $getproduct[0]->guid;?>"><img src ="<?php echo $url;?>/wp-content/uploads/<?php echo $img[0]->meta_value;?>" width="230" height ="180"/></a>
		<h5><?php echo $product_title;?></h5>

		 <?php
		 $price_query = $wpdb->get_results("SELECT * from  wp_postmeta where(meta_key ='buy_now' && post_id = $pid)");
        
         $price_value = $price_query[0]->meta_value;
         $delfloat = explode('.',$price_value);
         ?>
		<p>R<?php echo $delfloat[0];?></p>
		
		<p class="bold-p"><?php echo $value['count'];?>Sold</p>
	</div>
	<?php
//}
}
?>

</div>




<!--=====================================New Row=============================-->
<!-- <div class="Highest_setmargin">
	<h4> NEW LOWEST ASKS <span class="more"> SEE ALL </span></h4> <hr>
</div>
<div class="popular_flex" style="display: flex; justify-content: space-between;">

	<div class="popular_white_border">
		<img src ="<?php echo $url;?>/wp-content/themes/codingxpertstheme-child/images/highestbid1.jpeg" width="230" height ="180"/>
		<h5>Air Fear of God Raid Light Bone</h5>
		<p>Highest Bid</p>
		<p class="bold-p">ZAR$255</p>
	</div> -->
	<!--================2nd product====================================-->
	<!-- <div class="popular_white_border">
		<img src ="<?php echo $url;?>/wp-content/themes/codingxpertstheme-child/images/highestbid2.jpeg" width="230" height ="180"/>
		<h5>Air Fear of God Raid Light Bone</h5>
		<p>Highest Bid</p>
		<p class="bold-p">ZAR$255</p>
	</div> -->
	<!--================3nd product====================================-->
	<!-- <div class="popular_white_border">
		<img src ="<?php echo $url;?>/wp-content/themes/codingxpertstheme-child/images/highestbid3.jpeg" width="230" height ="180"/>
		<h5>Air Fear of God Raid Light Bone</h5>
		<p>Highest Bid</p>
		<p class="bold-p">ZAR$255</p>
	</div> -->
	<!--================4nd product====================================-->
	<!-- <div class="popular_white_border">
		<img src ="<?php echo $url;?>/wp-content/themes/codingxpertstheme-child/images/highestbid4.jpg" width="230" height ="180"/>
		<h5>Air Fear of God Raid Light Bone</h5>
		<p>Highest Bid</p>
		<p class="bold-p">ZAR$255</p>
	</div>

</div> -->


<!--=====================================New Row12334345676767=============================-->
<div class="Highest_setmargin">
	<h4> NEW HIGHEST BIDS <span class="more"><a href="<?php echo $url;?>/highest-bids/"> SEE ALL </a></span> </h4> 
</div><hr>
<div class="popular_flex" style="display: flex; justify-content: space-between;">

<?php
   $query_high = $wpdb->get_results("SELECT * from wp_highest_bid ORDER BY  highest_bid DESC LIMIT 4 "); //select max 4 hihest bid
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
?>
	

</div>


<!-- large button start here -->
<!-- <div class="lg-button">
	<center>
		<button class="Thousands"> Browse Thousands of Sneakers on our Live Marketplace </button>
	</center>
</div> -->
<!-- large button end here -->


<!-- ============================ container end here ================ -- >
</div>
<?php
get_footer();
?>