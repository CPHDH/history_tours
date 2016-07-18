console.log('tour scripts...');
// SwipeJS image gallery
window.mySwipe = new Swipe(document.getElementById('slider'), {
  startSlide: 0,
  speed: 400,
  auto: 5000,
  continuous: true,
  disableScroll: false,
  stopPropagation: false,
  callback: function(index, elem) {},
  transitionEnd: function(index, elem) {}
});
// Fancybox image viewer
jQuery(document).ready(function() {
	jQuery(".fancybox").fancybox({
        beforeLoad: function() {
            this.title = jQuery(this.element).attr('data-caption');
        },
		openEffect	: 'elastic',
		closeEffect	: 'fade',
		padding:0,
		loop: false,
	    helpers : {
	         title: {
	            type: 'over'
	        },
	         overlay : {
	         	locked : true
	        },
	        thumbs : {
	            width: 50,
	            height: 50,
	            source : function( item ) {
                    return jQuery(item).attr('href');
                }
	        },	        
	    }
	});
});