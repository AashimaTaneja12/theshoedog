<?php /* Template Name: buy-now-products */



get_header();

$url = get_bloginfo('wpurl'); 
?>
<!-- <p class="Popular_brands_text"><?php //echo "NEW HIGHEST BIDS";?></p> -->
<p class="Popular_brands_text"><?php echo "MOST POPULAR";?> </p>
<hr class="border-top m-0 p-0">
<div class="loop_second">
<?php
  global $wpdb;
  $res = $wpdb->get_results("SELECT p.*,pay.* FROM wp_posts p join wp_paypal_payment pay on p.ID=pay.post_id  ORDER BY pay.id DESC");

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


	<div class="rounded p-4">
		<a href="<?php echo $getproduct[0]->guid;?>"><img class="d-block mx-auto img-width_fluid" src ="<?php echo $url;?>/wp-content/uploads/<?php echo $img[0]->meta_value;?>" width="230" height ="180"/></a>
    <div class="pl-4">
  		<h5 class="product_title_dolor"><?php echo $product_title;?> </h5>  <?php
       $price_query = $wpdb->get_results("SELECT * from  wp_postmeta where(meta_key ='buy_now' && post_id = $pid)");
          
           $price_value = $price_query[0]->meta_value;
           $delfloat = explode('.',$price_value);
           ?> 
      <span class="delfloat">  R<?php echo $delfloat[0];?> </span>
  		<p class="sold_button bold-p"><?php echo $value['count'];?>Sold</p>
    </div>
	</div>





	<?php
//}
}
?>
</div>
<?php


get_footer();

?>

<style type="text/css">
  @media (min-width: 768px){
  .col-md-3 {
      -ms-flex: 0 0 25%;
      flex: 0 0 25%;
      max-width: 100%;
  }
</style>