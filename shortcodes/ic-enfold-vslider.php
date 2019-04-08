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