<?php
/**
 * Elementor Repeater Control
 */

class Elementor_Pricing_Widget extends \Elementor\Widget_Base {
     public function get_name() {
        return 'Pricing';
     }

    public function get_title() {
         return __( 'Pricing', 'myfirstelementorplugin' );
     }

    public function get_icon() {
         return 'fa fa-table';
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
        
        $this->add_control('style', [
          'label' => __( 'Style', 'myfirstelementorplugin' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'options' => [
            'default'  => __( 'Default', 'myfirstelementorplugin' ),
            'blue' => __( 'Blue', 'myfirstelementorplugin' ),
          ],
          'default' => 'default'
        ]);

        $this->add_control('select_hidden_style', [
          'label' => __( 'Style', 'myfirstelementorplugin' ),
          'type' => \Elementor\Controls_Manager::HIDDEN,
          'default' => 'select_hidden_style'
        ]);


        $this->add_control('title', [
                'label' => __( 'Title', 'myfirstelementorplugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('featured', [
          'label' => __( 'Featured', 'myfirstelementorplugin' ),
          'type' => \Elementor\Controls_Manager::SWITCHER,
          'default' => false
        ]);

        $repeater->add_control('title', [
            'label' => __( 'Title', 'myfirstelementorplugin' ),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeater->add_control('description', [
           'label' => __( 'Description', 'myfirstelementorplugin' ),
           'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);

        $repeater->add_control('items', [
          'label' => __( 'Items', 'myfirstelementorplugin' ),
          'type' => \Elementor\Controls_Manager::TEXTAREA,
       ]);

       $repeater->add_control('hidden_item_selector', [
        'label' => __( 'Style', 'myfirstelementorplugin' ),
        'type' => \Elementor\Controls_Manager::HIDDEN,
        'default' => 'hidden_item_selector'
      ]);

        $repeater->add_control('pricing', [
          'label' => __( 'Pricing', 'myfirstelementorplugin' ),
          'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeater->add_control('button_title', [
            'label' => __( 'Button Title', 'myfirstelementorplugin' ),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeater->add_control('button_url', [
            'label' => __( 'Button Url', 'myfirstelementorplugin' ),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $this->add_control('pricings', [
            'label' => __( 'Pricing columns', 'myfirstelementorplugin' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}'
        ]);

        $this->end_controls_section();
     }

    protected function render() {
         $settings = $this->get_settings_for_display();
         $heading  = $this->get_settings('title');
         $pricings  = $this->get_settings('pricings');
         $style = $this->get_settings('style');
         if('default' == $style){
    ?>
    <section class="fdb-block" style="background-image: url(imgs/hero/red.svg);">
      <div class="container">
        <div class="row text-center">
          <div class="col">
            <h1 class="text-white"><?php echo esc_html( $heading ); ?></h1>
          </div>
        </div>
 
        <div class="row mt-5 align-items-center">

      <?php 
        if($pricings):
          foreach ($pricings as $price): extract($price);?>
            <div class="col-12 col-sm-10 col-md-8 m-auto col-lg-4 text-center pt-4 pt-lg-0">
            <div class="fdb-box p-4">
              <h2><?php echo $title; ?></h2>
              <p class="lead"><?php echo $description; ?></p>
    
              <p class="h1 mb-5 mt-5"><?php echo apply_filters('pricing_issue','$'); ?><?php echo $pricing; ?></p>
    
              <p><a href="<?php echo $button_url; ?>" class="btn <?php echo $featured ? 'btn-secondary' : 'btn-dark'; ?>"><?php echo $button_title; ?></a></p>
            </div>
          </div>
          <?php endforeach; endif; ?>

        </div>
      </div>
</section>
       <?php } else { ?>
        <section class="fdb-block" style="background-image: url(./imgs/shapes/1.svg)">
      <div class="container">
        <div class="row text-center">
          <div class="col">
            <h1 class="text-light"><?php echo esc_html( $heading ); ?></h1>
          </div>
        </div>
    
        <div class="row mt-5 align-items-center">
    <?php 
     if($pricings):
      foreach ($pricings as $price): extract($price);?>

          <div class="col-12 col-sm-10 col-md-8 col-md-8 m-auto col-lg-4 text-center">
            <div class="fdb-box shadow pb-5 pt-5 pl-3 pr-3 rounded">
              <h2><?php echo $title; ?></h2>
              <p class="lead"><strong><?php echo apply_filters('pricing_issue','$'); ?><?php echo $pricing; ?> / month</strong></p>
              <p class="h3 font-weight-light"><?php echo $description; ?></p>
    
              <ul class="text-left mt-5 mb-5">
                <?php
                  $items = explode("\n" , $items);
                  foreach ($items as $item) {
                    if($item)
                      {
                        echo "<li>{$item}</li>";
                      }
                   }
                ?>
              </ul>
    
              <p><a href="<?php echo $button_url; ?>" class="btn <?php echo $featured ? 'btn-secondary' : 'btn-dark'; ?> mt-4"><?php echo $button_title; ?></a></p>
            </div>
          </div>
      <?php endforeach; endif; ?>
     
        </div>
      </div>
    </section>
    <?php } }

    protected function _content_template(){}
}