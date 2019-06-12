;(function($){
  $(document).ready(function(){
   
  });

  elementor.hooks.addAction("panel/open_editor/widget/Pricing",function( panel, model, view ){
      
    $("input:hidden[value='select_hidden_style']").parents('.elementor-control').prev().find('select').on('change',function(){
        if('blue' == $(this).val()){
            $("input:hidden[value='hidden_item_selector']").parents('.elementor-control').prev().show();
        }else{
            $("input:hidden[value='hidden_item_selector']").parents('.elementor-control').prev().hide();
        }
     });

     if('blue' == $("input:hidden[value='select_hidden_style']").parents('.elementor-control').prev().find('select').val()){
        $("input:hidden[value='hidden_item_selector']").parents('.elementor-control').prev().show();
    }else{
        $("input:hidden[value='hidden_item_selector']").parents('.elementor-control').prev().hide();
    }

  });
})(jQuery);