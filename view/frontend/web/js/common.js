define(['jquery', 'jquery-ui-modules/widget', 'Magepow_Promotionbar/js/slick'], function($) {
   
        return function (config) {
              $(document).ready(function(){
        var showSlider = config.showSlider;

        var speedSlider = config.speedSlider;
        var sliderControl = config.sliderControl;
        console.log(sliderControl);
     if(!showSlider) return;
        $(".promotionbar").slick({
            infinite: true,
            slidesToShow: 1,
            autoplay: true,
             speed: speedSlider

        });
    });
              
    }

    });