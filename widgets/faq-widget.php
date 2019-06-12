<?php
/**
 * Elementor Repeater Control
 */

class Elementor_Repeater_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'FAQWidgets';
     }

     public function get_title() {
         return __( 'FAQWidgets', 'myfirstelementorplugin' );
     }

     public function get_icon() {
         return 'fa fa-question';
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

        $repeater = new \Elementor\Repeater();

        $this->add_control('title', [
                'label' => __( 'Title', 'myfirstelementorplugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $this->add_control('descripttion', [
            'label' => __( 'Descripttion', 'myfirstelementorplugin' ),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $this->add_control('faqs', [
            'label' => __( 'FAQs', 'myfirstelementorplugin' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' =>[
                [
                    'title' => 'FAQ 1',
                    'description' => 'DESC 2'
                ],
                [
                    'title' => 'FAQ 2',
                    'description' => 'DESC 2'
                ]
            ]
        ]);
    
        $this->end_controls_section();
     }

     protected function render() {}

    protected function _content_template(){}
}