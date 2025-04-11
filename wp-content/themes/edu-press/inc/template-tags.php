<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */

/**
 * author meta
 *
 * @return void
 */
function thim_entry_meta_author() {
	echo thim_get_entry_meta_author();
}

/**
 * Get author meta
 *
 * @return string
 */
function thim_get_entry_meta_author()
{
	$html = '<span class="author"> <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M7.49805 3.65624e-06C6.46013 -0.00131933 5.45668 0.356433 4.67257 1.00735C3.88847 1.65826 3.37654 2.55848 3.23112 3.54214C3.08569 4.5258 3.31656 5.52663 3.88119 6.36023C4.44581 7.19383 5.30616 7.80403 6.30371 8.07841C4.88617 8.24318 3.67047 8.72273 2.75394 9.5875C1.58809 10.6864 0.998047 12.3239 0.998047 14.4602C0.998047 14.6034 1.05746 14.7407 1.16322 14.8419C1.26897 14.9431 1.41241 15 1.56197 15C1.71154 15 1.85497 14.9431 1.96073 14.8419C2.06649 14.7407 2.1259 14.6034 2.1259 14.4602C2.1259 12.5057 2.66371 11.1875 3.54581 10.3557C4.4291 9.52273 5.74928 9.09091 7.49805 9.09091C9.24681 9.09091 10.567 9.52273 11.4515 10.3557C12.3324 11.1886 12.8702 12.5057 12.8702 14.4602C12.8702 14.6034 12.9296 14.7407 13.0354 14.8419C13.1411 14.9431 13.2846 15 13.4341 15C13.5837 15 13.7271 14.9431 13.8329 14.8419C13.9386 14.7407 13.998 14.6034 13.998 14.4602C13.998 12.3239 13.408 10.6875 12.241 9.5875C11.3268 8.72387 10.1099 8.24318 8.69238 8.07841C9.6866 7.80095 10.543 7.18981 11.1047 6.35701C11.6664 5.52422 11.8957 4.52556 11.7506 3.54408C11.6055 2.56261 11.0957 1.66406 10.3147 1.01314C9.53363 0.362218 8.53366 0.00253038 7.49805 3.65624e-06ZM4.32225 4.11932C4.32225 3.31312 4.65684 2.53995 5.25242 1.96988C5.848 1.39981 6.65577 1.07955 7.49805 1.07955C8.34032 1.07955 9.1481 1.39981 9.74368 1.96988C10.3393 2.53995 10.6738 3.31312 10.6738 4.11932C10.6738 4.92552 10.3393 5.6987 9.74368 6.26876C9.1481 6.83883 8.34032 7.15909 7.49805 7.15909C6.65577 7.15909 5.848 6.83883 5.25242 6.26876C4.65684 5.6987 4.32225 4.92552 4.32225 4.11932Z" fill="#FF782D"/>
			</svg>';
	$html .= esc_html__('by ', 'edu-press' ) . sprintf('<a href="%1$s" rel="author">%2$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())) . '';
	$html .= '</span>';

	return $html;
}

/**
 * date meta
 *
 * @return void
 */
function thim_entry_meta_date()
{
	echo thim_get_entry_meta_date();
}


/**
 * Get date meta
 *
 * @return string
 */
function thim_get_entry_meta_date()
{
	$html = '<span class="entry-date"> <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1.14916 4.75235H16.0094M2.87617 1H14.1332C14.6308 1 15.108 1.19767 15.4599 1.54952C15.8117 1.90137 16.0094 2.37858 16.0094 2.87617V14.1238C16.0094 14.6214 15.8117 15.0986 15.4599 15.4505C15.108 15.8023 14.6308 16 14.1332 16H2.87617C2.37858 16 1.90137 15.8023 1.54952 15.4505C1.19767 15.0986 1 14.6214 1 14.1238V2.87617C1 2.37858 1.19767 1.90137 1.54952 1.54952C1.90137 1.19767 2.37858 1 2.87617 1V1Z" stroke="#FF782D" stroke-linecap="round" stroke-linejoin="round"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M5.04927 10.9949V9.98272H5.87478C6.50143 9.98272 6.92732 9.61218 6.92732 9.0709C6.92732 8.57653 6.53801 8.2013 5.89261 8.2013C5.22375 8.2013 4.81193 8.54464 4.76597 9.13563H3.48642C3.53426 7.91706 4.47234 7.09717 5.96109 7.09717C7.42732 7.09717 8.24251 7.90767 8.23782 8.87484C8.23313 9.67597 7.72938 10.2032 7.01925 10.3767V10.464C7.93951 10.5962 8.49861 11.1825 8.49861 12.0671C8.49861 13.2257 7.40855 14.0465 5.91512 14.0465C4.42169 14.0465 3.4048 13.2294 3.3457 11.979H4.66934C4.71062 12.5381 5.18717 12.8955 5.8973 12.8955C6.59805 12.8955 7.08867 12.5146 7.08867 11.9424C7.08867 11.3561 6.62994 10.9949 5.88792 10.9949H5.04927ZM11.3344 13.8767V8.61312H11.2528L9.63088 9.73131V8.44426L11.3391 7.26696H12.7181V13.8767H11.3344Z" fill="#FF782D"/>
			</svg> ' . get_the_date('M d, Y') . '</span>';

	return $html;
}

/**
 * Get category meta
 *
 * @return string
 */
function thim_get_entry_meta_category() {
	if ( is_single() ) {
		$html       = '<span class="meta-category">';
		$html       .= '<span>' . esc_html__( 'Categories: ', 'edu-press' ) . '</span>';
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$html .= '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
		}
		$html .= '</span>';

		return $html;
	}
}

function thim_entry_meta_tags() {
	echo thim_get_entry_meta_tags();
}

function thim_get_entry_meta_tags() {
	$tags_list = get_the_tag_list( '', ' ' );
	if ( $tags_list ) {
		return sprintf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'edu-press' ) . '</span>', $tags_list ); // WPCS: XSS OK.
	}

	return '';
}

/**
 * comment number
 *
 * @return void
 */
function thim_entry_meta_comment_number() {
	if ( comments_open() ) { ?>
		<span class="comment-total"><i aria-hidden="true" class="tk tk-comment"></i>
			<?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', 'Comments are off for this post' ); ?>
		</span>
		<?php
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @return string HTML for meta tags
 */
if ( ! function_exists( 'thim_entry_meta' ) ) :
	function thim_entry_meta( $custom_meta_tag = array() ) {
		// custom show meta tag
 		if ( isset( $custom_meta_tag ) && $custom_meta_tag ) {
			$meta_tags = $custom_meta_tag;
		} else {
			$meta_tags = get_theme_mod( 'group_meta_tags' );
		}

		if ( isset( $meta_tags ) && $meta_tags ) {
			echo '<div class="entry-meta">';
			do_action( 'before-entry-meta' );

			foreach ( $meta_tags as $meta_tag ) {
				switch ( $meta_tag ) {
					case 'author':
						echo thim_get_entry_meta_author();
						break;
					case 'date':
						echo thim_get_entry_meta_date();
						break;
					case 'category':
						echo thim_get_entry_meta_category();
						break;
					case 'comment_number':
						thim_entry_meta_comment_number();
						break;
					case 'tag':
						echo thim_get_entry_meta_tags();
						break;
				}
			}

			do_action( 'after-entry-meta' );

			echo '</div>';
		}else {
			echo '<div class="entry-meta">';
			do_action( 'before-entry-meta' );

			echo thim_get_entry_meta_author();
			echo thim_get_entry_meta_date();
			echo thim_entry_meta_comment_number();

			do_action( 'after-entry-meta' );

			echo '</div>';
		}

	}
endif;

/**
 * Get pagination
 *
 * @return string
 */

if ( ! function_exists( 'thim_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function thim_paging_nav() {
		global $wp_query;

		$total = $total ?? $wp_query->max_num_pages;
		$paged = $paged ?? get_query_var( 'paged' );
		$base  = $base ?? esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) );

		if ( $total <= 1 ) {
			return;
		}

		// Set up paginated links.
		$links = paginate_links(
			apply_filters(
				'theme_pagination_args',
				array(
					'base'      => $base,
					'format'    => '',
					'add_args'  => '',
					'current'   => max( 1, $paged ),
					'total'     => $total,
					'prev_text' => esc_html__( '<', 'edu-press' ),
					'next_text' => esc_html__( '>', 'edu-press' ),
					'type'      => 'list',
					'end_size'  => 3,
					'mid_size'  => 3,
				)
			)
		);

		if ( $links ) :
			echo '<div class="pagination loop-pagination">' . $links . '</div>';
		endif;
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function thim_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'thim_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'thim_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so thim_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so thim_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in thim_categorized_blog.
 *
 * @return bool
 */
if ( ! function_exists( 'thim_category_transient_flusher' ) ) {
	function thim_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'thim_categories' );
	}
}
add_action( 'edit_category', 'thim_category_transient_flusher' );
add_action( 'save_post', 'thim_category_transient_flusher' );


/**
 * Show list comments
 *
 * @return string
 */
if ( ! function_exists( 'thim_comment' ) ) {
	function thim_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p><?php esc_html_e( 'Pingback:', 'edu-press' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_attr__( 'Edit', 'edu-press' ), '<span class="edit-link">', '</span>' ); ?></p>
				</li>
				<?php
				break;
			default :
				?>
				<li <?php comment_class( 'description_comment' ) ?> id="comment-<?php comment_ID() ?>">
				<div class="wrapper-comment">
					<?php
					if ( $args['avatar_size'] != 0 ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
					<div class="comment-right">
						<?php if ( $comment->comment_approved == '0' ): ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'edu-press' ) ?></em>
						<?php endif; ?>

						<div class="comment-extra-info">
							<div
								class="author"><?php printf( '<span class="author-name">%s</span>', get_comment_author_link() ) ?>
							</div>
							<div class="date">
								<?php printf( get_comment_date(), get_comment_time() ) ?>
							</div>

						</div>

						<div class="content-comment">
							<?php comment_text() ?>
						</div>

						<p class="reply-cmt"><i class="tk tk-reply"></i><?php comment_reply_link(
								array_merge( $args, array(
										'add_below' => 'div-comment',
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
									)
								)
							) ?>
						</p>

					</div>
				</div>
				<?php
				break;
		endswitch;
	}
}

if ( ! function_exists( 'thim_post_nav' ) ) :

	function thim_post_nav() {
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		?>
		<?php if ( ! empty( $prev_post ) || ! empty( $next_post ) ) : ?>
			<div class="entry-navigation-post">
				<?php
				if ( ! empty( $prev_post ) ) :
					?>
					<div class="prev-post">
						<a href="<?php echo get_permalink( $prev_post->ID ); ?>">
							<span class="heading"><?php echo esc_html__( 'Previous Article','edu-press' ); ?></span>
							<span class="post-title"><?php echo esc_html( $prev_post->post_title ); ?></span>
						</a>
					</div>

				<?php endif; ?>

				<?php
				if ( ! empty( $next_post ) ) :
					?>
					<div class="next-post">
						<a href="<?php echo get_permalink( $next_post->ID ); ?>">
							<span class="heading"><?php echo esc_html__( 'Next Article','edu-press' ); ?></span>
							<span class="post-title"><?php echo esc_html( $next_post->post_title ); ?></span>
						</a>
					</div>

				<?php endif; ?>
			</div>
		<?php
		endif;
	}

endif;

// action footer blog
add_action( 'thim_post_footer', 'thim_post_nav', 15 );

if ( get_theme_mod( 'thim_archive_single_related_post', true ) ) :
	add_action( 'thim_post_footer', 'thim_single_post_related', 25 );
endif;

if ( ! function_exists( 'thim_single_post_related' ) ) {
	function thim_single_post_related() {
		get_template_part( 'templates/template-parts/related-single' );
	}
}

/**
 * Get related posts
 *
 * @return WP_Query
 */
function thim_get_related_posts() {
	global $post;
	$number_posts  = (int) get_theme_mod( 'thim_archive_single_related_post_number', 3 );
	$tags          = wp_get_post_tags( $post->ID );
	$related_query = new WP_Query();

	if ( isset( $tags[0] ) ) {
		$first_tag = $tags[0]->term_id;

		$related_args  = array(
			'tag__in'             => array( $first_tag ),
			'post__not_in'        => array( $post->ID ),
			'posts_per_page'      => $number_posts,
			'ignore_sticky_posts' => 1
		);
		$related_query = new WP_Query( $related_args );
	}

	return $related_query;
}

/**
 * Get related columns class
 *
 * @param string $class
 *
 * @return string
 */
function thim_get_related_columns_class( $class = '' ) {
	return $class . ' col-lg-' . ( 12 / get_theme_mod( 'thim_archive_single_related_post_column', 3 ) );
}

/**
 * Get about the author
 *
 * @return string
 */
if ( ! function_exists( 'thim_about_author' ) ) {
	function thim_about_author() {
		$user = new WP_User( get_the_author_meta( 'ID' ) );
		$link = get_author_posts_url( get_the_author_meta( 'ID' ) );
		?>
		<div class="thim-about-author">
			<div class="author-wrapper">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
					<div class="author-top">
						<a class="name" href="<?php echo esc_url( $link ); ?>"> <?php echo get_the_author(); ?> </a>
						<?php if ( ! empty( $user->roles ) ) {
							echo '<div class="role">' . esc_html( $user->roles[0] ) . '</div>';
						} ?>
					</div>
				</div>
				<div class="author-bio">
					<div class="author-description">
						<?php echo get_the_author_meta( 'description' ); ?>
					</div>

				</div>
			</div>
		</div>
	<?php }
}

add_action( 'thim_about_author', 'thim_about_author' );
