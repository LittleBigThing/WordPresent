/**
 * File customize-preview.js.
 *
 * Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	// Collect information from customize-controls.js about which control is opening
	wp.customize.bind( 'preview-ready', function() {
		wp.customize.preview.bind( 'widgetsData', function( data ) {
			
			// If a widget control is clicked, scroll down to the related widget content
			if ( true === data.expanded ) {
				$.scrollTo( $( '#' + data.widgetID ), {
					duration: 500,
					offset: { 'top': 0 }
				} );
			}
		} );
	} );

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	// Custom logo position.
	wp.customize( 'logo_position', function( value ) {
		value.bind( function( to ) {
			// Update body class to adjust logo position
			if ( 'left' === to ) {
				$( 'body' ).addClass( 'logo-left' );
				$( 'body' ).removeClass( 'logo-right' );
			} else if ( 'right' === to ) {
				$( 'body' ).addClass( 'logo-right' );
				$( 'body' ).removeClass( 'logo-left' );
			} else {
				$( 'body' ).removeClass( 'logo-left' );
				$( 'body' ).removeClass( 'logo-right' );
			}
		});
	});
	
	// Custom logo position.
	wp.customize( 'logo_size', function( value ) {
		value.bind( function( to ) {
			// Update size setting to logo
			$( '.wp-custom-logo .custom-logo' ).css( {
				'width': ( 48 * to ) / 10 + 'px'
			} );
		});
	});
	
	// Light text color.
	wp.customize( 'light_text_color', function( value ) {
		value.bind( function( to ) {
			// Update body class to adjust text color
			if ( to ) {
				$( 'body' ).addClass( 'light-text' );
			} else {
				$( 'body' ).removeClass( 'light-text' );
			}
		});
	});
	
	// Link color.
	wp.customize( 'link_color_hue', function( value ) {
		value.bind( function( to ) {
			
			$( '.site-content a' ).css( {
				color: 'hsl(' + to + ', 50%, 50%)'
			} );
		} );
	} );
	
	var customBackground;
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			// get the custom background color
			customBackground = to ? to : '#ffffff' ;
		} );
	} );
	
	// Background gradient
	wp.customize( 'background_gradient_color', function( value ) {
		value.bind( function( to ) {
			// Update body class to adjust text color
			if ( '#ffffff' !== to ) {
				$( 'body' ).addClass( 'background-gradient' );
				$( 'body' ).css( {
					'background-image': 'linear-gradient(90deg, ' + customBackground + ', ' + to + ')'
				} );
			} else {
				$( 'body' ).removeClass( 'background-gradient' );
			}
		} );
	} );
	
	// overlay for custom backgroud
	wp.customize( 'overlay', function( value ) {
		value.bind( function( to ) {
			$( '.custom-background .background-overlay' ).css( {
				'background-color': 'rgba(0,0,0,' + to / 10 + ')'
			} );
		});
	});
	
} )( jQuery );
