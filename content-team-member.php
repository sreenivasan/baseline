<?php /* Team Member loop template */
	
	/* Team member image */
	$attachment_id = get_field('tm_image', $id);
	$tm_image_array = wp_get_attachment_image_src($attachment_id, 'small' );
	$tm_image = $tm_image_array[0];
	$tm_image_preview_array = wp_get_attachment_image_src($attachment_id, 'dataURI-preview' );
	$tm_image_preview = $tm_image_preview_array[0];
	if ( $tm_image_preview && function_exists(getDataURI)){
		$tm_image_preview_data_uri = getDataURI( $attachment_id );
	}

	
	/* Team member name */
	$tm_first_name = get_field('tm_first_name', $id);
	$tm_middle_name = get_field('tm_middle_name', $id);
	$tm_last_name = get_field('tm_last_name', $id); 
	// check if middle name is present so we don't end up with two spaces between first and last
	if ($tm_middle_name){
		$tm_name = $tm_first_name . ' ' . $tm_middle_name . ' ' . $tm_last_name;
	} else {
		$tm_name = $tm_first_name . ' ' . $tm_last_name;
	}

	/* Team member info */
	$tm_title = get_field('tm_title', $id);
	$tm_location = get_field('tm_location', $id);
	$tm_email = get_field('tm_email', $id);
	$tm_twitter = get_field('tm_twitter', $id);

?>
<div class="team-member c2 ct3_3 cm5">
	<div class="team-member-photo bg-ltgray image-link-parent margin-bottom-small">
		<img class="lazy image-data-preview" data-src="<?php echo $tm_image; ?>" src="<?php if ( $tm_image_preview_data_uri ){ echo $tm_image_preview_data_uri; } else { echo "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"; } ?>" alt="<?php echo $tm_name; ?>"/>
		<noscript>
			<img src="<?php echo $tm_image; ?>" alt="<?php echo $tm_name; ?>"/>
		</noscript>
	</div>	
	<div class="team-member-info text-lineheight-small">
		<span class="team-member-name text-strong"><?php echo $tm_name; ?></span>
		<?php if ( $tm_title ): ?>
		<br><span class="team-member-title margin-bottom-none"><?php echo $tm_title; ?></span>
		<?php endif; ?>
		<?php if ( $tm_location ): ?>
		<br><span class="team-member-location text-small opacity-50 margin-bottom-none"><?php echo $tm_location; ?></span>
		<?php endif; ?>
		<?php if ( $tm_email || $tm_twitter ): ?>
		<div class="team-member-contact text-large">
			<?php if ( $tm_email ): ?>
			<a class="inline-dot bg-email-icon bg-ltblue team-member-email " href="mailto:<?php echo $tm_email; ?>@350.org" title="<?php echo $tm_email; ?>@350.org"></a>
			<?php endif; ?>
			<?php if ( $tm_twitter ): ?>
			<a class="team-member-twitter inline-dot bg-ltblue bg-twitter-icon" href="http://twitter.com/<?php echo $tm_twitter; ?>" target="_blank" title="@<?php echo $tm_twitter; ?>"></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>	
</div>
<?php ?>