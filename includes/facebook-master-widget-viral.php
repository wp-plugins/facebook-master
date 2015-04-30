<?php
//Hook Widget
add_action( 'widgets_init', 'facebook_master_widget_viral' );

//Register Widget
function facebook_master_widget_viral() {
register_widget( 'facebook_master_widget_viral' );
}

class facebook_master_widget_viral extends WP_Widget {
	function facebook_master_widget_viral() {
	$widget_ops = array( 'classname' => 'Facebook Master Viral', 'description' => __('The Viral Facebook Like and Share buttons will make your wordpress grow with new visits and users. ', 'facebook_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'facebook_master_widget_viral' );
	$this->WP_Widget( 'facebook_master_widget_viral', __('Facebook Master Viral', 'facebook _master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Variables from the widget settings.
		$facebook_master_title = isset( $instance['facebook_master_title'] ) ? $instance['facebook_master_title'] :false;
		$facebook_master_title_new = isset( $instance['facebook_master_title_new'] ) ? $instance['facebook_master_title_new'] :false;
		$facebookmasterspacer ="'";
		$facebookmaster_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		echo $before_widget;
		
	// Display the widget title
	if ( $facebook_master_title ){
		if (empty ($facebook_master_title_new)){
			if(is_multisite()){
			$facebook_master_title_new = get_site_option('facebook_master_name');
			}
			else{
			$facebook_master_title_new = get_option('facebook_master_name');
			}
		echo $before_title . $facebook_master_title_new . $after_title;
		}
		else{
		echo $before_title . $facebook_master_title_new . $after_title;
		}
	}
	else{
	}
	//Display Viral Buttons
		echo '<div id="fb-root"></div>' .
			'<script>(function(d, s, id) {' .
			'var js, fjs = d.getElementsByTagName(s)[0];' .
			'if (d.getElementById(id)) return;' .
			'js = d.createElement(s); js.id = id;' .
			'js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=";' .
			'fjs.parentNode.insertBefore(js, fjs);' .
			'}(document, '.$facebookmasterspacer.'script'.$facebookmasterspacer.', '.$facebookmasterspacer.'facebook-jssdk'.$facebookmasterspacer.'));</script>' .
			'<style>.fb-like span{overflow:visible !important; width:450px !important; margin-right:-375px;}</style>' .
			'<div class="fb-like" data-href="'.$facebookmaster_url.'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>' .
	$after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['facebook_master_title'] = strip_tags( $new_instance['facebook_master_title'] );
		$instance['facebook_master_title_new'] = $new_instance['facebook_master_title_new'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'facebook_master_title_new' => __('Facebook Master', 'facebook_master'), 'facebook_master_title' => true, 'facebook_master_title_new' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['facebook_master_title'], true ); ?> id="<?php echo $this->get_field_id( 'facebook_master_title' ); ?>" name="<?php echo $this->get_field_name( 'facebook_master_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'facebook_master_title' ); ?>"><b><?php _e('Display Widget Title', 'facebook_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebook_master_title_new' ); ?>"><?php _e('Change Title:', 'facebook_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'facebook_master_title_new' ); ?>" name="<?php echo $this->get_field_name( 'facebook_master_title_new' ); ?>" value="<?php echo $instance['facebook_master_title_new']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Facebook Master Website</b>
	</p>
	<p><a class="button-secondary" href="http://wordpress.techgasp.com/facebook-master/" target="_blank" title="Facebook Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/facebook-master-documentation/" target="_blank" title="Facebook Master Documentation">Documentation</a> <a class="button-secondary" href="http://wordpress.techgasp.com/facebook-master/" target="_blank" title="Get Add-ons">Get Add-ons</a></p>
	<?php
	}
 }
?>