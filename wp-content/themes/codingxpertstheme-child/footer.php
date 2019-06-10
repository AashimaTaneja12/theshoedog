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

?>

<?php
	global $wp;
	
	if(is_home()):
		$AuctionTheme_adv_code_home_below_content = stripslashes(get_option('AuctionTheme_adv_code_home_below_content'));
		if(!empty($AuctionTheme_adv_code_home_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_home_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	if ($wp->query_vars["post_type"] == "auction"):
		$AuctionTheme_adv_code_job_page_below_content = stripslashes(get_option('AuctionTheme_adv_code_job_page_below_content'));
		if(!empty($AuctionTheme_adv_code_job_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_job_page_below_content;
			echo '</div>';
		
		endif;	
	endif;
	
	//-------------------------------------
	
	if(is_single() or is_page()):
		$AuctionTheme_adv_code_single_page_below_content = stripslashes(get_option('AuctionTheme_adv_code_single_page_below_content'));
		if(!empty($AuctionTheme_adv_code_single_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_single_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-------------------------------------
	
	if(is_tax()):
		$AuctionTheme_adv_code_cat_page_below_content = stripslashes(get_option('AuctionTheme_adv_code_cat_page_below_content'));
		if(!empty($AuctionTheme_adv_code_cat_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_cat_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	?>

</div> 
</div> <!-- end some_wide_header -->
</div>
</div>

<div id="footer">
	<div id="colophon">	
	
	<?php
			get_sidebar( 'footer' );
	?>
	
	<hr style="background-color: white; height: .5px; width: 100%;">
	<div class="footer_flex" style="display: flex; justify-content: space-between;">
		<h3 class="icon">
			<a href="#"> <i class="fab fa-twitter fa-fw icon_size"></i> </a> &nbsp; &nbsp; 
			<a href="#"> <i class="fab fa-facebook-f fa-fw icon_size"></i> </a> &nbsp; &nbsp; 
			<a href="#"> <i class="fab fa-instagram fa-fw icon_size"></i> </a> &nbsp; &nbsp;
			<a href="#"> <i class="fab fa-youtube-square fa-fw icon_size"></i> </a> &nbsp; &nbsp;
		</h3>
		<div>
			<p class="Reserved" style="color: white; font-size: 16px; opacity: .6; position: relative; top: 14px; cursor: pointer;"> ©2019 Theshodog. All Rights Reserved. </p>
		</div>
	</div>	
</div>


</div>
	<style type="text/css">
		@media screen and (max-width: 768px){
			.footer_flex{
				flex-direction: column;
			}
			.icon a i{
				font-size: 16px!important;
			}
			.Reserved{
				font-size: 13px !important;
			}
		}
	</style>
<?php

	$AuctionTheme_enable_google_analytics = get_option('AuctionTheme_enable_google_analytics');
	if($AuctionTheme_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('AuctionTheme_analytics_code'));	
	endif;
	
	//----------------
	
	$AuctionTheme_enable_other_tracking = get_option('AuctionTheme_enable_other_tracking');
	if($AuctionTheme_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('AuctionTheme_other_tracking_code'));	
	endif;


?>
<?php wp_footer(); ?>

        
        <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ui-thing2.css" />
        <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ui-thing.css" />
		<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui-timepicker-addon.js"></script>
	     	
		<script>

        jQuery(document).ready(function() {
             jQuery('#ending').datetimepicker( );});

         </script>
         <script>
         	jQuery(document).ready(function($){
    	$("input[name=number_box_1559908385]").attr("maxlength", "10");
   		$("input[name=number_box_1559908385]").attr("pattern","/^-?\d+\.?\d*$/");
   		$("input[name=number_box_1559908385]").attr("onKeyPress","if(this.value.length==10)return false;");
});
         </script>
         <script>
         	var url = window.location.href;
         	var baseUrl = '<?= get_bloginfo("wpurl"); ?>/sign-up/';
         	if(url == baseUrl){
         		//$("#content").removeAttr('id').appendTo("#main-col-inner");

         		$('#content').addClass("myClass");   
				$("#content").removeAttr('id');
         	}
         	
         </script>

          <script>
         	var url = window.location.href;
         	var baseUrl = '<?= get_bloginfo("wpurl"); ?>/sign-up/';
         	if(url == baseUrl){
         		//$("#content").removeAttr('id').appendTo("#main-col-inner");

         		$('.box_title').addClass("title");   
				
         	}
         	
         </script>
<style type="text/css">
	#footer-widget-area{
		color: #fff !important;
	}
</style>
</body>
</html>