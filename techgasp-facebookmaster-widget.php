<?php
//Load Shortcode Framework

//Hook Widget
add_action( 'widgets_init', 'techgasp_facebookmaster_widget' );
//Register Widget
function techgasp_facebookmaster_widget() {
register_widget( 'techgasp_facebookmaster_widget' );
}

class techgasp_facebookmaster_widget extends WP_Widget {
	function techgasp_facebookmaster_widget() {
	$widget_ops = array( 'classname' => 'Facebook Master', 'description' => __('Facebook Master lets you have full control over all good facebook social plugins in one go, only for professional wordpress websites. ', 'Facebook Master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'techgasp_facebookmaster_widget' );
	$this->WP_Widget( 'techgasp_facebookmaster_widget', __('Facebook Master', 'facebook master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Variables from the widget settings.
		$name = "Facebook Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$facebookmasterspacer ="'";
		$show_facebookmaster = isset( $instance['show_facebookmaster'] ) ? $instance['show_facebookmaster'] :false;
		$facebookmaster_page = $instance['facebookmaster_page'];
		$facebookmaster_appid = $instance['facebookmaster_appid'];
		echo $before_widget;
		
	// Display the widget title
		if ( $title )
		echo $before_title . $name . $after_title;

	//Display Faceboook Master
		if ( $show_facebookmaster )
		echo '<div class="fb-like-box" data-href="'.$facebookmaster_page.'" data-width="292" data-show-faces="false" data-colorscheme="light" data-stream="false" data-show-border="false" data-header="false"></div>' .
			'<div id="fb-root"></div>' .
			'<script>(function(d, s, id) {' .
			'var js, fjs = d.getElementsByTagName(s)[0];' .
			'if (d.getElementById(id)) return;' .
			'js = d.createElement(s); js.id = id;' .
			'js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId='.$facebookmaster_appid.'";' .
			'fjs.parentNode.insertBefore(js, fjs);' .
			'}(document, '.$facebookmasterspacer.'script'.$facebookmasterspacer.', '.$facebookmasterspacer.'facebook-jssdk'.$facebookmasterspacer.'));</script>';
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_facebookmaster'] = $new_instance['show_facebookmaster'];
		$instance['facebookmaster_page'] = $new_instance['facebookmaster_page'];
		$instance['facebookmaster_appid'] = $new_instance['facebookmaster_appid'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Facebook Master', 'facebook master'), 'title' => true, 'show_facebookmaster' => true, 'facebookmaster_page' => false, 'facebookmaster_appid' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
		<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'facebook master'); ?></b></label></br>
	</p>
	<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['show_facebookmaster'], true ); ?> id="<?php echo $this->get_field_id( 'show_facebookmaster' ); ?>" name="<?php echo $this->get_field_name( 'show_facebookmaster' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_facebookmaster' ); ?>"><b><?php _e('Display Social Plugin', 'facebook master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookmaster_page' ); ?>"><?php _e('Facebook Fan Page Link:', 'facebook master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookmaster_page' ); ?>" name="<?php echo $this->get_field_name( 'facebookmaster_page' ); ?>" value="<?php echo $instance['facebookmaster_page']; ?>" style="width:auto;" />
	</p>
	<p>Facebook Fan Page Link, ie <b>https://www.facebook.com/techgasp</b></p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookmaster_appid' ); ?>"><?php _e('optional, Facebook App ID:', 'facebook master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookmaster_appid' ); ?>" name="<?php echo $this->get_field_name( 'facebookmaster_appid' ); ?>" value="<?php echo $instance['facebookmaster_appid']; ?>" style="width:auto;" />
	</p>
	<p>if you have a Facebook Application associated with your Fan Page, insert APP ID number here</p>
	<p><b>Display Plugin Header:</b></p>
	<p><b>Display Facebook User Faces:</b></p>
	<p><b>Display Facebook Stream:</b></p>
	<p><b>Color Scheme:</b></p>
	<p><b>Display Plugin Border:</b></p>
	<p><b>Plugin Width:</b></p>
	<p><b>Plugin Height:</b></p>
	<hr>
	<p>Upgrade to Advanced Version!</p> 
	<hr>
	<p><b>Facebook Master Advanced Version</b></p>
	<p><a class="button-primary" href="http://wordpress.techgasp.com/facebook-master/" target="_blank" title="Facebook Master Advanced Version">Facebook Master Advanced Version</a></p>
	<?php
	}
 }
?>