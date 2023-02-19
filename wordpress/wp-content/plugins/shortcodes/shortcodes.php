<?php
/*
 * Plugin Name:       short-codes
 * Text Domain:       shortcode
 * Domain Path:       /languages
 */



function wporg_shortcode( $atts = [], $content = null, $tag = '' ) {
	// normalize attribute keys, lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );

	// override default attributes with user attributes
	$wporg_atts = shortcode_atts(
		array(
			'title' => 'WordPress.org',
		),
		$atts,
		$tag
	);

	// start box
	$o = '<div class="wporg-box">';

	// title
	$o .= '<h2>' . esc_html( $wporg_atts['title'] ) . '</h2>';

	// enclosing tags
	if ( ! is_null( $content ) ) {
		// $content here holds everything in between the opening and the closing tags of your shortcode. eg.g [my-shortcode]content[/my-shortcode].
		// Depending on what your shortcode supports, you will parse and append the content to your output in different ways.
		// In this example, we just secure output by executing the_content filter hook on $content.
		$o .= apply_filters( 'the_content', $content );
	}

	// end box
	$o .= '</div>';

	// return output
	return $o;
}

/**
 * Central location to create all shortcodes.
 */
function wporg_shortcodes_init() {
	add_shortcode( 'wporg', 'wporg_shortcode' );
}

// space is the problem [] space na rakhe yaha
add_shortcode(
	'kitten',
	function ($a) {
		// Combine default attributes with inputted attributes.
		// e.g., [kitten width="1200" height="1200"]
		$a = shortcode_atts(
			[ 
				'width'  => 500,
				'height' => 500,
				'src'    => 'https://placekitten.com/'
			],
			$a
		);
		ob_start();
		?>
	<style>
		.my-image {
			display: block;
			margin: 0 auto;
			width:
				<?php echo esc_attr( $a['width'] );
					?>
			;
			height:
				<?php echo esc_attr( $a['height'] );
					?>
			;
		}

	</style>
	<img class="my-image" src="<?php echo sanitize_url( $a['src'] ); ?>" />
	<?php
		return ob_get_clean();
	}
);


// add_action(
//     'template_redirect',
//     function () {
//         echo do_shortcode('[kitten]');
//     }
// );


// add_{$meta_type}_metadata


add_action( 'init', 'wporg_shortcodes_init' );
