// SwipeJS image gallery
function doSwipe(){
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
}
	
jQuery(document).ready(function() {
	
	// Try slider on ready and when new locations are added
	doSwipe();
	jQuery('.ajax-container').bind('newlocation', function() {
	  doSwipe();
	});	
	
	// Fancybox image viewer
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
	
	// Location AJAX
	var location_links = jQuery('.tour-location-link');
	var loaded_locations = [];
	jQuery( location_links ).each(function(i,l) {
	    var href=jQuery( this ).attr('href');
	    jQuery( this ).on('click',function(){
		  	var container=jQuery( this ).next();
		  	if(!loaded_locations[i]){
			  	// if not already loaded, feth the content
			  	console.log('...getting data from: '+href);
			  	jQuery(container).addClass('loading');
				jQuery.ajax({
					url: href,
					success: function(data){
					  loaded_locations[i]=true; 
					  var article = jQuery(data).find('#main article');
					  article = article[0].innerHTML;
					  var html = jQuery(container).append(article).html();
					  jQuery(container).removeClass('loading').trigger('newlocation');;
					  
					},
					error: function(xhr, statusText) { 
						console.log("Error: "+statusText+'... redirecting to source page.'); 
						document.location.href = href;
					},
				  
				});				  	
		  	}else{
			  	// otherwise, toggle visibility
			  	jQuery(container).toggle();
		  	}
		return false;
	  })
	});
	
});