;(function($){
        $(window).on("elementor/frontend/init",function(){
            elementorFrontend.hooks.addAction('frontend/element_ready/Progressbar.default',function($scope, $){
                
                    $scope.find(".progress").each(function(){
                        var element = $(this)[0];

                        var color = $(this).data('color');
                        var value = $(this).data('value');

                        var bar = new ProgressBar.Line(element, {
                            strokeWidth: 4,
                            easing: 'easeInOut',
                            duration: 1400,
                            color: color,
                            trailColor: '#eee',
                            trailWidth: 1,
                            svgStyle: {width: '90%', height: '10px'},
                            text: {
                              style: {
                                // Text color.
                                // Default: same as stroke color (options.color)
                                color: '#999',
                                position: 'absolute',
                                right: '0',
                                top: '0',
                                padding: 0,
                                margin: 0,
                                transform: null
                              },
                              autoStyleContainer: false
                            },
                            from: {color: '#FFEA82'},
                            to: {color: '#ED6A5A'},
                            step: (state, bar) => {
                              bar.setText(Math.round(bar.value() * 100) + ' %');
                            }
                          });
                          
                          bar.animate(value);  // Number from 0.0 to 1.0
                    });
               
            });
        });
})(jQuery);