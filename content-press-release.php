<?php /* Press Release loop template */ ?>
<article class="press-release padding-tiny border-bottom">
	<a class="area-link clearfix" href="<?php the_permalink(); ?>">
		<div class="press-release-meta meta p c2 ct3_3 cm10">
			<span class="press-release-time area-link-hover"><?php echo (get_the_date() ); ?></span>
		</div>
		<header class="press-release-content c8 ct6_6 cm10">
			<h5 class="press-release-title area-link-hover"><?php the_title(); ?></h5>
		</header>
	</a>
</article>
<?php ?>
