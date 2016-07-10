
(function($) {
		
	$( document ).ready( function() {
		
		/* VIEWPORT FIXES (http://timkadlec.com/2013/01/windows-phone-8-and-device-width/) */
		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
		  var msViewportStyle = document.createElement('style');
		  msViewportStyle.appendChild(
		    document.createTextNode(
		      '@-ms-viewport{width:auto!important}'
		    )
		  );
		  document.querySelector('head').appendChild(msViewportStyle);
		}
                
                // Homepage Pages Blocks Set Equal Height Logic
                
                $(".equalHeight").equalColumns({
                    subItems : $(".wysiwyg_content")
                });
                
                // Homepage Blog Blocks Set Equal Height Logic
//		$(".cz-blog-item-content-wrapper").equalColumns({
//                    subItems : $("h5")
//                });
	} );
			
})(jQuery);