<?php
/***************************************************************************
*
*	AuctionTheme - copyright (c) - sitemile.com
*	The most popular auction theme for wordress on the internet. Launch your
*	auction site in minutes from purchasing. Turn-key solution.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/auctionTheme
*	since v4.4.7.1
*
***************************************************************************/

if(!function_exists('AuctionTheme_my_account_area_function'))
{
function AuctionTheme_my_account_area_function()
{

	/* ======================My custom code to display profile ==========================*/
	global $wpdb;
	$current_user = wp_get_current_user();
	$uid = $current_user->ID;

	$base_url = get_bloginfo( 'url' );
		
	if(isset($_POST["btnsubmit"]))
			{
				
			   $fname = $_POST['firstname'];
			   if($fname == ''){
			       
			   }
			   else{
			        $fname = $fname;
			   }
			    $lname = $_POST['lastname'];
			    if($lname == ''){
			        
			    }
			    else{
			        $lname = $lname;
			    }
			    $displayname = $_POST['displayname'];
			    
			    $country = $_POST['country'];
			    
			    $info = $_POST['contact'];
			    if($info == ''){
			        
			    }
			    else{
			        $info = $info;
			        
			    }
			    
			    $user_id = $uid;
			        
			    $metas = array( 
			            'first_name'   => $fname ,
			            'last_name' => $lname, 
			            'nickname'  => $displayname ,
			            'user_registration_input_box_1552651420' => $info 
			            
			        );
			        
			        foreach($metas as $key => $value) {
			            update_usermeta( $user_id, $key, $value );
			        }
			        
			        $table_name =$wpdb->prefix . "users";
			        $wpdb->update( 
			                        $table_name, 
			                        array( 
			                                'user_email' => $info, 
			                                 'user_login'=>$displayname,
			                                 'display_name' =>$displayname,
			                            ), 
			                        array( 'ID' => $uid )
			                    );
			        
			        
			           
			    
			    
			}


				$current_user = wp_get_current_user();
				$uid = $current_user->ID;
				
				
				/*========================================Custom code to display user data====================*/
				$query = $wpdb->get_results("SELECT * from wp_users where ID = '$uid'");
				$query_fname = $wpdb->get_results("SELECT * from wp_usermeta where user_id = '$uid' && meta_key = 'first_name'");
				
				$query_lname = $wpdb->get_results("SELECT * from wp_usermeta where user_id = '$uid' && meta_key = 'last_name'");
		

?>		<div class="float_div col-lg-4 col-md-4 rounded bg-warning_height">
			<p class="p_bg">Profile
				<a href="<?php echo $base_url;?>/profile-setting" class="profile-setting d-block float-right edit"> Edit </a>
			</p>
			<p class="mt-4">Name
				<a class="profile-setting d-block float-right"> <?php echo $query_fname[0]->meta_value;?> <?php echo $query_lname[0]->meta_value;?></a>
			</p>
			
			<p class="mt-4">Email 
				<a class="profile-setting d-block float-right email_float"><?php echo $query[0]->user_email;?></a>
			</p class="mt-4">
			
			<p>Username 
				<a class="profile-setting d-block float-right email_float"><?php echo $query[0]->display_name;?></a>
			</p>
			
		</div>


		<div id="content" class="account-content-area account-content-areammm col-lg-8 col-md-8">
        	<?php

				if(AuctionTheme_is_able_to_post_auctions()):

			?>
        		<!-- <div class="my_box3 ">
            	<div class="box_title"><?php _e("My Latest Active Auctions",'AuctionTheme'); ?></div>
                <div class="box_content">


                    <?php

					/*query_posts( "meta_key=closed&meta_value=0&post_type=auction&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );

					if(have_posts()) :
					while ( have_posts() ) : the_post();
						auctionTheme_get_post();
					endwhile; else:

					echo '<div class="padd10">';
					_e("There are no auctions yet.",'AuctionTheme');
					echo '</div>';

					endif;

					wp_reset_query();*/

					?>

                <!--</div>
                </div> -->

                <div class="my_box3 ">
            	<div class="box_title ml-4 margin_box_title"><?php _e("My Bids",'AuctionTheme'); ?></div></div>


                <div class="clear10"></div>


			<!-- <div class="my_box3">
            	<div class="box_title"><?php _e("My Unpaid/Pending Auctions",'AuctionTheme'); ?></div>
                <div class="box_content">


				<?php

				/*query_posts( "post_status=draft&post_type=auction&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					auctionTheme_get_post();
				endwhile; else:

				echo '<div class="padd10">';
				_e("There are no auctions yet.",'AuctionTheme');
				echo '</div>';

				endif;

				wp_reset_query();*/

				?>


			<!--</div>
			</div> -->


           <div class="clear10"></div>


			<!-- <div class="my_box3">
            	<div class="box_title"><?php _e("My Latest Closed Auctions",'AuctionTheme'); ?></div>
                <div class="box_content">


				<?php

				/*query_posts( "meta_key=closed&meta_value=1&post_type=auction&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					auctionTheme_get_post();
				endwhile; else:

				echo '<div class="padd10">';
				_e("There are no auctions yet.",'AuctionTheme');
				echo '</div>';

				endif;
				wp_reset_query();*/

				?>

			<!--</div>
			</div> -->

                <div class="clear10"></div>
                <?php endif; ?>

                <div class="my_box3">
            	
                <div class="box_content">


                    <?php

					query_posts( "meta_key=bid&meta_value=".$uid."&post_type=auction&order=DESC&orderby=id&posts_per_page=3" );

					if(have_posts()) :
					while ( have_posts() ) : the_post();
						auctionTheme_get_post();
					endwhile; else:

					echo '<div class="padd10 AuctionTheme">';
					_e("There are no bids yet.",'AuctionTheme');
					echo '</div>';

					endif;




					wp_reset_query();

					?>

                </div>
                </div>


             <!-- ##################### -->

        </div>


<?php	//auctionTheme_get_users_links();
}
}

?>
