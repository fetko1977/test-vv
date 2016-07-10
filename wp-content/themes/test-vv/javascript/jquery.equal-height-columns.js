/* 
 * A plugin to match column height of a certain amount of columns
 * 
 * TODO:
 * -------
 * - Only works with bootstrap
 * - Add 'multiple' functionality (e.g. a column exists of an image and text / iframe)
 * 
 * Author: Sven Houthoofd <sven@agx.eu>
 * Copyright: AGX - http://www.agx.eu
 * 
 */
(function($) {
    $.fn.equalColumns = function( options ) {
        // TODO: provide option to crop image left/middle/right
	var settings = $.extend ({
		// defaults
		cropImage: 'left',
		image: this.find('> .image img'),
		indexes: false,
		columns: this.find('> *'),
		testDivClass: 'hidden-xs',
		iframeHeight: 400,
		subItems: false,
		fadeIn: true,
		imagesLoaded: true
	}, options );

	var t = this;
	var image = settings.image;
	var columns = settings.columns;
	var testDivClass = ' ' + settings.testDivClass;
	var cropImage = settings.cropImage;
	var iframeHeight = settings.iframeHeight;
	var subItems = settings.subItems;
	var fadeIn = settings.fadeIn;
	var imagesLoaded = settings.imagesLoaded;
	
	// add testDiv to check the screen size (test on .is(:visible))
	$('body').append('<div class="equalTest' + testDivClass + '" style="height: 1px; width: 1px; visibility: hidden"></div>');
	
	var equalTest = $('.equalTest');
	
	// first: hide the columns on page load
	if (equalTest.is(':visible')) {
		columns.css('visibility', 'hidden');
	}
	
	if ( imagesLoaded ) {
		if ( document.querySelectorAll ) {
		   $( '.page' ).imagesLoaded().always( function( instance ) {
		    build();
		   } );
		  } else {
		   // fallback voor lte7
		   build();
	    }
	} else {
		build();
	}
	

	function build() {
		if ($(equalTest).is(':visible')) {
			if (image) {
				imageDim(
					image,
					columns,
					cropImage
				);
			}
			
			makeEqual(
				image,
				columns,
				cropImage,
				iframeHeight,
				subItems,
				fadeIn
			);
		}
		
		var mobile = false;
		
		// detect window resize and make columns the same height
		$(window).resize(function() {
			if ($(equalTest).is(':visible')) {
				if (image) {
					imageDim(
						image,
						columns,
						cropImage
					);
				}
				
				makeEqual(
					image,
					columns,
					cropImage,
					iframeHeight,
					subItems,
					false
				);
				mobile = false;
				
			} else {
				if (!mobile) {
					resetColumns(
						image,
						columns,
						iframeHeight,
						subItems
					);
				}
				
				mobile = true;
			}
		});
	}
};

    /*
     * TODO
     */
    function makeEqual(image, columns, cropImage, iframeHeight, subItems, fadeIn) {
	
	if (!fadeIn) {
		columns.css('visibility', 'visible');
	}
	
	columns.css('height', 'auto');
	
	// if subitems are present, make them the same height
	if (subItems !== false) {
                var height = getSubItemHeight(subItems);
		subItems.css('height', height);
	}
	
	// if an iframe is present, reset it
	if (columns.find('iframe')) {
		columns.find('iframe').height(iframeHeight);
	}
	
	var textHeight = getTextHeight(columns);
	
	// variable so the check below doen't need to be done twice
	var scale = textHeight;
	
	if (columns.hasClass('multiple')) {
		// TODO: add multiple functionality
		
		console.log(columns);
		columns.css('height', textHeight);
	} else {
		if (image) {
			var imgHeight = image.height();
	
			if (imgHeight > textHeight) {
				columns.css('height', imgHeight);
				scale = imgHeight;
			} else {
				image.css('height', textHeight);
				image.css('width', 'auto');
				
				columns.css('height', textHeight);
				
				var updatedWidth = image.width();
				var columnWidth = image.parent().width();
				
				switch(cropImage) {
					case 'center':
						image.css('margin-left', '-' + ((updatedWidth - columnWidth) / 2) + 'px');
						break;
					case 'right':
						image.css('margin-left', '-' + (updatedWidth - columnWidth) + 'px');
						break;
					break;
				}
			}
		} else {
			columns.css('height', textHeight);
		}
		
		// if an iframe is present, rescale it
		if (columns.find('iframe')) {
			columns.find('iframe').height(scale);
		}
		
		
		if (fadeIn) {
			// show the columns with a little animation
			columns.css('visibility', 'visible');
			columns.css('display', 'none');
			columns.fadeIn("slow");
		}
	}
}

    /*
     * Calculate the highest column value
     */
    function getTextHeight(columns) {
	var textHeight = 0;
	
	// compare the text/iframe column height and set the largest as textHeight
	columns.each( function(k, el) {
		if (!columns.eq(k).parent().hasClass('image')) {
			var h = columns.eq(k).outerHeight();
			if (h > textHeight) {
				textHeight = h;
			}
		}	
	});
	
	return textHeight;
}

    /*
     * Calculate the highest subItem value
     */
    function getSubItemHeight(subItems) {
            var subHeight = 0;

            // compare the text/iframe column height and set the largest as textHeight
            subItems.each( function(k, el) {
                    var h = subItems.eq(k).outerHeight();
                    if (h > subHeight) {
                            subHeight = h;
                    }
            });

            return subHeight;
    }

    /*
     * Function that calculates the ideal dimensions for the image
     */
    function imageDim(image, columns) {
            // reset margin left of image
            image.css('margin-left', '0');
            image.parent().css('overflow', 'hidden');

            var fullWidth = image.parent().width();

            var imgWidth = image.width();

            if (imgWidth < fullWidth) {
                    image.css('width', '100%');
                    image.css('height', 'auto');

            } else {
                    var orWidth = image.attr('width');
                    var orHeight = image.attr('height');

                    if (fullWidth > orWidth) {
                            image.css('width', '100%');
                            image.css('height', 'auto');
                    } else {
                            var textHeight = getTextHeight( columns );

                            if (textHeight > orHeight) {
                                    image.css('width', 'auto');
                                    image.css('height', '100%');
                            } else {
                                    image.css('width', '100%');
                                    image.css('height', 'auto');
                            }

                    }
            }
    }

    /*
     * Function to reset all elements when the column no longer need 
     * to have the same height (e.g. on mobile devices)
     */
    function resetColumns(image, columns, iframeHeight, subItems) {
            if (image) {
                    // reset margin left of image
                    image.css('margin-left', '0');

                    // set image to width 100%, height does not matter anymore
                    image.css('width', '100%');
                    image.css('height', 'auto');
            }

            columns.css('height', 'auto');

            if (subItems !== false) {
                    subItems.css('height', 'auto');
            }


            // if an iframe is present, reset it
            if (columns.find('iframe')) {
                    columns.find('iframe').height(iframeHeight);
            }

    }
})(jQuery);
