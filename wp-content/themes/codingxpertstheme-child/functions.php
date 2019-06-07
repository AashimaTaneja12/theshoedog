<?php
/***************************************************************************
*
* AuctionTheme - copyright (c) - sitemile.com
* The most popular auction theme for wordress on the internet. Launch your
* auction site in minutes from purchasing. Turn-key solution.
*
* Coder: Andrei Dragos Saioc
* Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
* More info about the theme here: http://sitemile.com/p/auctionTheme
* since v4.4.7.1
*
***************************************************************************/

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}





/*================================ Custom widgets(sidebar)======================*/

function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Catogory Widget', 'your-theme-domain' ),
            'id' => 'custom-side-bar',
            'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'my_custom_sidebar' );


function popular_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Popular Widget', 'your-theme-domain' ),
            'id' => 'popular-side-bar',
            'description' => __( 'Popular Sidebar', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'popular_sidebar' );

function lowestask_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Lowestask Widget', 'your-theme-domain' ),
            'id' => 'lowestask-side-bar',
            'description' => __( 'Lowestask Sidebar', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'lowestask_sidebar' );

/*=====================================

=============================Chnage browser tab name=========================*/

remove_all_filters( 'wp_title' );
add_filter('wp_title', 'filter_pagetitle', 99,1);
function filter_pagetitle($title) {
    $title = get_bloginfo('name');
    return $title;
}

/*======================Remove the watchlist from GRID view ==============================*/


if(!function_exists('auctionTheme_get_post_function_grid'))
{
function auctionTheme_get_post_function_grid( $arr = '')
{

            if($arr[0] == "winner") $pay_this_me = 1;
            if($arr[0] == "unpaid") $unpaid = 1;

            $paid = get_post_meta(get_the_ID(),'paid',true);

            $ending         = get_post_meta(get_the_ID(), 'ending', true);
            $sec            = $ending - current_time('timestamp',0);
            $location       = get_post_meta(get_the_ID(), 'Location', true);
            $closed         = get_post_meta(get_the_ID(), 'closed', true);
            $post           = get_post(get_the_ID());
            $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
            $buy_now        = get_post_meta(get_the_ID(), 'buy_now', true);
            $featured       = get_post_meta(get_the_ID(), 'featured', true);
            //$current_bid      = get_post_meta(get_the_ID(), 'current_bid', true);

            $post = get_post(get_the_ID());

            $current_user = wp_get_current_user();
            $uid = $current_user->ID;

            $pid = get_the_ID();

?>
                <div class="post_grid" id="post-ID-<?php the_ID(); ?>">
                <!-- <?php post_class(); ?> -->

                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>



                <div class="padd10_a">
                <div class="image_holder_grid">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),125,85); ?></a>

                <!-- <div class="watch-list">
                <?php





                if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):
                ?>

               <!-- <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- watchlist','AuctionTheme'); ?></a>

                <?php else: ?>

                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ watchlist','AuctionTheme'); ?></a>
                <?php endif; ?>


                          </div> -->
                </div>
                <div  class="title_holder_grid" >
                     <h2 class="title-hold"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php


                        the_title();


                        ?></a></h2>


                  <?php if(!AuctionTheme_is_different_home_layout()) {

                  $author = get_userdata($post->post_author);


                  ?>




                     </div>

                   <?php } ?>

                    <div class="details_holder_grid">


                  <ul class="auction-details1">
                            <li>

                                <p><?php// echo auctionTheme_get_show_price(auctionTheme_get_current_price(get_the_ID())); ?>
                                <p><?php echo "R".auctionTheme_get_current_price(get_the_ID()); ?>
                                <?php if($only_buy_now == '1') : ?>

                                [<?php _e("BuyNow",'AuctionTheme'); ?>]
                                <?php endif; ?>
                                </p>
                            </li>





                            <?php if($closed == "0"): ?>
                            <li>

                                <p class="expiration_auction_p"><?php echo ($closed=="1" ? __('Closed', 'AuctionTheme') : ($ending - current_time('timestamp',0))); ?></p>

                                <!--<p><?php echo ($closed=="1" ? __('Closed', 'AuctionTheme') : AuctionTheme_prepare_seconds_to_words($ending - current_time('timestamp',0))); ?></p> -->
                            </li>
                            <?php endif; ?>

                        </ul>


                  </div>

                     </div></div>
<?php
} }


/*=================================Remove the watchlist button,price from LIST view=========================*/


if(!function_exists('auctionTheme_get_post_function'))
{
function auctionTheme_get_post_function( $arr = '')
{

            if($arr[0] == "winner") $pay_this_me = 1;
            if($arr[0] == "unpaid") $unpaid = 1;

            global $bid_ids;

            $paid = get_post_meta(get_the_ID(),'paid',true);

            $ending         = get_post_meta(get_the_ID(), 'ending', true);
            $sec            = $ending - current_time('timestamp',0);
            $location       = get_post_meta(get_the_ID(), 'Location', true);
            $closed         = get_post_meta(get_the_ID(), 'closed', true);
            $post           = get_post(get_the_ID());
            $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
            $buy_now        = get_post_meta(get_the_ID(), 'buy_now', true);
            $featured       = get_post_meta(get_the_ID(), 'featured', true);
            //$current_bid      = get_post_meta(get_the_ID(), 'current_bid', true);

            $post = get_post(get_the_ID());

            $current_user = wp_get_current_user();
            $uid = $current_user->ID;

            $pid = get_the_ID();

            if(!empty($bid_ids))
            {
                global $wpdb;
                $ss = "select * from ".$wpdb->prefix."auction_bids where id='$bid_ids'";
                $rr = $wpdb->get_results($ss);
                $rows = $rr[0];
                $winner = get_userdata($rows->uid);

            }
?>
                <div class="post" id="post-ID-<?php the_ID(); ?>">

                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>


                <div class="col-xs-4 col-sm-2 col-lg-2 imag_imag" >
                <div class="parent_height_div">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),0,0 , 'attachment-75x65', 'normal-auction-thumb',1); ?> </a>
                </div>

                   <!--  <div class="watch-list">
                        <?php if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true): ?>
                            <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- watchlist','AuctionTheme'); ?></a>
                        <?php else: ?>
                            <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ watchlist','AuctionTheme'); ?></a>
                        <?php endif; ?>
                    </div> -->

                </div>

                <!-- ################ -->

                <div  class="col-xs-8 col-sm-4 col-lg-5" >
                     <h2 class="title-hold"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"> <?php the_title(); ?></a></h2>


                  <?php if(!AuctionTheme_is_different_home_layout()) {
                  $author = get_userdata($post->post_author);
                  ?>

        <p class="mypostedon"><?php echo sprintf(__("Posted on %s by %s",'AuctionTheme'), get_the_time('F jS, Y'), '<a href="'.AuctionTheme_get_user_profile_link($author->ID).'">'.get_the_author().'</a>' ); ?>

                  <br/>
                        <?php _e("Posted in","AuctionTheme");?> <?php echo get_the_term_list( get_the_ID(), 'auction_cat', '', ', ', '' ); ?>


                        <?php


                            if($post->post_status == "draft" && $paid == 1)
                            {

                                echo '<br/><span class="awaiting_moderation">'.__('Awaiting admin moderation','AuctionTheme').'</span>';

                            }
                        ?>

                        </p>

                       <?php

                       global $asd_paid_items;
                       if($asd_paid_items == 1):

                       ?>
                        <p class="shipping_info">
                    <?php

                    $shp = get_user_meta($winner->ID, 'shipping_info', true);
                    printf(__('Buyer Shipping Info: %s','AuctionTheme'), $shp); ?>
                    </p>

                       <?php endif; ?>
                    <!-- ############### -->
                    <div>


                     <?php if($pay_this_me == 1): ?>
                        <a href="<?php bloginfo('siteurl'); ?>/my-account/pay-for-auction/<?php echo get_the_ID(); ?>"
                        class="post_bid_btn"><?php echo __("Pay This", "AuctionTheme");?></a>
                        <?php endif; ?>

                   <?php if(!AuctionTheme_is_different_home_layout() ) { ?>

                  <?php if( $pay_this_me != 1): ?>
                  <a href="<?php the_permalink(); ?>" class="post_bid_btn"><?php echo __("Read More", "AuctionTheme");?></a>
                  <?php endif; ?>

                  <?php if( $paid != 1 and ($post->post_author == $uid)): ?>
                  <a href="<?php echo AuctionTheme_post_new_with_pid_stuff_thg(get_the_ID(), 3); ?>" class="post_bid_btn"><?php echo __("Publish", "AuctionTheme");?></a>
                  <?php endif; ?>




                  <?php if($post->post_author == $uid) {

                  if(auctionTheme_number_of_bid_see_and_buy_now(get_the_ID()) != false) { $mms = 1;
                  ?>
                  <a href="<?php bloginfo('siteurl') ?>/?a_action=edit_auction&pid=<?php the_ID(); ?>" class="post_bid_btn"><?php echo __("Edit Auction", "AuctionTheme");?></a>

                  <?php }

                  if($mms != 1){
                    if( get_option('AuctionTheme_enable_editing_when_bid_placed') == "yes"){
                  ?>
                   <a href="<?php bloginfo('siteurl') ?>/?a_action=edit_auction&pid=<?php the_ID(); ?>" class="post_bid_btn"><?php echo __("Edit Auction", "AuctionTheme");?></a>

                  <?php
                  }}

                    if($rows->paid == '0')
                    {
                        ?>
                                <a href="<?php bloginfo('siteurl') ?>/?a_action=mark_paid&bid_id=<?php echo $bid_ids; ?>" class="post_bid_btn"><?php echo __("Mark Paid", "AuctionTheme");?></a>
                        <?php
                    }

                  ?>

                  <?php }   ?>

                  <?php if($post->post_author == $uid) //$closed == 1)
                  { ?>

                   <?php if($closed == "1") //$closed == 1)
                  { ?>
                  <a href="<?php bloginfo('siteurl') ?>/?a_action=relist_auction&pid=<?php the_ID(); ?>" class="post_bid_btn"><?php echo __("Repost Auction", "AuctionTheme");?></a>

                  <?php } /*} else { */

                  if(auctionTheme_has_1_bid($pid) == false):

                  ?>

                   <a href="<?php bloginfo('siteurl') ?>/?a_action=delete_auction&pid=<?php the_ID(); ?>" class="post_bid_btn_err"><?php echo __("Delete", "AuctionTheme");?></a>

                  <?php endif; } ?>

                  <?php } ?>


                    <?php

                    do_action('AuctionTheme_post_content_after_buttons');

                    ?>
                    </div>
                    <!-- ############### -->

                     </div>

                   <?php } ?>

                    <div class="col-xs-12 col-sm-6 col-lg-5">


                  <ul class="auction-details1">
                           <!--  <li>
                                <div class="small_icn"><i class="far fa-money-bill-alt"></i></div>
                                <div class="small_ttl_h"><?php echo __("Price",'AuctionTheme'); ?>:</div>
                                <div class="small_ttl_p"><?php //echo auctionTheme_get_show_price(auctionTheme_get_current_price(get_the_ID())); ?>
                                <?php if($only_buy_now == '1') : ?>

                                [<?php _e("BuyNow",'AuctionTheme'); ?>]
                                <?php endif; ?>
                                </div>
                            </li> -->

                    <?php if($only_buy_now != '1') : ?>



                <?php if(!empty($buy_now)): ?>

                <li>
                    <div class="small_icn"><i class="far fa-money-bill-alt"></i></div>
                                <div class="small_ttl_h"><?php echo __("Buy Now",'AuctionTheme'); ?>:</div>
                                <!-- <div class="small_ttl_p"><?php echo auctionTheme_get_show_price($buy_now); ?></div> -->
                                <div class="small_ttl_p"><?php echo "R".$buy_now; ?></div>
                            </li>

                <?php endif; ?>


                               <li>
                <div class="small_icn"><i class="zaza fa fa-eye"></i></div>
                    <div class="small_ttl_h"><?php _e("Bids",'AuctionTheme');?>:</div>
                    <div class="small_ttl_p"><?php echo auctionTheme_number_of_bid(get_the_ID()); ?></div>
                </li>

                    <?php endif; ?>



                            <li>
                                <div class="small_icn"><i class="zaza fa fa-calendar"></i></div>
                                <div class="small_ttl_h"><?php echo __("Posted on",'AuctionTheme'); ?>:</div>
                                <div class="small_ttl_p"><?php the_time("j F Y g:i A"); ?></div>
                            </li>

                            <?php if($closed == "0"):

                            $AuctionTheme_no_time_on_buy_now = get_option('AuctionTheme_no_time_on_buy_now');
                            if($only_buy_now == "1" and $AuctionTheme_no_time_on_buy_now == "yes"):
                            //asd
                            else:

                            ?>
                            <li>
                                <div class="small_icn"><i class="far fa-clock"></i></div>
                                <div class="small_ttl_h"><?php echo __("Expires in",'AuctionTheme'); ?>:</div>

                                <div class="small_ttl_p"><span class="expiration_auction_p"><?php echo ($closed=="1" ? __('Closed', 'AuctionTheme') : ($ending - current_time('timestamp',0))); ?></span></div>

                                <!--<p><?php echo ($closed=="1" ? __('Closed', 'AuctionTheme') : AuctionTheme_prepare_seconds_to_words($ending - current_time('timestamp',0))); ?></p> -->
                            </li>
                            <?php endif; endif; ?>

                           <?php  if($asd_paid_items == 1):



                           ?>

                            <li>
                                <i class="zaza fa fa-user"></i>
                                <h3><?php echo __("Buyer",'AuctionTheme'); ?>:</h3>
                                <p> <a href="<?php echo AuctionTheme_get_user_profile_link($winner->ID); ?>"><?php echo $winner->user_login; ?></a></p>
                            </li>


                            <li>
                                <i class="zaza fa fa-calendar"></i>
                                <h3><?php echo __("Bought On",'AuctionTheme'); ?>:</h3>
                                <p> <?php echo date_i18n("j F Y g:i A", $rows->date_choosen); ?></p>
                            </li>


                            <li>
                                <i class="zaza fa fa-calendar"></i>
                                <h3><?php echo __("Quantity",'AuctionTheme'); ?>:</h3>
                                <p> <?php echo $rows->quant; ?></p>
                            </li>

                            <?php endif; ?>

                        </ul>


                  </div>

                     </div>
<?php
}
}

/*add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}*/



?>