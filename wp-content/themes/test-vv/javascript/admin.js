(function($) {
	
	var i_max_number_of_repeater_fields = 30;
	
	$( document ).ready( function() {
						
		$( '.agx_link_selector_check' ).change( function() {
			
			if ( $( this ).prop( 'checked' ) ) {
				
				// input tonen
				$( this ).parent().find( '.agx_link_selector_select' ).hide();
				$( this ).parent().find( '.agx_link_selector_input' ).show();
				
			} else {
				
				// selectbox tonen
				$( this ).parent().find( '.agx_link_selector_select' ).show();
				$( this ).parent().find( '.agx_link_selector_input' ).hide();
				
			}
				
			// selectbox deselecteren
			$( this ).parent().find( '.agx_link_selector_select' ).val( '' );
			// input leegmaken
			$( this ).parent().find( '.agx_link_selector_input' ).val( '' );
			
			// value leegmaken
			$( this ).parent().find( '.agx_link_selector_value' ).val( '' );
			
		} );
		
		$( '.agx_link_selector_select' ).change( function() {
			
			$( this ).parent().find( '.agx_link_selector_value' ).val( $( this ).find( ':selected' ).val() );
			
		} );
		
		$( '.agx_link_selector_input' ).change( function() {
			
			$( this ).parent().find( '.agx_link_selector_value' ).val( $( this ).val() );
			
		} );
		
		// repeater table
		// add button verbergen als maximum bereikt is
		$( '.repeater' ).each( function( index ) {
			
			if ( $( this ).find( '.repeater_row:hidden' ).length == 0 ) {
				$( this ).find( '.repeater_add' ).hide();
			}
			
		} );
		
		$( '.repeater_add' ).click( function() {
			
			// volgende onzichtbare data rij tonen
			b_found = false;
			$( this ).closest( '.repeater' ).find( '.repeater_row' ).each( function( index ) {
				if ( $( this ).css( 'display' ) == 'none' && !b_found ) {
					$(this).css( 'display', 'table-row' );
					b_found = true;
				}
			} );
			
			// add button verbergen als maximum bereikt is
			if ( $(this).closest( '.repeater' ).find( '.repeater_row:hidden' ).length == 0 ) {
				$( this ).hide();
			}
			
		} );
		
	} );
	
})(jQuery);