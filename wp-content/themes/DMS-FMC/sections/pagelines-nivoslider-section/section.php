<?php

/*
    Section: NivoSlider
    Author: Chris Pittman Jr
    Author URI: http://www.chrispittmanjr.com
    Description: This section adds a slider for featured post images
    Class Name: PagelinesNivoSlider
    Filter: sliders
    Loading: refresh
*/

class PagelinesNivoSlider extends PageLinesSection {
	
	function section_persistent() {
       
		$url = $this->base_url; // the base url of the section
		
		$dir = $this->base_dir; // the base directory of the section
		
		//$thumb = $this->screenshot;  // the section thumb
		
		//$splash = $this->splash; // the section splash
		
		//add_image_size('featured',688,500);
    
	}
	
	function section_opts()	{
		
		//$opts = array();
		
		$opts = array(
        
		    array(
        
		        'key'           => 'num_of_slides',
        
		        'type'          => 'select',
        
		        'title'         => 'How many featured slides to display?',
        
		        'label'         => 'How many featured slides to display?',
        
		        'opts'=> array(
        
		             2     => array( 'name' => '2' ),
		
					 5     => array( 'name' => '5' ),
        
		            10     => array( 'name' => '10' )
        
		        )
        
		    ),
			
			array(
        
		        'key'           => 'category_name',
        
		        'type'          => 'text',
        
		        'title'         => 'choose a category to display',
        
		        'label'         => 'which category would you like to feature',
        
		    )
        
		);
		
		return $opts;
		
	}
	
	function section_template() {
	
		// The Query arguments
	
		$args = array(
	
			'category_name'=> $this->opt('category-name'),
	
			'posts_per_page' => $this->opt('num_of_slides'),
	
		);
		
		// The Query
	
		$the_query = new WP_Query( $args );
		
		// The Loop
	
		if ( $the_query->have_posts() ) {
				
			echo '<div class="slider-wrapper"><div id="slider" class="nivoSlider">';

			while ( $the_query->have_posts() ) {

				$the_query->the_post();
	
				//Default attributes for post_thumbnail
	
				//$size = 'featured';
	
				$default_attr = array(
	
					//'src'	=> $src,
	
					//'class'	=> "nivo-slider-image",
	
					//'alt'	=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )),
	
					'title'	=> trim(strip_tags( get_the_title() ))

				);

			//$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			$feat_image = $feat_image[0];
	
			//echo '<a class="nivo-imageLink" href="' . get_permalink() . '">' . the_post_thumbnail( 'featured' , $default_attr ) . '</a>';
			// echo '<a class="nivo-imageLink" href="' . get_permalink() . '">' . '<img src="'  . $feat_image . '" class="nivo-slider-image" title="' . trim(strip_tags( get_the_title() )) . '" />' . '</a>';
			echo '<a href="' . get_permalink() . '">' . '<img src="'  . $feat_image . '" title="' . trim(strip_tags( get_the_title() )) . '" />' . '</a>';
			
			//echo get_permalink();
			$post_id = get_the_ID();
			$url = wp_get_attachment_image_src( $post_id );
			echo $url[0];
			}

			echo '</div></div>';
			
			
			
			

		} else {

			// no posts found

		}

		/* Restore original Post Data */
		wp_reset_postdata();

		/* Restore original WP_Query */
		wp_reset_query();
	
?>
		
		<div id="htmlcaption" class="nivo-html-caption">
			
		</div>
		
<?php }
	
	function section_head() {?>
		
		<!--<link rel="stylesheet" href="<?php $this->base_url ?>/nivo-slider.css" type="text/css" />-->
		
		<!--<script src="/fmc/wp-content/themes/DMS-FMC/sections/pagelines-nivoslider-section/jquery.nivo.slider.pack.js" type="text/javascript"></script>-->
		
		<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery('#slider').nivoSlider({
					effect: 'fade',               // Specify sets like: 'fold,fade,sliceDown'
					// slices: 15,                     // For slice animations
					// boxCols: 8,                     // For box animations
					// boxRows: 4,                     // For box animations
					animSpeed: 2000,                 // Slide transition speed
					pauseTime: 8000,                // How long each slide will show
					startSlide: 0,                  // Set starting Slide (0 index)
					directionNav: true,             // Next & Prev navigation
					controlNav: false,               // 1,2,3... navigation
					controlNavThumbs: false,        // Use thumbnails for Control Nav
					pauseOnHover: true,             // Stop animation while hovering
					manualAdvance: false,           // Force manual transitions
					prevText: 'Prev',               // Prev directionNav text
					nextText: 'Next',               // Next directionNav texts
					beforeChange: function(){},     // Triggers before a slide transition
					afterChange: function(){},      // Triggers after a slide transition
					slideshowEnd: function(){},     // Triggers after all slides have been shown
					lastSlide: function(){},        // Triggers when last slide is shown
					afterLoad: function(){}         // Triggers when slider has loaded
				});
			});
			
			
			
		</script> 
		
	<?php }
	
	function section_styles() {
		
		wp_enqueue_script( 
			'nivo-slider',
			$this->base_url.'/jquery.nivo.slider.pack.js',
			array('jquery')
		);
		
		wp_enqueue_style( 
			'nivo-slider-css', 
			$this->base_url.'/nivo-slider.css' 
		);
		
	}
	
}

?>
