/**
 * Scripts within the customizer controls window.
 *
 * Customizer enhancements for a better user experience.
 */

(function() {
	wp.customize.bind( 'ready', function() {
		
		// Only show the logo position and size controls when there's a custom logo.
		wp.customize( 'custom_logo', function( setting ) {
			wp.customize.control( 'logo_size', function( control ) {
				var visibility = function() {
					
					if ( '' != setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
			wp.customize.control( 'logo_position', function( control ) {
				var visibility = function() {
					
					if ( '' != setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});
		
		// Only show the overlay option if a background image is added
		wp.customize( 'background_image', function( setting ) {
			wp.customize.control( 'overlay', function( control ) {
				var visibility = function() {
					
					if ( '' != setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});
		
		// Detect when the widget is expanded (or closed) so the preview can be adjusted accordingly
		function scrollToWidget() {
			wp.customize.control.each( function( control ) {
				// only for widget controls (control id is 'widget_{type}_[{id}]')
				if ( -1 === control.id.indexOf( 'widget_' ) ) return;

				// return if a different sidebar widget area is managed
				if ( 'slides' !== control.params.sidebar_id ) return;

				var widgetId = control.params.widget_id;

				if ( widgetId ) {

					control.expanded.bind( function( isExpanding ) {
						// Value of isExpanding will = true if you're entering the control, false if you're leaving it.
						wp.customize.previewer.send( 'widgetsData', {
							expanded: isExpanding,
							widgetID: widgetId
						});
					} );
				}
			} );
		};
		scrollToWidget();
		
		// add the scrollToWidget function to newly added controls
		wp.customize.control.bind( 'add', scrollToWidget );
		
	} );
})( jQuery );
