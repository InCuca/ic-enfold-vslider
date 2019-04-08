<?php
if ( !class_exists( 'ic_enfold_vslider' ) ) {
    class ic_enfold_vslider extends aviaShortcodeTemplate
	{
		function shortcode_insert_button()
		{
			// Configure shortcode
			$this->config['name']		= 'Enfold Vslider';
			$this->config['icon']		= plugin_dir_url(__FILE__) . '../images/ic-template-icon.png';
			$this->config['target']		= 'avia-target-insert';
			$this->config['shortcode'] 	= 'ic-enfold-vslider';
			$this->config['shortcode_nested'] = array('ic-enfold-vslider-slide');
			$this->config['tooltip'] 	= 'Exibe uma slider vertical';
			$this->config['preview'] 	= false;
			$this->config['self_closing']	=	'no';
			$this->config['disabling_allowed'] = true;				
		}

		function popup_elements()
		{
			if(avia_get_option('disable_mediaelement') == 'disable_mediaelement')
			{
				$videoText = __("Please link to an external video by URL",'avia_framework' )."<br/><br/>".
						__("A list of all supported Video Services can be found on",'avia_framework' ).
						" <a target='_blank' href='http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F'>WordPress.org</a><br/><br/>".
						__("Working examples:",'avia_framework' ). "<br/>".
						"<strong>https://vimeo.com/1084537</strong><br/>".
						"<strong>https://www.youtube.com/watch?v=G0k3kHtyoqc</strong><br/><br/>"."<strong class='av-builder-note'>".									__("Using self hosted videos is currently disabled. You can enable it in Enfold &raquo; Performance",'avia_framework' )."</strong><br/>";

			}
			//if youtube/vimeo is disabled
			else if(avia_get_option('disable_video') == 'disable_video')
			{
				$videoText = __("Either upload a new video or choose an existing video from your media library",'avia_framework' )."<br/><br/>".
						__("Different Browsers support different file types (mp4, ogv, webm). If you embed an example.mp4 video the video player will automatically check if an example.ogv and example.webm video is available and display those versions in case its possible and necessary",'avia_framework' )."<br/><br/><strong class='av-builder-note'>".
						__("Using external services like Youtube or Vimeo is currently disabled. You can enable it in Enfold &raquo; Performance",'avia_framework' )."</strong><br/>";
						
			}
			//all video enabled
			else
			{
				$videoText = __("Either upload a new video, choose an existing video from your media library or link to a video by URL",'avia_framework' )."<br/><br/>".
									__("A list of all supported Video Services can be found on",'avia_framework' ).
									" <a target='_blank' href='http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F'>WordPress.org</a><br/><br/>".
									__("Working examples, in case you want to use an external service:",'avia_framework' ). "<br/>".
									"<strong>https://vimeo.com/1084537</strong><br/>".
									"<strong>https://www.youtube.com/watch?v=G0k3kHtyoqc</strong><br/><br/>".
									"<strong>".__("Attention when using self hosted HTML 5 Videos",'avia_framework' ). ":</strong><br/>".
									__("Different Browsers support different file types (mp4, ogv, webm). If you embed an example.mp4 video the video player will automatically check if an example.ogv and example.webm video is available and display those versions in case its possible and necessary",'avia_framework' )."<br/>";
			}
			
			$this->elements = array(
					
				array(
					"type" 	=> "tab_container", 'nodescription' => true
				),
					// Tab Content
					array(
						"type" 	=> "tab",
						"name"  => __("Content" , 'avia_framework'),
						'nodescription' => true
					),

					array(
                        "name" => __("Add/Edit Slides", 'avia_framework' ),
                        "desc" => __("Here you can add, remove and edit the slides you want to display.", 'avia_framework' ),
                        "type" 			=> "modal_group",
                        "id" 			=> "content",
                        "modal_title" 	=> __("Edit Form Element", 'avia_framework' ),
                        "std"			=> array(
                            array('title'=>__('Slide 1', 'avia_framework' )),
                            array('title'=>__('Slide 2', 'avia_framework' )),

                        ),
                        'subelements' 	=> array(
                            array(
                                "name" 	=> __("Slide Title", 'avia_framework' ),
                                "desc" 	=> __("Enter the slide title here (Better keep it short)", 'avia_framework' ) ,
                                "id" 	=> "title",
                                "std" 	=> "Slide Title",
								"type" 	=> "input"
							),
							array(
								"name" 	=> 'Featured settings',
								"desc" 	=> "Either use the image or video in featured space",
								"id" 	=> "featured",
								"type" 	=> "select",
								"std" 	=> "image",
								"subtype" => array(
									'Image'=>'image',
									'Video' => 'video'
								),
							),
							array(
								"name" 	=> __("Choose Image",'avia_framework' ),
								"desc" 	=> __("Either upload a new, or choose an existing image from your media library",'avia_framework' ),
								"id" 	=> "image",
								"type" 	=> "image",
								"title" => __("Insert Image",'avia_framework' ),
								"button" => __("Insert",'avia_framework' ),
								"std" 	=> AviaBuilder::$path['imagesURL']."placeholder.jpg",
								"required" => array('featured','equals','image')
							),
							array(	
								"name" 	=> __("Choose Video",'avia_framework' ),
								"desc" 	=> $videoText,
								"id" 	=> "video",
								"type" 	=> "video",
								"title" => __("Insert Video",'avia_framework' ),
								"button" => __("Insert",'avia_framework' ),
								"std" 	=> "",
								"required" => array('featured','equals','video')
							),
                            array(
                                "name" 	=> __("Slide Content", 'avia_framework' ),
                                "desc" 	=> __("Enter some content here", 'avia_framework' ) ,
                                "id" 	=> "content",
                                "type" 	=> "tiny_mce",
                                "std" 	=> __("Slide Content goes here", 'avia_framework' ) ,
                            ),
                        )
                    ),
											
					array(
						"type" 	=> "close_div",
						'nodescription' => true
					),					
	
					// Tab Screen Options
					array(
						"type" 	=> "tab",
						"name"	=> __("Screen Options",'avia_framework' ),
						'nodescription' => true
					),			
								
					array(
						"name" 	=> __("Element Visibility",'avia_framework' ),
						"desc" 	=> __("Set the visibility for this element, based on the device screensize.", 'avia_framework' ),
						"type" 	=> "heading",
						"description_class" => "av-builder-note av-neutral",
					),		
					array(	
						"desc" 	=> __("Hide on large screens (wider than 990px - eg: Desktop)", 'avia_framework'),
						"id" 	=> "av-desktop-hide",
						"std" 	=> "",
						"container_class" => 'av-multi-checkbox',
						"type" 	=> "checkbox"
					),
					
					array(	
						
						"desc" 	=> __("Hide on medium sized screens (between 768px and 989px - eg: Tablet Landscape)", 'avia_framework'),
						"id" 	=> "av-medium-hide",
						"std" 	=> "",
						"container_class" => 'av-multi-checkbox',
						"type" 	=> "checkbox"
					),
							
					array(	
						"desc" 	=> __("Hide on small screens (between 480px and 767px - eg: Tablet Portrait)", 'avia_framework'),
						"id" 	=> "av-small-hide",
						"std" 	=> "",
						"container_class" => 'av-multi-checkbox',
						"type" 	=> "checkbox"
					),
							
					array(			
						"desc" 	=> __("Hide on very small screens (smaller than 479px - eg: Smartphone Portrait)", 'avia_framework'),
						"id" 	=> "av-mini-hide",
						"std" 	=> "",
						"container_class" => 'av-multi-checkbox',
						"type" 	=> "checkbox"
					),
					
					array(
						"type" 	=> "close_div",
						'nodescription' => true
					),
				array(
					"type" 	=> "close_div",
					'nodescription' => true
				),		
			);
		}

		function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
		{
			// Get options from admin popup
			$atts = shortcode_atts(array(
				'class'	=> $meta['el_class'],
				'custom_class' => '',
				'custom_markup' => $meta['custom_markup'],
				'content'		=> ShortcodeHelper::shortcode2array($content, 1),
                'av-desktop-hide'=>'',
                'av-medium-hide'=>'',
                'av-small-hide'=>'',
				'av-mini-hide'=>'',
				'image' => '',
				'video' => '',
				'featured' => 'image',
			), $atts, $this->config['shortcode']);

			/*
			 * Creates $class, $custom_class, $custom_markup, $message
			 */
			extract($atts);
			$custom_class = $custom_class?" $custom_class":"";

			ob_start();
			?>
			<div class="ic-enfold-vslider-container<?php echo $custom_class; ?>">
				<?php echo $message; ?>
			</div>
			<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}

		function editor_element($params)
		{
			$params['innerHtml'] = "<img src='".$this->config['icon']."' title='".$this->config['name']."' />";
			$params['innerHtml'].= "<div class='avia-element-label'>".$this->config['name']."</div>";
			return $params;
		}

		function editor_sub_element($params)
		{
			$template = $this->update_template("title", "{{title}}");

			$params['innerHtml']  = "";
			$params['innerHtml'] .= "<div class='avia_title_container' {$template}>".$params['args']['title']."</div>";


			return $params;
		}

		function extra_assets()
		{
			$plugin_dir = plugin_dir_url(__FILE__);
			wp_enqueue_style( 'ic-enfold-vslider' , $plugin_dir.'../css/ic-enfold-vslider.css' , array(), false );
			wp_enqueue_script( 'ic-enfold-vslider' , $plugin_dir.'../js/ic-enfold-vslider.js' , array(), false, TRUE );
		}
	}
}