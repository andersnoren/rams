jQuery(document).ready(function($) {
	
	
	// Toggle blog-menu
	$(".nav-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$(".mobile-menu").slideToggle();
		return false;
	});
	
	
	// Hide mobile-menu > 960
	$(window).resize(function() {
		if ($(window).width() > 960) {
			$(".nav-toggle").removeClass("active");
			$(".mobile-menu").hide();
		}
	});
	
	// Toggle post-meta
	$(".post-meta-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$('.post-meta').toggleClass("active");
		$(".post-meta-inner").slideToggle();
		return false;
	});
	
	
	// Load Flexslider
    $(".flexslider").flexslider({
        animation: "slide",
        controlNav: false,
        prevText: "",
        nextText: "",
        smoothHeight: true   
    });
    
    
    // Post meta tabs
    $('.tab-selector a').click(function() {
    	$('.tab-selector a').removeClass('active');
		$('.post-meta-tabs .tab').hide(); 
		return false;
    });
    
    $('.tab-selector .tab-comments').click(function() {
    	$(this).addClass('active');
		$('.post-meta-tabs .tab-comments').show(); 
    });
    
    $('.tab-selector .tab-post-meta').click(function() {
    	$(this).addClass('active');
		$('.post-meta-tabs .tab-post-meta').show(); 
    });
    
    $('.tab-selector .tab-author-meta').click(function() {
    	$(this).addClass('active');
		$('.post-meta-tabs .tab-author-meta').show(); 
    });
	
	
	// Resize videos after container
	var vidSelector = "iframe, object, video";	
	var resizeVideo = function(sSel) {
		$( sSel ).each(function() {
			var $video = $(this),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( !$video.attr("data-origwidth") ) {
				$video.attr("data-origwidth", $video.attr("width"));
				$video.attr("data-origheight", $video.attr("height"));
			}

			var ratio = iTargetWidth / $video.attr("data-origwidth");

			$video.css("width", iTargetWidth + "px");
			$video.css("height", ( $video.attr("data-origheight") * ratio ) + "px");
		});
	};

	resizeVideo(vidSelector);

	$(window).resize(function() {
		resizeVideo(vidSelector);
	});
	
	
});

// After Jetpack Infinite Scroll posts have loaded
( function( $ ) {
	$( document.body ).on( 'post-load', function () {
		
		// Run Flexslider
		$(".flexslider").flexslider({
		    animation: "slide",
		    controlNav: false,
		    prevText: "",
		    nextText: "",
		    smoothHeight: true   
		});
		
	} );
} )( jQuery );