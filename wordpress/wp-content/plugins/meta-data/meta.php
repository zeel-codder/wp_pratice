<?php
/**
 * Plugin Name:       meta
 * Text Domain:       ml-plugin
 * Domain Path:       /languages
 */

function test_plugin() {

	$post = get_post();

	add_post_meta( $post->ID, 'ml-plugin-meta_5', 'zeel is best', true );
	// /* 
	//    Optional is runtime base not db base.
	//    This will only added if we don't have value with that meta ke
	// */
	// add_post_meta($post->ID, 'ml-plugin-meta_5', 'zeel is not best');
	// add_post_meta($post->ID, 'ml-plugin-meta_5', 'zeel is best but not smart');

	/*
	1. It wil map to key and value for update.
	2. Make sure update will update all meta if no value is pass. same for delete.
	*/

	update_post_meta( $post->ID, 'ml-plugin-meta_5', 'zeel is best but not smart update' );
	update_post_meta( $post->ID, 'ml-plugin-meta_5', 'zeel is best but not smart update1' );
	delete_post_meta( $post->ID, 'ml-plugin-meta_5', 'zeel is best but not smart update' );

	$data = get_post_meta( $post->ID, 'ml-plugin-meta_5' );
	print_obj( $data );
}


function print_obj( $obj ) {
	echo '<pre>';
	echo print_r( $obj );
	echo '</pre>';
}



// Meta Box
function demo_meta_box() {
}

function add_my_meta_box() {
	add_meta_box(
		'ml-plugin-meta-box',
		'Ml Name',
		'ml_html_box',
		'post',
		'side',
	);
}

function ml_html_box( $post ) {
	$value = get_post_meta( $post->ID, 'ml_meta_value', true );

	?>
	<div>
		<label for="wporg_field">Enter you meta name</label>
		<input type="name" name="my_ml_name" value="<?php echo $value ?>">
	</div>
<?php
}


function save_my_meta_box( $post_id ) {
	if ( array_key_exists( 'my_ml_name', $_POST ) ) {
		update_post_meta(
			$post_id,
			'ml_meta_value',
			$_POST['my_ml_name']
		);
	}
}

function update_title( $title, $post_id ) {
	$title_prefix = get_post_meta( $post_id, 'ml_meta_value', true );

	if ( $title_prefix ) {
		return $title_prefix . ' ' . $title;
	}
	return $title;
}


add_action( 'save_post', 'save_my_meta_box' );
add_action( 'add_meta_boxes', 'add_my_meta_box' );
add_filter( 'the_title', 'update_title', 10, 2 );
// add_action('template_redirect', 'test_plugin');
