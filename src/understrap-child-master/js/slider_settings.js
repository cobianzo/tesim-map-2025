/**/
    jQuery(document).ready(function() {
        var owl = jQuery('.owl-carousel');
        owl.owlCarousel({
            items:(understrap_slider_variables.items),
            loop:true,
            autoplay:true,
            autoplayTimeout:(understrap_slider_variables.timeout),
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            nav: false,
            dots: true,
            autoplayHoverPause:true,
            margin:0,
            autoHeight:false,
//            itemsScaleUp:true,
            singleItem:true,
            
        });

        jQuery('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        });
        jQuery('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        });
        
        
/*
	    function updateSize(){
	        var minHeight=parseInt($('.owl-item').eq(0).css('height'));
	        $('.owl-item').each(function () {
	            var thisHeight = parseInt($(this).css('height'));
	            minHeight=(minHeight<=thisHeight?minHeight:thisHeight);
	        });
	        $('.owl-wrapper-outer').css('height',minHeight+'px');
	    }
  */      
        
    });

