<?php 

/* Template Name: allcategories */


get_header();

global $wpdb;
$get_categories = $wpdb->get_results("SELECT * from wp_terms");

echo "<pre>";

print_r($get_categories);

echo "</pre>";



echo "sdfc";

get_footer();

?>