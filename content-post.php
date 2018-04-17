<?php
	/* If we have a featured image... */			
	$post_thumb_id = get_post_thumbnail_id();	
	$post_thumb_src = wp_get_attachment_image_src( $post_thumb_id , 'medium'); 
	$post_thumb_meta = wp_get_attachment_metadata( $post_thumb_id );
	if ( $post_thumb_meta ){
		$post_thumb_width = $post_thumb_meta['width'];
		$post_thumb_height = $post_thumb_meta['height'];
		$post_thumb_aspect = ( round( $post_thumb_height / $post_thumb_width , 4 ) ) * 100;
	}
	$show_author_name = get_option('post_show_author');
	$show_categories = get_option('post_show_categories');
	$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 24, 'mm', get_the_author_meta('display_name') );
?>
<article id="post-<?php echo $post_count; ?>" class="post post-type-post mobile-margin-bottom-huge <?php if ( !$post_thumb_src ){ echo 'post-no-thumb'; } ?>">
		<div class="post-thumbnail">
			<div class="lazy-image-wrapper" <?php if ( $post_thumb_aspect ) { ?>style="padding-bottom:<?php echo $post_thumb_aspect; ?>%"<?php } ?>>
				<?php if ( $post_thumb_src ) { ?>
					<a class="" href="<?php the_permalink(); ?>">	
				<img data-src="<?php echo $post_thumb_src[0]; ?>" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" height="<?php echo $post_thumb_height; ?>" width="<?php echo $post_thumb_width; ?>"/></a>
				<noscript>
					<?php the_post_thumbnail(); ?>
				</noscript>
				<?php } ?>
				<div class="clear"></div>
			</div>
		</div>
		<a class="post-link area-link" href="<?php the_permalink(); ?>">
			<div class="post-text">
				<div class="post-meta meta margin-bottom-normal">
					<span class="post-time"><?php echo (get_the_date() ); ?></span>
				</div>
				<header class="post-header margin-bottom-normal">
					<h3 class="post-title graph title5 area-link-hover"><?php the_title(); ?></h3>
				</header>
				<div class="post-excerpt margin-bottom-normal  area-link-hover">
					<p><?php echo get_the_excerpt(); ?></p>
				</div>
				<footer class="post-footer">
					<?php if ( $show_author_name ): ?>
					<div class="post-author text-small margin-bottom-normal">
						<?php if ( $author_avatar): ?>
						<span class="post-author-img">
							<?php echo $author_avatar; ?>
						</span>
						<?php endif; ?>
						<span class="post-author-name opacity-50"><?php the_author(); ?></span>
					</div>
					<?php endif; ?>
					<?php if ( $show_categories ): ?>
					<div class="post-categories text-small2 opacity-50">
						<p><?php
							foreach((get_the_category()) as $category) { 
								if ( $category->slug !== 'uncategorized' ) {
									$output = '<a class="cat-link text-underline-none bg-ltgray text-highlight cat-'. $category->slug .'" href="'. get_category_link( $category->term_id ) .'" title="'. $category->description .'">'. $category->name .'</a>&nbsp; ';
									echo $output;	
								}
							} 
						?></p>
					</div>
					<?php endif; ?>
				</footer>
			</div>
		</a>		
	<div class="clear"></div>
</article>
