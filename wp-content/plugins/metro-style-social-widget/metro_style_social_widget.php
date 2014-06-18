<?php
/*
Plugin Name: Metro Style Social Widget
Plugin URI: http://www.howopensource.com/metro-style-social-widget-wordpress
Description: Sidebar widget that displays Metro Style Social Icons and links to your Social Profiles.
Version: 0.9.9
Author: Manivannan Muthaiyan
Author URI: http://www.howopensource.com
License: GPLv2 or Later
*/


class Metro_Style_Socialicons_Widget extends WP_Widget {


	function Metro_Style_Socialicons_Widget() {
	
		/* Widget settings */
		$widget_ops = array( 'classname' => 'metro_style_social_widget', 'description' => __('Widget displays metro style social icons and links to your social profiles', 'metro_style_social_widget' ));

		/* Widget control settings */
		$control_ops = array('id_base' => 'metro_style_social_widget');

		/* Create the widget */
		$this->WP_Widget('metro_style_social_widget', 'Metro Style Social Icons', $widget_ops, $control_ops);

		add_action('wp_enqueue_scripts', array($this, 'register_widget_styles'));

		add_action( 'admin_notices', array($this, 'metro_style_admin_notice'));

		add_action('admin_init', array($this, 'metro_style_message_ignore'));
	}

	function metro_style_admin_notice() {
		global $current_user ;
        	$user_id = $current_user->ID;
		if ( ! get_user_meta($user_id, 'metro_style_hide_notice') ) {
        	echo '<div class="updated"><a style="float: right;line-height: 30px;font-weight: bold;" href="?metro_style_message_ignore=0">Dismiss</a><p><b>Metro Style Social Widget</b></p>';
        	printf(__('<p>RSS feed settings changed, Now use <b>full URL / Custom feed URL</b> in the input field. | <a href="%1$s">Hide Notice</a>'), '?metro_style_message_ignore=0');
        	echo "</p></div>";
		}
	}

	function metro_style_message_ignore() {
		global $current_user;
        	$user_id = $current_user->ID;
        	if ( isset($_GET['metro_style_message_ignore']) && '0' == $_GET['metro_style_message_ignore'] ) {
             		add_user_meta($user_id, 'metro_style_hide_notice', 'true', true);
		}
	}

	function register_widget_styles() {
		wp_enqueue_style('metro_style_social_widget', plugins_url('metro-style-social-widget/CSS/metro.css'));
	}


	/* Widget form creation */
	function form( $instance ) {
	
		/* Default widget settings */
		$defaults = array(
		'title' => 'Metro Social Media',
		'rssfeed' => 'http://feeds.howopensource.com/HowOpenSource',
		'twitter' => 'howopensource',
		'facebook' => 'howopensource',	
		'google' => '108151203181049867089',
		'pinterest' => 'howopensource',
		'linkedin' => '',
		'select_linkedin' => '',
		'youtube' => '',
		'noyoutube' => false,
		'nolinkedin' => false,
		'nopinterest' => false,
		'nogoogle' => false,
		'norssfeed' => false,
		'button' => 'button',
		'width' => '',
		'autofix' => true
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Type the width:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook Page ID:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e('Google+ ID:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" value="<?php echo $instance['google']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter Name:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest ID:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('Linkedin ID/Full URL:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'rssfeed' ); ?>"><?php _e('RSS Feed URL:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'rssfeed' ); ?>" name="<?php echo $this->get_field_name( 'rssfeed' ); ?>" value="<?php echo $instance['rssfeed']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtube ID:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('select_linkedin'); ?>"><?php _e('Select linkedin Type'); ?></label>
			<select name="<?php echo $this->get_field_name('select_linkedin'); ?>" id="<?php echo $this->get_field_id('select_width'); ?>" class="widefat">
			<?php 
			$options = array('Member', 'Company');
			foreach ($options as $option) { ?>
				<option <?php selected( $instance['select_linkedin'], $option ); ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
			<?php	}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('noyoutube'); ?>"><input id="<?php echo $this->get_field_id( 'noyoutube' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'noyoutube' ); ?>" value="1" <?php checked( 1, $instance['noyoutube'] ); ?>/> <?php esc_html_e( 'don\'t show youtube', 'metro_style_social_widget' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('nolinkedin'); ?>"><input id="<?php echo $this->get_field_id( 'nolinkedin' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'nolinkedin' ); ?>" value="1" <?php checked( 1, $instance['nolinkedin'] ); ?>/> <?php esc_html_e( 'don\'t show linkedin', 'metro_style_social_widget' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('nopinterest'); ?>"><input id="<?php echo $this->get_field_id( 'nopinterest' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'nopinterest' ); ?>" value="1" <?php checked( 1, $instance['nopinterest'] ); ?>/> <?php esc_html_e( 'don\'t show pinterest', 'metro_style_social_widget' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('nogoogle'); ?>"><input id="<?php echo $this->get_field_id( 'nogoogle' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'nogoogle' ); ?>" value="1" <?php checked( 1, $instance['nogoogle'] ); ?>/> <?php esc_html_e( 'don\'t show google+', 'metro_style_social_widget' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('norssfeed'); ?>"><input id="<?php echo $this->get_field_id( 'norssfeed' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'norssfeed' ); ?>" value="1" <?php checked( 1, $instance['norssfeed'] ); ?>/> <?php esc_html_e( 'don\'t show rssfeed', 'metro_style_social_widget' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button'); ?>"><input id="<?php echo $this->get_field_id( 'button' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'button' ); ?>" value="1" <?php checked( 1, $instance['button'] ); ?>/> <?php esc_html_e( 'Add Like/Follow Button', 'metro_style_social_widget' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('autofix'); ?>"><input id="<?php echo $this->get_field_id( 'autofix' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'autofix' ); ?>" value="1" <?php checked( 1, $instance['autofix'] ); ?>/> <?php esc_html_e( 'Autofix, if the plugin didn\'t displayed on your site', 'metro_style_social_widget' ); ?></label>
		</p>

	<?php
	}

	/* Widget update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['width'] = $new_instance['width'];
		
		$instance['facebook'] = $new_instance['facebook'];
	
		$instance['google'] = $new_instance['google'];

		$instance['twitter'] = $new_instance['twitter'];

		$instance['pinterest'] = $new_instance['pinterest'];

		$instance['linkedin'] = $new_instance['linkedin'];

		$instance['rssfeed'] = $new_instance['rssfeed'];

		$instance['youtube'] = $new_instance['youtube'];

		$instance['noyoutube'] = $new_instance['noyoutube'];

		$instance['nolinkedin'] = $new_instance['nolinkedin'];

		$instance['nopinterest'] = $new_instance['nopinterest'];

		$instance['nogoogle'] = $new_instance['nogoogle'];

		$instance['norssfeed'] = $new_instance['norssfeed'];

		$instance['button'] = $new_instance['button'];

		$instance['autofix'] = $new_instance['autofix'];

		$instance['select_linkedin'] = $new_instance['select_linkedin'];

		return $instance;
	}

	/* Widget display */
	function widget( $args, $instance ) {
		extract( $args );

		/* Available Widget Options */
		$title = apply_filters('widget_title', $instance['title'] );
		$facebook = $instance['facebook'];
		$google = $instance['google'];
		$twitter = $instance['twitter'];
		$pinterest = $instance['pinterest'];
		$linkedin = $instance['linkedin'];
		$rssfeed = $instance['rssfeed'];
		$youtube = $instance['youtube'];
		$noyoutube = $instance['noyoutube'];
		$nolinkedin = $instance['nolinkedin'];
		$nopinterest = $instance['nopinterest'];
		$nogoogle = $instance['nogoogle'];
		$norssfeed = $instance['norssfeed'];
		$button = $instance['button'];
		$width = $instance['width'];
		$autofix = $instance['autofix'];
		$select_linkedin = $instance['select_linkedin'];

		/* Before widget */
		if ($autofix) {
		    $before_widget = $instance[''];
		}
		else
		  {
		    echo $before_widget;
		}

		/* Check if title is set */
		if ( $title )
			echo $before_title . $title . $after_title;

		if ( $select_linkedin == 'Member' ) 
		{ 
			$linkedin_url = $linkedin; 
		}
		else if ( $select_linkedin == 'Company' )
		{
			$linkedin_url = "http://www.linkedin.com/company/".$linkedin;
		}
	   	?>


		<?php if (!$button) {
			include('style_without_buttons.php');
		}

		else if ($button) {
			include('style_with_buttons.php');
		}

	?>

        <?php
		/* After widget */
		if ($autofix) {
		    $after_widget = $instance[''];
		}
		else
		  {
		    echo $after_widget;
		}
	}
}

/* Register widget */
add_action('widgets_init', create_function('', 'return register_widget("Metro_Style_Socialicons_Widget");'));
?>
