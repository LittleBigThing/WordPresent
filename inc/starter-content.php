<?php
/**
 * Starter content example:
 * Csaba Varszegi's presentation at WordCamp Antwerp on March 3, 2018
 *
 * @package WordPresent
 */

/**
 * Add support for starter content and add content
 */
function wordpresent_starter_content() {
	
	add_theme_support( 'starter-content', array(
		// add options to set up the presentation on the front page
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{presentation}}',
		),
		// add the required page for the presentation
		'posts' => array(
			'presentation' => array(
				'post_type' => 'page',
				'post_title' => _x( 'Benefit from the WordPress Customizer', 'Theme starter content', 'wordpresent' ),
				'post_content' => join( '', array(
					'<p>Csaba Varszegi<br>',
					_x( 'WordCamp Antwerp - March 3, 2018', 'Theme starter content', 'wordpresent' ) . '</p>'
				) ),
				'template' => 'page-templates/presentation-template.php',
			),
		),
		// add presentation slides and some instructions as widgets to widget area 'slides'
		'widgets' => array(
			'slides' => array(
				'slide-1' => array( 'text', array(
					'title' => _x( 'I am Csaba', 'Theme starter content', 'wordpresent' ),
					'text' => join( '', array(
						'<ul>',
						'<li>' . _x( 'Father &amp; husband', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( 'Frontend developer', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( 'WordPress &amp; JavaScript fan', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( 'Guitar player &amp; music lover', 'Theme starter content', 'wordpresent' ) . '</li>',
						'</ul>'
					) ),
				) ),
				'slide-2' => array( 'text', array(
					'title' => _x( 'Customization in the WP Customizer', 'Theme starter content', 'wordpresent' ),
					'text' => join( '', array(
						'<blockquote>' . _x( '&lsquo;A <strong>previewable</strong> modification made to a WordPress site to suit the intent of the site, the preferences of the site owner or the task of the visitor.&rsquo;', 'Theme starter content', 'wordpresent' ) . '</blockquote>'
					) ),
				) ),
				'slide-3' => array( 'text', array(
					'title' => _x( 'Benefits of the Customizer', 'Theme starter content', 'wordpresent' ),
					'text' => join( '', array(
						'<ul>',
						'<li>' . _x( '<strong>Site owner/user</strong>: preview changes (UX), controlled creative freedom, uniqueness, ...', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( '<strong>Designer/Developer</strong>: standard implementation, additional value, a selling point or premium option: (the idea of) having control/options', 'Theme starter content', 'wordpresent' ) . '</li>',
						'</ul>'
					) ),
				) ),
				'slide-4' => array( 'text', array(
					'title' => _x( 'But remember the WordPress philosophy', 'Theme starter content', 'wordpresent' ),
					'text' => join( '', array(
						'<ul>',
						'<li>' . _x( 'Decisions, not Options', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( '(It should function) Out of the Box', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( 'Striving for Simplicity', 'Theme starter content', 'wordpresent' ) . '</li>',
						'</ul',
					) ),
				) ),
				'slide-5' => array( 'text', array(
					'title' => _x( 'Ready to go?', 'Theme starter content', 'wordpresent' ),
					'text' => join( '', array(
						'<ul>',
						'<li>' . _x( 'Change the widget title/content or add your own widgets to create your own presentation', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( 'You can drag widgets in the Customizer control pane to rearrange them', 'Theme starter content', 'wordpresent' ) . '</li>',
						'<li>' . _x( 'You can also use other widget types', 'Theme starter content', 'wordpresent' ) . '</li>',
						'</ul',
					) ),
				) ),
				'slide-6' => array( 'text', array(
					'title' => _x( 'Good luck and enjoy!', 'Theme starter content', 'wordpresent' ),
					'text' => join( '', array(
						'<ul>',
						'<li>' . _x( 'Cheers, Csaba!', 'Theme starter content', 'wordpresent' ) . '</li>',
						'</ul',
					) ),
				) ),
			),
		),
	) );
}
add_action( 'after_setup_theme', 'wordpresent_starter_content' );