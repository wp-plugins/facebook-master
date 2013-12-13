<?php
//Hook Widget
add_action( 'widgets_init', 'facebook_master_widget' );
//Register Widget
function facebook_master_widget() {
register_widget( 'facebook_master_widget' );
}

class facebook_master_widget extends WP_Widget {
	function facebook_master_widget() {
	$widget_ops = array( 'classname' => 'Facebook Master', 'description' => __('Facebook Master lets you have full control over all good facebook social plugins in one go, only for professional wordpress websites. ', 'facebook_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'facebook_master_widget' );
	$this->WP_Widget( 'facebook_master_widget', __('Facebook Master', 'facebook _master'), $widget_ops, $control_ops );
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
	$defaults = array( 'name' => __('Facebook Master', 'facebook_master'), 'title' => true, 'show_facebookmaster' => true, 'facebookmaster_page' => false, 'facebookmaster_appid' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'facebook master'); ?></b></label></br>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_facebookmaster'], true ); ?> id="<?php echo $this->get_field_id( 'show_facebookmaster' ); ?>" name="<?php echo $this->get_field_name( 'show_facebookmaster' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_facebookmaster' ); ?>"><b><?php _e('Display Social Plugin', 'facebook master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookmaster_page' ); ?>"><?php _e('Facebook Fan Page Link:', 'facebook master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookmaster_page' ); ?>" name="<?php echo $this->get_field_name( 'facebookmaster_page' ); ?>" value="<?php echo $instance['facebookmaster_page']; ?>" style="width:auto;" />
	</p>
	<div class="description">Facebook Fan Page Link, ie <b>https://www.facebook.com/techgasp</b></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Facebook App ID</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Display Plugin Header</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Display Facebook User Faces</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Display Facebook Stream</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Color Scheme</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Display Plugin Border</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Facebook Width and Height</b>
	</p>
	<div class="description">Only available in advanced version.</div><br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Shortcode Framework</b>
	</p>
	<div class="description">The shortcode framework allows you to insert Facebook Master inside Pages & Posts without the need of extra plugins or gimmicks. Fast page load times and top SEO. Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Facebook Master Website</b>
	</p>
	<p><a class="button-secondary" href="http://wordpress.techgasp.com/facebook-master/" target="_blank" title="Facebook Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/facebook-master-documentation/" target="_blank" title="Facebook Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/facebook-master/" target="_blank" title="Facebook Master Wordpress">Adv. Version</a></p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Advanced Version Updater:</b>
	</p>
	<div class="description">The advanced version updater allows to automatically update your advanced plugin. Only available in advanced version.</div>
	<br>
	<?php
	}
 }
?>