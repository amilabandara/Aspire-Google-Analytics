<?php
/*
Plugin Name: Aspire Google Analytics
Plugin URI:  http://amila.info/aspire-google-analytics/
Description: Adds a Google analytics trascking code to the site.
Author: Amila Bandara
Author URI: http://amila.info
Version: 1.0
 */

//debug mode is on
//define('WP_DEBUG', true);


add_action('admin_menu', function() {
    add_options_page( 'Google Analytics settings', 'Aspire Google Analytics', 'manage_options', 'aspire-google-analytics', 'aspire_google_analytics_page' );
});

add_action( 'admin_init', function() {
    register_setting( 'aspire-google-analytics-settings', 'aspire_analytics_code' );
});

function aspire_google_analytics_page(){
	?>
   <div class="wrap">
   	<h1>Aspire Google Analytics Plugin Settings</h1>
     <form action="options.php" method="post">
       <?php
       settings_fields( 'aspire-google-analytics-settings' );
       do_settings_sections( 'aspire-google-analytics-settings' );
       ?>
       <div class="row">
       		<div class="col-md-6">
       			<label for="gcode">Google Analytics Code</label>
       		</div>
       		<div class="col-md-6">
       			<input id="gcode"  type="text" value="<?php echo esc_attr( get_option('aspire_analytics_code') ); ?>" name="aspire_analytics_code">
       		</div>
       		<div class="col-md-6">
       			<?php submit_button(); ?>
       		</div>
       </div>
     </form>
   </div>
 <?php
}


function aspire_google_analytics() { 
    $anlytics_code =  esc_attr( get_option('aspire_analytics_code') );

    if($anlytics_code!=''){
	?>
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $anlytics_code;?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', '<?php echo $anlytics_code;?>');
</script>

<?php } }
add_action( 'wp_head', 'aspire_google_analytics', 10 );

?>