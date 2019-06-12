<?php
/**
 * 
 */
class Elementor_Test_Widget extends \Elementor\Widget_Base {

        public function get_name() {
		   return 'TestWidgets';
	    }

	    public function get_title() {
		    return __( 'TestWidgets', 'myfirstelementorplugin' );
	    }

	    public function get_icon() {
		    return 'fa fa-image';
	    }

	    public function get_categories() {
		    return [ 'general' ,'TestCategory'];
	    }
 
        protected function _register_controls() {

            $this->start_controls_section(
                'content_section',
                [
                    'label' => __( 'Content', 'myfirstelementorplugin' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
    
            $this->add_control(
                'heading',
                [
                    'label' => __( 'Hello Elementor', 'myfirstelementorplugin' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter text here', 'myfirstelementorplugin' ),
                ]
            );
           
            $this->end_controls_section();

            $this->start_controls_section(
                'position_section',
                [
                    'label' => __( 'Position', 'myfirstelementorplugin' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'alignment',
                [
                    'label' => __( 'Alignment', 'myfirstelementorplugin' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'center',
                       'options' => [
                           'left' => __( 'Left', 'myfirstelementorplugin' ),
                           'right' => __( 'Right', 'myfirstelementorplugin' ),
                           'center' => __( 'Center', 'myfirstelementorplugin' )
                       ],
                    'selectors' => [
                        '{{WRAPPER}} h1.heading'=> 'text-align:{{VALUE}}'
                    ]
                 ]
            );
    
            $this->end_controls_section();

            $this->start_controls_section(
                'color_section',
                [
                    'label' => __( 'Color', 'myfirstelementorplugin' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
           
            $this->add_control(
                'heading_color',
                [
                    'label' => __( 'Heading Color', 'myfirstelementorplugin' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#224400',
                    'selectors' => [
                        '{{WRAPPER}} h1.heading'=>'color:{{VALUE}}'
                    ]
                ]
            );
          
            $this->end_controls_section();

            $this->start_controls_section(
                'image_section',
                [
                    'label' => __( 'Image', 'myfirstelementorplugin' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
           
            $this->add_control('imagex',[
                'label' => __( 'Image', 'myfirstelementorplugin' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src() 
                ]
            ]);
           
            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'default' => 'medium',
                    'name'    => 'imagesz' // this is size name
                ]
            );
         $this->end_controls_section();
         
         $this->start_controls_section(
            'demo_section',
            [
                'label' => __( 'Control Demo', 'myfirstelementorplugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

         $this->add_control(
            'demo_select2',
            [
                'label' => __( 'Select 2 Demo', 'myfirstelementorplugin' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                   'options' => [
                       'BD' => __( 'Bangladesh', 'myfirstelementorplugin' ),
                       'BR' => __( 'Brazil', 'myfirstelementorplugin' ),
                       'IN' => __( 'INDIA', 'myfirstelementorplugin' )
                   ]
             ]
        );

        $this->add_control(
            'demo_choose',
            [
                'label' => __( 'Choose Demo', 'myfirstelementorplugin' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => true,
                   'options' => [
                      'left' => [
                        'title' => __( 'Left', 'myfirstelementorplugin' ),
                        'icon' => 'fa fa-align-left'
                      ],
                      'right' => [
                        'title' => __( 'Right', 'myfirstelementorplugin' ),
                        'icon' => 'fa fa-align-right'
                      ],
                      'center' => [
                        'title' => __( 'Center', 'myfirstelementorplugin' ),
                        'icon' => 'fa fa-align-center'
                      ],
                      'justify' => [
                        'title' => __( 'Justify', 'myfirstelementorplugin' ),
                        'icon' => 'fa fa-align-justify'
                      ]
                   ]
             ]
        );

        $this->add_control('demo_dimension' , [
             'label' => __( 'Dimension', 'myfirstelementorplugin' ),
             'type'  => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
             'description' => __('Select Width & Height','myfirstelementorplugin'),
             'default' => [
                 'height' => 100,
                 'width' => 100
             ]
        ]);

        $this->add_control('gallery' , [
            'label' => __( 'Gallery Control', 'myfirstelementorplugin' ),
            'type'  => \Elementor\Controls_Manager::GALLERY
       ]);

       $this->add_control('icon' , [
        'label' => __( 'Icon Control', 'myfirstelementorplugin' ),
        'type'  => \Elementor\Controls_Manager::ICON,
        'include' => [
            'fa fa-facebook',
            'fa fa-twitter',
            'fa fa-github'
        ]
   ]);

        $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            $heading  = $settings['heading'];
            $alignment  = $settings['alignment'];

            $this->add_inline_editing_attributes('heading','advanced');
            //Fixing CSS Classs
            $this->add_render_attribute('heading' , [
             'class' => 'heading'
            ]);

            echo "<h1" . $this->get_render_attribute_string('heading') . ">".esc_html( $heading )."</h1>";
            //echo wp_get_attachment_image($settings['image']['id']);
            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings,'imagesz','imagex'); // Size name , Control Name

            $countries = $settings['demo_select2'];
            
            foreach($countries as $country){ ?>
              <ul><li><?php echo $country; ?></li></ul>
           <?php }
           
           echo $settings['demo_choose'];
           echo "<br>";
           echo $settings['demo_dimension'];

           echo "<div>";
           $gallery = $settings['gallery'];
           foreach($gallery as $image){
               echo wp_get_attachment_image( $image['id'] , 'medium' );
           }
           echo "</div>";
        }

        protected function _content_template(){
            ?>
             <#
               var image = {
                  id:settings.imagex.id,
                  url:settings.imagex.url,
                  size:settings.imagex.imagesz_size,
                  dimension: settings.imagesz_custom_dimension
               } 

               var imageUrl = elementor.imagesManager.getImageUrl(image);
             #>

             <#
             view.addInlineEditingAttributes('heading','advanced');
             view.addRenderAttribute('heading' , {'class' : 'heading'});
             #>
             <h1 {{{ view.getRenderAttributeString('heading') }}} > {{{settings.heading}}} </h1>
             <img src="{{{imageUrl}}}" alt="">
             
             <ul>
                <#
                _.each(settings.demo_select2 , function(country){ #>
                   <li>{{{ country }}}</li>
                <# }); #>
             </ul>
             <div>{{{ settings.demo_choose }}}</div>
             <div>
              Height: {{{settings.demo_dimension.height}}}
              Width: {{{settings.demo_dimension.width}}}
             </div>

             <div>
                <#
                _.each(settings.gallery , function(image){ #>
                    <img src="{{{imageUrl}}}" alt="">
                <# }); #>
             </div>

            <?php 
        }
    
}
