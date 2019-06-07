<?php 
/* Template Name: profile_setting */

get_header();
global $wpdb;
$url = get_bloginfo('wpurl');
$current_user = wp_get_current_user();
$uid = $current_user->ID;
$query = $wpdb->get_results("SELECT * from wp_users where ID = '$uid' ");

$query_fname = $wpdb->get_results("SELECT * from wp_usermeta where user_id = '$uid' && meta_key = 'first_name'");
$query_lname = $wpdb->get_results("SELECT * from wp_usermeta where user_id = '$uid' && meta_key = 'last_name'");
$query_country = $wpdb->get_results("SELECT * from wp_usermeta where user_id = '$uid' && meta_key = 'user_registration_select_1552538204'");
global $wp;
$current_pageurl =  home_url( $wp->request );



?>
<html>
  <head>
      <style>
        * {
          box-sizing: border-box;
        }

        input[type=text], select, textarea {
          width: 100%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          resize: vertical;
        }

        label {
          padding: 12px 12px 12px 0;
          display: inline-block;
        }

        input[type=submit] {
          color: white;
          padding: 12px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          float: right;
        }

        .container {
          border-radius: 5px;
          background-color: #f2f2f2;
          padding: 20px;
          width: 70%!important;
          margin-top: 40px!important;
        }

        .col-25 {
          float: left;
          width: 25%;
          margin-top: 6px;
        }

        .col-75 {
          float: left;
          width: 75%;
          margin-top: 6px;
        }

        .row:after {
          content: "";
          display: table;
          clear: both;
        }
        #footer{
          /*margin-top: 0 !important;*/
        }
        @media screen and (max-width: 600px) {
          .col-25, .col-75, input[type=submit] {
            margin-top: 13px;
          }
          .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            width: 90%!important;
            margin-top: 40px!important;
          }
        }
      </style>
  </head>
<body>

<h2 class="font-weight-bold Account_settings">Account Settings</h2>
<p class="settings_text">Change your account settings</p>

<div class="p-4">
  <form method="POST" action="<?php echo $url;?>/my-account-2">
  <div class="row">
    <div class="col-25">
      <label for="fname">First Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="firstname" value = "<?php echo $query_fname[0]->meta_value;?>">
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="fname"></label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="lastname" value = "<?php echo $query_lname[0]->meta_value?>">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="country">Userinfo</label>
    </div>
    <div class="col-75">
      <input type="text" id="dname" name="displayname" value = "<?php echo $query[0]->display_name;?>" readonly >
    </div>
  </div>
   <div class="row">
    <div class="col-25">
      <label for="country">Selected Country</label>
    </div>
    <div class="col-75">
      <input type="text" id="scountry" name="country" value = "<?php echo $query_country[0]->meta_value;?>" readonly>
    </div>
  </div>
   <div class="row">
    <div class="col-25">
      <label for="country">Contact Info</label>
    </div>
    <div class="col-75">
      <input type="text" id="info" name="contact" value = "<?php echo $query[0]->user_email;?>">
    </div>
  </div>
   
  <div class="row">
    <div class="col-25 Contact_Info">
      <label for="country">Contact Info</label>
    </div>
    <div class="col-50 col-50-input">
      <input type="submit" value="Submit" class="mr-d-block" name="btnsubmit">

      <a href="<?php echo $url;?>/my-account-2"><input type="button" class="Cancel" value="Cancel"></a>
      
    </div>
  </div>
  
    <!-- <div class="col-50">
   
    </div> -->
  </div>
  
  </form>
</div>

</body>
</html>
<?php
get_footer();
?>