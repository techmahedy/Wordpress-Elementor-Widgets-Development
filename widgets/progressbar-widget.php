<?php
/**
 * Elementor Repeater Control
 */

class Elementor_Progressbar_Widget extends \Elementor\Widget_Base {
     public function get_name() {
        return 'Progressbar';
     }

    public function get_title() {
         return __( 'Progressbar', 'myfirstelementorplugin' );
     }

    public function get_icon() {
         return 'fa fa-spinner';
     }

    public function get_categories() {
         return ['general'];
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
            'color',
            [
                'label' => __( 'Color', 'myfirstelementorplugin' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#224400',
            ]
        ); 
        
        $this->add_control(
            'value',
            [
                'label' => __( 'Value', 'myfirstelementorplugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1.0',
            ]
        ); 
        
        $this->end_controls_section();
     }

    protected function render() {
      $settings  = $this->get_settings_for_display();
      $color = $this->get_settings('color');
      $value = $this->get_settings('value');
    ?>
     <div class="progress" data-color="<?php echo $color; ?>" data-value="<?php echo $value; ?>"></div>
    <?php
    }

    protected function _content_template(){}
}