<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Generate HTML for Home page
 * @return void
 */
function npt_add_new_page() {
	?>
	<div class = "npt-wrap" id = "poststuff">
		<div class = "postbox postbox-container" id = "postbox-container-2">
			<div class = "postbox-header ">
				<h2 class = "hndle ui-sortable-handle meta-box-header">Post Types</h2>
			</div>
			<div class = "settings">
				<div class = "registered-post-outer">
					<div class = "posts-registered">
						<h4><?php echo wp_count_posts( 'npt-post-type' )->publish; ?> <?php echo npt_text_plusing( 'Post Type', 'Post Types', 'npt-post-type' ); ?> Registered </h4>
						<?php echo npt_html( npt_have_post_text( 'Recently Published', 'npt-post-type' ), 'h5' ); ?>
					</div>
					<div class = "register-new">
						<a href = "<?php echo esc_url( admin_url( 'post-new.php?post_type=npt-post-type' ) ); ?>"><span class = "dashicons dashicons-plus-alt2"></span>Register New</a>
					</div>
				</div>
				<?php
				$args      = array(
					'numberposts' => 2,
					'post_type'   => 'npt-post-type'
				);
				$npt_posts = get_posts( $args );
				if ( $npt_posts ) {
					?>
					<ul class = "registered-ul">
						<?php foreach ( $npt_posts as $post ) { ?>
							<li>
								<a href = "<?php echo get_edit_post_link( $post->ID ); ?>"><?php echo esc_html($post->post_title); ?></a>
								<a href = "<?php echo get_edit_post_link( $post->ID ); ?>"><span class = "dashicons dashicons-edit-page"></span>Edit</a>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
				<div id = "major-publishing-actions">
					<div id = "publishing-action">
						<a href = "<?php echo esc_url( admin_url( 'edit.php?post_type=npt-post-type' ) ); ?>" class = "button button-primary button-large">View All</a>
					</div>
					<div class = "clear"></div>
				</div>
			</div>
		</div>
		<div class = "postbox postbox-container" id = "postbox-container-2">
			<div class = "postbox-header ">
				<h2 class = "hndle ui-sortable-handle meta-box-header">Taxonomies</h2>
			</div>
			<div class = "settings">
				<div class = "registered-post-outer">
					<div class = "posts-registered">
						<h4><?php echo wp_count_posts( 'npt-taxonomy' )->publish; ?> <?php echo npt_text_plusing( 'Taxonomy', 'Taxonomies', 'npt-taxonomy' ); ?> Registered</h4>
						<?php echo npt_html( npt_have_post_text( 'Recently Published', 'npt-taxonomy' ), 'h5' ); ?>
					</div>
					<div class = "register-new">
						<a href = "<?php echo esc_url( admin_url( 'post-new.php?post_type=npt-taxonomy' ) ); ?>"><span class = "dashicons dashicons-plus-alt2"></span>Register New</a>
					</div>
				</div>
				<?php
				$args         = array(
					'numberposts' => 2,
					'post_type'   => 'npt-taxonomy'
				);
				$npt_taxonomy = get_posts( $args );
				if ( $npt_taxonomy ) {
					?>
					<ul class = "registered-ul">
						<?php foreach ( $npt_taxonomy as $taxonomy ) { ?>
							<li>
								<a href = "<?php echo get_edit_post_link( $taxonomy->ID ); ?>"><?php echo esc_html($taxonomy->post_title); ?></a>
								<a href = "<?php echo get_edit_post_link( $taxonomy->ID ); ?>"><span class = "dashicons dashicons-edit-page"></span>Edit</a>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
				<div id = "major-publishing-actions">
					<div id = "publishing-action">
						<a href = "<?php echo esc_url( admin_url( 'edit.php?post_type=npt-taxonomy' ) ); ?>" class = "button button-primary button-large">View All</a>
					</div>
					<div class = "clear"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
}