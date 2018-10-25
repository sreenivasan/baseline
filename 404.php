<!-- 123456789 -->
<?php 
	get_header(); 
	$admin_email = get_option('admin_email');
	$text_on_image_classes = get_option('site_text_on_image_classes');
?>
<section id="404" class="section bg-transparent width-normal padding-large title-section-60">
	<div id="404-inner" class="section-inner page-inner">
		<h1 class="title2"><span class="<?php echo $text_on_image_classes; ?>"><?php _e("Page Not Found.", "baseline"); ?></span></h1>
		<div class="padding-normal bg-white text-dark">
			<p class="text-style-lead2 text-strong"><strong><?php _e("Sorry, the page you're looking for isn't here.", "baseline"); ?></strong></p>
			<ul>
				<li><?php _e("If you typed in the URL directly, make sure it doesn't have any mistakes.", "baseline"); ?></li>
				<li><?php _e('If you clicked on a link on this site', "baseline"); 
					echo ' <a class="text-dark" href="mailto:' . $admin_email . '">';
					_e('let us know</a> that it&#39;s broken.', "baseline"); ?></li>
			</ul>
			<div class="lead"><?php get_search_form(); ?></div>
		</div>
		<footer class="clear"></footer>
	</div>
</section>
<?php get_footer(); ?>