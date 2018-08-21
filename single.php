<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
/* Adjust header type size based on title length */
	$title_char_count = strlen ( get_the_title() );
	$title_size = "title2";
	if ( $title_char_count < 25 ) {
		$title_size = "title1";
	} elseif ( $title_char_count > 70) {
		$title_size = "title3";
	}
// Text-on-image classes
	$text_on_image_classes = get_option('site_text_on_image_classes');
// Custom comments
	$custom_comments = stripslashes( get_option('tfcomments_code') );
// Post featured image
	$post_thumb_id = get_post_thumbnail_id();
	$post_thumb_small = wp_get_attachment_image_src( $post_thumb_id, 'page-background-mob');
	$post_thumb_medium = wp_get_attachment_image_src( $post_thumb_id, 'page-background-tablet');
	$post_thumb_large = wp_get_attachment_image_src( $post_thumb_id, 'page-background');
	if ( $post_thumb_id ){
		$thumb_img = get_post( $post_thumb_id ); // Get post by ID
		$bg_img_caption =  $thumb_img->post_excerpt; // Display Caption
	}
// Social share display options
	$show_vk = get_option('site_show_vk_share');
	$show_sina_weibo = get_option('site_show_sina_weibo_share');
	$show_fb = get_option('site_show_fb_share',true);
	$show_tw = get_option('site_show_tw_share');
// Set up default tweet text
	if (get_field("post_tw_text")){
		$tweet_text = get_field("post_tw_text");
	} else if (get_field("tweet_text")) {
		/* Support for legacy "tweet_text" custom field from imported posts */
		$tweet_text = sanitize_text_field( get_field("tweet_text") );
	} else {
		$tweet_text = get_the_title();
	}
	if (get_field("post_tw_url")){
		$tweet_url = get_field("post_tw_url");
	} else {
		$tweet_url = get_permalink();
	}
	$tweet = $tweet_text . ' ' . $tweet_url;
// Post author display options
	$show_author_name = get_option('post_show_author');
	$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 35, 'mm', get_the_author_meta('display_name') );
?>
<?php if ( $post_thumb_small && $post_thumb_large ): ?>
<style>
#body-mobile-background{
	background-image:url(<?php echo $post_thumb_small[0]; ?>);}
@media screen and ( min-width:650px ) and ( max-width:1023px ){
	#body-mobile-background{
		background-image:url(<?php echo $post_thumb_medium[0]; ?>);}
}
@media screen and ( min-width:1023px ){
	#body-mobile-background{
		background-image:url(<?php echo $post_thumb_large[0]; ?>);}
}
</style>
<?php endif; ?>
<section id="content" class="section single">
	<header id="page-header" class="page-header section padding-large title-section-60 width-narrow text-center bg-transparent">
		<div id="page-header-inner" class="single-inner section-inner">
			<div class="margin-bottom-medium">
<?php if ( $show_author_name ): ?>
				<span class="post-meta-item meta bg-dkgray-trans margin-none">
	<?php if ( $author_avatar): ?>
					<span class="post-author-img">
						<?php echo $author_avatar; ?>
					</span>
	<?php endif; ?>
				<span class="post-author"><?php the_author(); ?></span>
				</span>
<?php endif; ?>
				<span id="post-time" class="meta post-meta-item bg-dkgray-trans margin-none"><?php echo (get_the_date() ); ?></span>
			</div>
			<h2 id="post-title" class="<?php echo $title_size; ?>"><span class="<?php echo $text_on_image_classes; ?>"><?php the_title(); ?></span></h2>
<?php if ( has_excerpt() ):?>
			<p id="post-subtitle" class="text-style-lead"><span class="text-strong"><?php echo strip_tags( get_the_excerpt() ); ?></span></p>
<?php endif; ?>
		</div>
<?php if ( $bg_img_caption ): ?>
		<div class="section-img-credit meta"><?php echo $bg_img_caption; ?></div>
<?php endif; ?>
	</header>
<?php if ( $show_vk || $show_fb || $show_tw || $show_sina_weibo ): ?>
	<div id="post-meta" class="section bg-dkgray-trans padding-tiny width-wide text-center notch">
		<div id="post-meta-inner" class="section-inner">
			<span class="share post-meta-share post-meta-item">
	<?php if ( $show_vk ): ?>
				<a class="button button-small2 button-icon vk-share bg-vk-icon bg-vk-color" href="http://vk.com/share.php?url=<?php the_permalink(); ?>" target="_blank"><?php _e('VK','baseline'); ?></a>
	<?php endif; ?>
	<?php if ( $show_sina_weibo ): ?>
				<a class="button button-small2 button-icon sina-weibo-share bg-sina-weibo-icon bg-sina-weibo-color" href="http://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&title=<?php urlencode( the_title() ); ?>" target="_blank"><?php _e('分享到新浪微博','baseline'); ?></a>
	<?php endif; ?>
	<?php if ( $show_fb ): ?>
				<a class="button button-small2 button-icon fb-share bg-facebook-icon bg-facebook-color" href="https://www.facebook.com/sharer/sharer.php?u=<?php if ( get_field("post_fb_url")){ the_field("post_fb_url"); } else { the_permalink(); } ?>" target="_blank"><?php _e('Share','baseline'); ?></a>
	<?php endif; ?>
	<?php if ( $show_tw ): ?>
				<a class="button button-small2 button-icon tw-share bg-twitter-icon bg-twitter-color" href="http://twitter.com/home?status=<?php echo urlencode(html_entity_decode(rawurldecode($tweet))); ?>" target="_blank"><?php _e('Tweet','baseline'); ?></a>
	<?php endif; ?>
				<span class="clear"></span>
			</span>
		</div>
	</div>
<?php endif; ?>
	<article id="page-content" class="content section bg-white width-normal padding-medium">
		<div id="page-content-inner" class="section-inner">
			<?php the_content(); ?>
		</div>
	</article>
<?php if ( $custom_comments ): ?>
	<div id="post-comments" class="section bg-ltgray width-normal padding-medium">
		<div id="post-comments-inner" class="section-inner">
			<?php echo stripslashes($custom_comments); ?>
		</div>
	</div>
<?php endif; ?>
<footer class="clear"></footer>
</section>
<?php endwhile; endif;?>
<?php get_footer(); ?>
