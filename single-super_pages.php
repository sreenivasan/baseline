<?php 
/*
* Template for Single SuperPages
*
*/
/* set up new WP_Query within the template so it can be reset after "Blog" sections
// also, it has to be above the get_header() call for the correct metadata to make it to the header, for some reason */
$sp_args = array(
	'post_type' => 'super_pages',
	'tax_query' => array(
		array(
			'taxonomy' => 'display-location',
			'field'    => 'slug',
			'terms'    => 'homepage',
		),
	),
	'posts_per_page'=> '1',
);
$hp_query = new WP_query($sp_args);
$hp_query->reset_postdata();
get_header(); 

// convert array-formatted string to actual array
function tfArrayifyParams($params_string){
    $params_array = array();
	$param_keys = array();
    $param_values = array();
    // strip quotes to prevent escaping
    $params_string = str_replace('"', "", $params_string);
	$params_string = str_replace("'", "", $params_string);
	//strip any trailing commas
	$params_string = rtrim($params_string, ',');
    // split the string into array values by comma
    $params = explode(',', trim( $params_string ) );
    // iterate through the lines.
	foreach( $params as $param ) { 
    //  make sure that the line's whitespace is cleared away
        $param = trim( $param );
        if( $param ){
            // break the line at the '=>'
            $pieces = explode( '=>', $param );
            // Split into keys array and values array by even and odd
			foreach ($pieces as $k => $v) {
				// trim whitespace
            	$v = trim( $v );
			    if ($k % 2 == 0) {
			        $param_keys[] = $v;
			    }
			    else {
			        $param_values[] = $v;
			    }
			}
		}		           
    }
    // recombine into an associative array
	$params_array = array_combine($param_keys, $param_values);		
	return $params_array;  
}

if ($hp_query->have_posts()) : while ($hp_query->have_posts()) : $hp_query->the_post();

if ( !post_password_required() ): ?>
	<style>
		<?php 
			$showHeader = get_field("sp-show-header");
			if ($showHeader): else :
		?>
		#site-header,
		#site-nav{
			display:none !important;}
		<?php 
			endif;
			$spBgChoice = get_field("sp_default_bg_choice");
			if ( $spBgChoice == 'custom' ) : 
				$spBgImgId = get_field("sp_default_bg");
				$sp_bg_small = wp_get_attachment_image_src( $spBgImgId, 'page-background-mob');
				$sp_bg_medium = wp_get_attachment_image_src( $spBgImgId, 'page-background-medium');
				$sp_bg_large = wp_get_attachment_image_src( $spBgImgId, 'page-background');
		?>
		#body-mobile-background{
			background-image:url('<?php echo $sp_bg_small[0]; ?>') !important;}
		@media screen and (min-width: 650px){
			#body-mobile-background{
				background-image:url('<?php echo $sp_bg_medium[0]; ?>') !important;}
		}
		@media screen and (min-width: 1024px){
			#body-mobile-background{
				background-image:url('<?php echo $sp_bg_large[0]; ?>') !important;}
		}
		<?php 
			elseif ($spBgChoice == 'none' || $spBgChoice == 'color') :
		?>
		#body-mobile-background{
			background:transparent !important;}
		<?php 
			endif;
		?>
	</style>

	<?php 
		function spBgImg($imgID, $imgAttach) {	
			if ( $imgID ){
				$desktop = "page-background"; // (thumbnail, medium, large, full or custom size)
				$mobile = "page-background-mob";
				$medium = "page-background-medium";
				$dataURI = "dataURI-preview";
				$sp_section_bg_img_large = wp_get_attachment_image_src( $imgID , $desktop );
				$sp_section_bg_img_medium = wp_get_attachment_image_src( $imgID , $medium );
				$sp_section_bg_img_mob = wp_get_attachment_image_src( $imgID , $mobile );
				$sp_section_bg_img_preview = wp_get_attachment_image_src( $imgID , $dataURI );
				$sp_section_bg_preview_data_uri = '';
				if ( $sp_section_bg_img_preview[0] && function_exists(getDataURI)){
					$sp_section_bg_preview_data_uri = getDataURI( $imgID );
				}
				$sp_section_bg_img_string = 'data-src-small="' . $sp_section_bg_img_mob[0] . '" data-src-medium="' . $sp_section_bg_img_medium[0] .'" data-src="' . $sp_section_bg_img_large[0] . '" style="background-image:url(' . $sp_section_bg_preview_data_uri . ');"';
				echo $sp_section_bg_img_string;	
			} else {
				return false;
			}
		}
		function spBgImgCredit($imgCred, $imgCredUrl) {	
			if ( $imgCred ){
				if ($imgCredUrl){
					$bg_cred_link_open = '<a href="' . $imgCredUrl . '" target="_blank">';
					$bg_cred_link_close = '</a>'; 
				}
				$bg_cred_string = '<div class="section-img-credit meta">' . $bg_cred_link_open . $imgCred . $bg_cred_link_close . '</div>';
				echo $bg_cred_string;
			} else {
				return false;
			}
		}
		$i = 0;
		if( have_rows( "sp-sections" ) ): while( have_rows( "sp-sections" ) ): the_row(); 
		$i++;
		$id = !empty( get_sub_field("sp-id") ) ? get_sub_field("sp-id") : 'section_' . $i;
		$classes = get_sub_field("sp-css-classes");
		$addl_attributes = get_sub_field("sp-addl-attributes");
		$bgcolor = get_sub_field("sp-bg-color");
		$padding = get_sub_field("sp-padding");
		$width = get_sub_field("sp-width");
		$bg_attachment_id = get_sub_field('sp-bg-image');
		if ( $bg_attachment_id ){
			$bg_img_status = 'on'; }
		else {
			$bg_img_status = 'off'; }
		$bg_img_size = get_sub_field('sp-bg-image-size');
		$bg_img_attach = get_sub_field('sp-bg-image-attach');
		$bg_img_repeat = get_sub_field('sp-bg-image-repeat');
		$bg_img_credit = get_sub_field('sp-bg-image-credit');
		$bg_img_credit_url = get_sub_field('sp-bg-image-credit-url');
		$notch_class = '';
		$notch_value = get_sub_field('sp-notch');
		// check for legacy notch true/false value
		if ( $notch_value === '1' ){
			$notch_class = 'notch';
		} else {
			$notch_class = $notch_value;
		} 
		$classes = "b-lazy lazy bg-" . $bgcolor . " bg-repeat-" . $bg_img_repeat . " bg-image-" . $bg_img_status . " bg-attach-" . $bg_img_attach . " bg-size-". $bg_img_size . " width-" . $width . " padding-" . $padding . " " . $notch_class . " " . $classes;

		if(get_row_layout() == "sp-section-texthtml"): // layout: Text/HTML ?>
			<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section text-html <?php echo $classes; ?>" id="<?php echo $id; ?>" <?php echo $addl_attributes; ?> >
				<div class="section-inner text-html-inner">
				<?php echo do_shortcode( get_sub_field("sp-section-content") ); ?>
				
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</div>
			
		<?php elseif(get_row_layout() == "sp-section-code") : ?>
			<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section code <?php echo $classes; ?>" id="<?php echo $id; ?>" <?php echo $addl_attributes; ?> >
				<div class="section-inner code-inner">
				<?php echo do_shortcode( get_sub_field("sp-section-content"), true); ?>
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</div>

		<?php elseif(get_row_layout() == "sp-section-actionkit") : ?>

			<?php $akpage = get_sub_field( 'sp-section-actionkit' ); ?>
				<?php if ($akpage == '') { ?>
				<div class="section bg-white padding-normal text-center">
					<div class="section-inner">
						<p><strong>Site Admin:</strong> Insert your ActionKit Page ID in the widget settings to activate this form.</p>
					</div>
				</div>
				<?php }else{ 
			$ak_title = get_sub_field( 'sp-actionkit-title' );
			$ak_intro =  get_sub_field( 'sp-actionkit-intro' );
			$ak_submit = get_sub_field( 'sp-actionkit-submit' );
			$ak_name = get_sub_field( 'sp-actionkit-name' ); 
			$ak_name_label = get_sub_field( 'sp-actionkit-name-label' );
			$ak_email = get_sub_field( 'sp-actionkit-email' ); 
			$ak_email_label = get_sub_field( 'sp-actionkit-email-label' ); 
			$ak_city = get_sub_field( 'sp-actionkit-city' );
			$ak_city_label = get_sub_field( 'sp-actionkit-city-label' );
			$ak_phone = get_sub_field( 'sp-actionkit-phone' );
			$ak_phone_label = get_sub_field( 'sp-actionkit-phone-label' );
			$ak_zip = get_sub_field( 'sp-actionkit-zip' );
			$ak_zip_label = get_sub_field( 'sp-actionkit-zip-label' );
			$ak_postal = get_sub_field( 'sp-actionkit-postal' );
			$ak_postal_label = get_sub_field( 'sp-actionkit-postal-label' );
			$ak_country = get_sub_field( 'sp-actionkit-country' );
			$ak_country_label = get_sub_field( 'sp-actionkit-country-label' );
			$ak_confirm = get_sub_field( 'sp-actionkit-confirmation' );
			$ak_custom = get_sub_field( 'sp-actionkit-custom' );
			$form_layout = get_sub_field('sp-actionkit-layout'); 
			$ak_country_preselect = get_sub_field( 'sp-actionkit-country-preselect' );
			$ak_postformtext = get_sub_field( 'sp-actionkit-postformtext' );
			$lang = substr(get_locale(),0,2);
			$form_classes = array();
			if ( $form_layout == 'two-column' ){
				$form_classes = array(
					'section' => '',
					'text' => 'c6 ct6',
					'title' => 'title4',
					'desc' => '',
					'form' => 'c4 ct4',
				);
			} else if ( $form_layout == 'three-column' ){
				$form_classes = array(
					'section' => '',
					'text' => 'c6 ct6',
					'title' => 'c3 title4',
					'desc' => 'c7',
					'form' => 'c4 ct4',
				);
			} else if ( $form_layout == 'horizontal' ){
				$form_classes = array(
					'section' => '',
					'text' => 'margin-bottom-none',
					'title' => '',
					'desc' => '',
					'form' => '',
				);
			} else {
				$form_classes = array(
					'section' => '',
					'text' => '',
					'title' => '',
					'desc' => '',
					'form' => '',
				);
			}
			// $input_text_class = ( get_sub_field('sp-actionkit-horizontal') ) ? "c2" : "input text";
			// $input_select_class = ( get_sub_field('sp-actionkit-horizontal') ) ? "c2" : "input select";
			// $input_submit_class = ( get_sub_field('sp-actionkit-horizontal') ) ? "c2" : " ";
			?>
	<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section actionkit <?php echo $classes; ?> <?php echo $form_classes['section']; ?>" id="<?php echo $id; ?>" <?php echo $addl_attributes; ?> >
		<div id="action-kit-inner" class="section-inner code-inner">
			<div class="form-text <?php echo $form_classes['text']; ?>">
				<?php if ( get_sub_field('sp-actionkit-title') ){ ?><h3 class="<?php echo $form_classes['title']; ?>"><?php echo get_sub_field('sp-actionkit-title'); ?></h3><?php } ?>
				<?php if ($ak_intro){ ?>
				<div class="form-intro <?php echo $form_classes['desc']; ?>">
					<?php echo stripslashes($ak_intro) ?>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<form class="actionkit-widget form-layout-<?php echo $form_layout; ?> form-style-labelabove <?php echo $form_classes['form']; ?>" name="signup" action="https://act.350.org/act/" onsubmit="this.submitted=1; return false;">
				<input type="hidden" name="page" value="<?=$akpage?>">
			<?php if ($ak_name) { ?>
				<div class="input-text input-name ak-input-type-user">
					<label for="ak-name"><?php echo ( $ak_name_label ) ? $ak_name_label : "Name";?></label>
					<input value="" id="ak-name" type="text" name="name" /> 
				</div>		
			<?php } ?>
				<div class="input-text input-email ak-input-type-user">
					<label for="ak-email"><?php echo ( $ak_email_label ) ? $ak_email_label : "Email Address";?></label>
					<input value="" id="ak-email" type="text" name="email"/> 
				</div>
			<?php if ($ak_city) { ?>
				<div class="input-text input-city ak-input-type-user">
					<label for="ak-city"><?php echo ( $ak_city_label ) ? $ak_city_label : "City";?></label>
					<input value="" id="ak-city" type="text" name="city"/> 
				</div>
			<?php }; ?>
			<?php if ($ak_postal) { ?>
				<div class="input-text input-postal ak-input-type-user">
					<label for="ak-postal"><?php echo ( $ak_postal_label ) ? $ak_postal_label : "Postal Code";?></label>
					<input value="" id="ak-postal" type="text" name="postal"/> 
				</div>
			<?php }; ?>
			<?php if ($ak_zip) { ?>
				<div class="input-text input-numeric input-zip ak-input-type-user">
					<label for="ak-zip"><?php echo ( $ak_zip_label ) ? $ak_zip_label : "Zip Code";?></label>
					<input value="" id="ak-zip" type="text" name="zip"/> 
				</div>
			<?php }; ?>
				<div class="input-select input-country ak-input-type-user">
					<label for="ak-country"><?php echo ( $ak_country_label ) ? $ak_country_label : "Country";?></label>
					<select name="country" <?php if ( $ak_country_preselect ): ?>data-preselect="<?php echo $ak_country_preselect; ?>"<?php endif; ?> id="ak-country" title="<?php echo ( $ak_country_label ) ? $ak_country_label : "Country";?>" >
						<option selected> </option>
						<?php 
							$country_list_filename = "country-list_" . $lang . ".php";
							$country_list_path = get_template_directory() . "/languages/" . $country_list_filename ;
							if ( file_exists( $country_list_path ) ) {
								include( $country_list_path );
							} else {
								include( get_template_directory() . "/languages/country-list_en.php" );
							}
						?>
					</select>
				</div>
			<?php if ($ak_phone): ?>
				<div class="input-text input-number input-phone ak-input-type-user">
					<label for="ak-phone"><?php echo ( $ak_phone_label ) ? $ak_phone_label : "Phone Number";?></label>
					<input value="" id="ak-phone" type="text" name="phone" /> 
				</div>
			<?php endif; ?>
			<?php if ($ak_custom): ?>
				<?php echo $ak_custom; ?>
			<?php endif; ?>
				<div class="input-submit">
					<input class="submit" type="submit" value="<?php echo $ak_submit; ?>" onClick="ga('send','event', {eventCategory: 'email', eventAction: 'superpage-action', eventLabel: '<?php echo $akpage; ?>'});" >
				</div>
			<?php if ($ak_postformtext): ?>
				<div class="ak-postform-text text-small">
					<?php echo $ak_postformtext; ?>
				</div>
			<?php endif; ?>
		</form>
		<?php } ?>
		<div id="signup-replacement" class="box box-big text-large bg-white-trans <?php echo $form_classes['form']; ?>" style="display: none;">
			<p><?php echo stripslashes($ak_confirm) ?></p>
		</div>
		<script src="https://act.350.org/samples/widget.js"></script>
		</div>
		<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
	</div>	
		<?php elseif(get_row_layout() == "sp-section-posts") : ?>
		<?php 
			$sp_content_custom_args = tfArrayifyParams( get_sub_field('sp-posts-query-params', false ) );
			$sp_content_default_args = array(
				'post_type' => 'post',
				'posts_per_page' => get_option('posts_per_page')
			);
			$sp_content_args = wp_parse_args( $sp_content_custom_args, $sp_content_default_args );
			$sp_content_query = new WP_query( $sp_content_args );
			$sp_content_after = get_sub_field('sp-posts-content-after');
			$post_count = 0;
		?>
			<?php if ($sp_content_query->have_posts()) : ?>
				<?php // Defaulting to list layout
					if (get_sub_field("sp-css-classes")){
						$layout_class = '';
					} else{
						$layout_class = ' posts-layout-list';
					}
				?>			
				<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section posts <?php echo $classes; ?>" id="<?php echo $id; ?>" <?php echo $addl_attributes; ?> >
					<div class="section-inner posts-inner">
						<?php if ( get_sub_field('sp-section-title') ): ?><h3 class="section-title meta c10 margin-bottom-medium"><?php echo get_sub_field('sp-section-title'); ?></h3><?php endif; ?>
						<?php 
							while ($sp_content_query->have_posts()) : $sp_content_query->the_post();
								$post_count++;
								// check if post_type query parameter is set and if so, use that template part:
								$post_type_param = $sp_content_args['post_type'];
								if ( $post_type_param ){
									include(locate_template('content-' . $post_type_param . '.php'));
									// get_template_part('content', $post_type_param );
								} else {
									include(locate_template('content-post.php'));
									// get_template_part('content','post');
								}
							endwhile;
						?>
					<?php if ( $sp_content_after ): ?>
						<div class="content-more">
							<?php echo $sp_content_after; ?>
						</div>	
					<?php elseif ( ($sp_content_args['post_type'] == "post") && ($posts_per_page > 2) ): ?>
						<div class="pagination"><?php 
							$pagination_args = array(
								'prev_text'          => __('← Newer','baseline'),
								'next_text'          => __('Older →','baseline')
							); 
							echo trim( paginate_links($pagination_args) );
						?></div>
					<?php endif; ?>
					</div>
					<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
				</div>
				<?php $hp_query->reset_postdata(); ?>
			<?php endif; ?>
		<?php elseif(get_row_layout() == "sp-section-sidebar") : ?>
			<?php 
				$sidebar_slug = get_sub_field("sp-section-sidebar-slug"); 
				if ( is_active_sidebar( $sidebar_slug ) ):
					get_sidebar( $sidebar_slug );
				endif; 
			?>
		<?php elseif(get_row_layout() == "sp-section-grid") : ?>
			<?php $columns = get_sub_field('grid-square-columns'); ?>
			<?php 
				if( have_rows('grid-square') ): ?>
				<div id="<?php echo $id; ?>" <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section section-img-grid <?php echo $classes; ?>" <?php echo $addl_attributes; ?> >
					<div class="section-inner img-grid-inner">
				    <?php while ( have_rows('grid-square') ) : the_row(); ?>
						<?php 
							$attachment_id = get_sub_field('grid-square-img');
							$size = "grid-square-img"; // (thumbnail, medium, large, full or custom size)
							$grid_img = wp_get_attachment_image_src($attachment_id, $size );
							$grid_img_full = wp_get_attachment_image_src($attachment_id, 'full' );
							$grid_img_preview = wp_get_attachment_image_src( $attachment_id , 'dataURI-preview' );
							$grid_img_preview_data_uri = '';
							if ( $grid_img_preview[0] && function_exists(getDataURI)){
								$grid_img_preview_data_uri = getDataURI( $attachment_id );
							}
						?>
					<div class="img-grid-square <?php echo $columns; ?>">
				    	<a rel="image_grid" href="<?php !empty( the_sub_field('grid-square-link') ) ? the_sub_field('grid-square-link') : $grid_img_full[0]; ?>" class="img-grid-square-link image-link-parent bg-size-cover <?php echo !empty( get_sub_field('grid-square-link') ) ? "fancybox" : ''; ?>" style="background-image:url(<?php echo $grid_img_preview_data_uri; ?>)">
				    		<span class="img-grid-square-img image-link-parent">
								<img data-src="<?php echo $grid_img[0] ?>" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"/>
								<noscript>
									<img class="img-grid-square-nojs-image" src="<?php echo $grid_img[0] ?>"/>
								</noscript>
				    		</span>
				    		<?php if (get_sub_field('grid-square-title')): ?>
				    		<span class="img-grid-square-title">
				    			<span>
				    				<span><?php the_sub_field('grid-square-title'); ?></span>
				    			</span>
				    		</span>
				    		<?php endif; ?>
				        </a>
						</div>
				    <?php endwhile; ?>
				    
					</div>
					<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
				</div>
				<?php 
				else :
				 // no rows found
				endif;
			?>
		<?php elseif(get_row_layout() == "sp-section-nav") : ?>
			<?php
 				// get nav menu settings
				$nav_menu_source = get_sub_field("sp-nav-menu-source");
				$nav_custom_menu_name = get_sub_field("sp-nav-menu-label");
				$navslug = get_sub_field("sp-section-navslug"); 
				if ( $navslug ):
					$menu_object = wp_get_nav_menu_object( $navslug );
					$menu_array = get_object_vars( $menu_object );
					$nav_label = $menu_array['name'];
				endif;
				// Get display options
				$nav_mobile_display = !empty( get_sub_field('sp-nav-mobile-display') ) ? get_sub_field('sp-nav-mobile-display') : 'nav-mobile-collapsed';
				$nav_tablet_display = !empty( get_sub_field('sp-nav-tablet-display') ) ? get_sub_field('sp-nav-tablet-display') : 'nav-tablet-collapsed' ;
				$nav_desktop_display = !empty( get_sub_field('sp-nav-desktop-display') ) ? get_sub_field('sp-nav-desktop-display') : 'nav-desktop-dropdown';
			?>
			<nav <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section nav <?php echo $classes; ?> <?php echo $nav_mobile_display; ?> <?php echo $nav_tablet_display; ?> <?php echo $nav_desktop_display; ?>" id="<?php echo $id; ?>" <?php echo $addl_attributes; ?> data-nav-label="<?php echo $nav_label; ?>">
				<div class="section-inner nav-inner">
					<?php // if menu source is set to "custom" and it has menu items... 
						if ( ( $nav_menu_source == "nav-menu-custom" ) && have_rows('sp-nav-menu-items') ): 
					?>
					<ul class="menu custom-menu">
						<?php if ( $nav_custom_menu_name ): ?>
						<li class="nav-menu-label text-font-secondary text-caps"><a><?php echo $nav_custom_menu_name; ?></a></li>
						<?php endif; ?>
						<?php // loop through the rows of data
						    while ( have_rows('sp-nav-menu-items') ) : the_row();
						?>
						<li><a href="<?php the_sub_field('sp-nav-menu-item-url'); ?>" class="<?php the_sub_field('sp-nav-menu-item-classes'); ?>"><?php the_sub_field('sp-nav-menu-item-label'); ?></a></li>
						<?php
						    endwhile;
						?>
					</ul>
					<?php else: ?>
					<h4 class="meta nav-label"><?php echo $nav_label; ?></h4>
					<?php 
						wp_nav_menu(array(
							'menu' => $navslug,
							'container' => false,	
							'fallback_cb' => '',
						));
					?>
					<?php endif; ?>
				</div>
			</nav>
		<?php elseif(get_row_layout() == "sp-section-ticker") : ?>
			<div class="section ticker <?php echo $classes; ?>" id="<?php echo $id; ?>" <?php echo $addl_attributes; ?> >
				<div class="section-inner ticker-inner">
				<?php $ticker_id = get_sub_field("sp-ticker-id"); ?>
				<?php 
					if (function_exists('ditty_news_ticker') ){
						ditty_news_ticker( $ticker_id );
					} 
				?>
				</div>
			</div>
			<?php $hp_query->reset_postdata(); ?>
		<?php endif; ?>
	<?php 
	endwhile;
	endif; // end ACF flex field loop
	?>

<?php 
else : 
// if password protect is enabled, get the pw form ?>
		<section id="content" class="bg-white box-white section width-normal padding-large">
			<div class="section-inner">
				<?php
					echo get_the_password_form();
				?>
			</div>
		</section>
<?php 
endif;

endwhile;
endif;
get_footer(); 
