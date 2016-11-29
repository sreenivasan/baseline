<?php ?>
<form action="<?php echo home_url(); ?>" method="get" class="search-form small c-wide">
	<input type="search" name="s" class="search-form-field c7" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search...','baseline'); ?>" />
	<input type="submit" value="<?php _e('Search','baseline'); ?>" class="search-form-submit c3 bg-icon-search" />
	<div class="clear"></div>
</form>
<?php ?>