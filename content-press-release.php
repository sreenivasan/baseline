<?php /* Press Release loop template */ ?>
<article class="press-release no-margin post">
	<a class="area-link" href="<?php the_permalink(); ?>">
		<div class="c10 ct10 cm10">
			<div class="post-meta meta p c2 ct3_3 cm10">
				<span class="post-time area-link-hover"><?php echo (get_the_date() ); ?></span>
			</div>	
			<header class="post-title c8 ct6_6 cm10">
				<h5 class="post-title graph area-link-hover"><?php the_title(); ?></h5>
			</header>
		</div>		
		<?php /*
		<div class="post-categories">
			<p><?php
				foreach((get_the_category()) as $category) { 
					if ( $category->slug !== 'uncategorized' ) {
						$output = '<a class="cat-link cat-'. $category->slug .'" href="'. get_category_link( $category->term_id ) .'" title="'. $category->description .'">'. $category->name .'</a> ';
						echo $output;	
					}
				} 
			?></p>
		</div> */ ?>

	<div class="clear"></div>
	</a>
</article>
<?php ?>