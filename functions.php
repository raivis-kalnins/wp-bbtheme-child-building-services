<?php
defined( 'ABSPATH' ) || exit;

function wpbb_building_project_mode( $mode ) { return 'building'; }
add_filter( 'wp_theme_project_mode', 'wpbb_building_project_mode' );

function wpbb_building_assets() {
    $theme = wp_get_theme();
    wp_enqueue_style( 'wpbb-building-meta', get_stylesheet_uri(), array( 'wp-theme-style' ), $theme->get( 'Version' ) );
    $manifest = get_stylesheet_directory() . '/dist/.vite/manifest.json';
    if ( ! is_readable( $manifest ) ) return;
    $data = json_decode( (string) file_get_contents( $manifest ), true );
    if ( ! is_array( $data ) ) return;
    if ( ! empty( $data['src/scss/public.scss']['file'] ) ) {
        wp_enqueue_style( 'wpbb-building-app', get_stylesheet_directory_uri() . '/dist/' . ltrim( $data['src/scss/public.scss']['file'], '/' ), array( 'wpbb-building-meta' ), $theme->get( 'Version' ) );
        if ( function_exists( 'wp_theme_sector_customizer_css' ) ) wp_add_inline_style( 'wpbb-building-app', wp_theme_sector_customizer_css( '#1F4F62', '18px', '--sector-primary', '--sector-radius' ) );
    }
    if ( ! empty( $data['src/js/main.js']['file'] ) ) wp_enqueue_script( 'wpbb-building-app', get_stylesheet_directory_uri() . '/dist/' . ltrim( $data['src/js/main.js']['file'], '/' ), array(), $theme->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'wpbb_building_assets', 30 );

function wpbb_building_dark_mode_bootstrap() { echo '<script>(function(){try{var m=localStorage.getItem("wpThemeMode");if(m==="dark"){document.documentElement.classList.add("is-dark-theme");document.documentElement.setAttribute("data-theme","dark");}}catch(e){}})();</script>'; }
add_action( 'wp_head', 'wpbb_building_dark_mode_bootstrap', 1 );


function wpbb_building_demo_profile( $profile ) {
    $assets = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/img/demo/';
    return array_merge( $profile, array(
        'id'=>'building', 'name'=>__( 'Building & Trade Services', 'wp-bbtheme-child-building' ), 'commerce'=>false,
        'eyebrow'=>__( 'Trusted trades, clearer booking', 'wp-bbtheme-child-building' ), 'hero_title'=>__( 'Plumbing, electrical and property work without the vague service pages.', 'wp-bbtheme-child-building' ), 'hero_text'=>__( 'Find the right trade, understand response times and rates, then send enough job detail for a useful quote or call-out response.', 'wp-bbtheme-child-building' ),
        'hero_image'=>$assets . 'hero-photo.jpg', 'about_image'=>$assets . 'about-photo.jpg',
        'primary_label'=>__( 'Find a service', 'wp-bbtheme-child-building' ), 'primary_url'=>'#finder',
        'secondary_label'=>__( 'Explore services', 'wp-bbtheme-child-building' ), 'secondary_url'=>wp_theme_demo_page_url( 'services' ),
        'services_eyebrow'=>__( 'What we do', 'wp-bbtheme-child-building' ), 'services_heading'=>__( 'Property repairs, installations and maintenance organised by the job people need done.', 'wp-bbtheme-child-building' ),
        'about_eyebrow'=>__( 'Why choose us', 'wp-bbtheme-child-building' ), 'about_title'=>__( 'A trade-services website that makes trust and scope visible.', 'wp-bbtheme-child-building' ), 'about_text'=>__( 'Services are structured by trade, urgency and coverage with direct quote requests for homeowners, landlords and developers.', 'wp-bbtheme-child-building' ),
        'industries_eyebrow'=>__( 'Built around your needs', 'wp-bbtheme-child-building' ), 'industries_heading'=>__( 'One system for plumbing, electricity, maintenance, fit-out and handyman work.', 'wp-bbtheme-child-building' ),
        'process_eyebrow'=>__( 'How it works', 'wp-bbtheme-child-building' ), 'process_heading'=>__( 'Choose the trade, describe the job and get the right team involved.', 'wp-bbtheme-child-building' ), 'faq_heading'=>__( 'Call-out, pricing and property-work questions answered clearly.', 'wp-bbtheme-child-building' ),
        'services'=>array(array( __( 'Plumbing', 'wp-bbtheme-child-building' ), __( 'Repairs, installations, bathrooms, heating connections and call-outs.', 'wp-bbtheme-child-building' ) ),
array( __( 'Electrical', 'wp-bbtheme-child-building' ), __( 'Testing, repairs, consumer units, lighting and installation work.', 'wp-bbtheme-child-building' ) ),
array( __( 'Handyman & maintenance', 'wp-bbtheme-child-building' ), __( 'Small repairs, snagging, fixtures and repeat property maintenance.', 'wp-bbtheme-child-building' ) ),
array( __( 'Developer support', 'wp-bbtheme-child-building' ), __( 'Multi-trade work for refurbishment, fit-out and managed property portfolios.', 'wp-bbtheme-child-building' ) )), 'industries'=>array(array( __( 'Homeowners', 'wp-bbtheme-child-building' ), __( 'Clear services for everyday repair and improvement work.', 'wp-bbtheme-child-building' ) ),
array( __( 'Landlords', 'wp-bbtheme-child-building' ), __( 'Responsive maintenance with structured job information.', 'wp-bbtheme-child-building' ) ),
array( __( 'Commercial property', 'wp-bbtheme-child-building' ), __( 'Planned maintenance and compliance-related work.', 'wp-bbtheme-child-building' ) ),
array( __( 'Developers', 'wp-bbtheme-child-building' ), __( 'Coordinated plumbing, electrical and finishing trades.', 'wp-bbtheme-child-building' ) )), 'stats'=>array(array( '6', __( 'Core trade services', 'wp-bbtheme-child-building' ) ),
array( '24/7', __( 'Emergency option', 'wp-bbtheme-child-building' ) ),
array( '90 min', __( 'Priority response target', 'wp-bbtheme-child-building' ) ),
array( '1', __( 'Quote workflow', 'wp-bbtheme-child-building' ) )), 'process'=>array(array( '01', __( 'Find', 'wp-bbtheme-child-building' ), __( 'Filter services by trade, urgency, coverage and call-out budget.', 'wp-bbtheme-child-building' ) ),
array( '02', __( 'Describe', 'wp-bbtheme-child-building' ), __( 'Send postcode, property type, urgency and job detail.', 'wp-bbtheme-child-building' ) ),
array( '03', __( 'Schedule', 'wp-bbtheme-child-building' ), __( 'Route the request to the right trade for pricing or attendance.', 'wp-bbtheme-child-building' ) )),
        'cta_title'=>__( 'Describe the job once. Route it to the right trade.', 'wp-bbtheme-child-building' ), 'cta_text'=>__( 'Use the service finder and structured quote workflow for building contractors, maintenance firms and multi-trade teams.', 'wp-bbtheme-child-building' ), 'footer_text'=>__( 'Property repairs, installations and maintenance delivered by an organised multi-trade team.', 'wp-bbtheme-child-building' ),
        'page_labels'=>array('about'=>__( 'About', 'wp-bbtheme-child-building' ),'services'=>__( 'Services', 'wp-bbtheme-child-building' ),'industries'=>__( 'Solutions', 'wp-bbtheme-child-building' ),'contact'=>__( 'Contact', 'wp-bbtheme-child-building' ),'blog'=>__( 'Insights', 'wp-bbtheme-child-building' )),
        'palette'=>array('theme_brand_color'=>'#1F4F62','theme_accent_color'=>'#D9852B','theme_background_color'=>'#f7f8fb','theme_surface_color'=>'#ffffff','theme_border_color'=>'#dfe4ee','theme_radius'=>'22px')
    ) );
}
add_filter( 'wp_theme_demo_profile', 'wpbb_building_demo_profile', 20 );


function wpbb_building_pattern_markup( $name ) {
    $path = get_stylesheet_directory() . '/patterns/' . sanitize_file_name( $name ) . '.php';
    if ( ! is_readable( $path ) ) return '';
    ob_start(); include $path; return trim( (string) ob_get_clean() );
}

function wpbb_building_extra_home_sections( $content, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'building' ) return $content;
    return $content . wpbb_building_pattern_markup( 'sector-proof' );
}
add_filter( 'wp_theme_demo_extra_home_sections', 'wpbb_building_extra_home_sections', 25, 2 );

function wpbb_building_blog_profile( $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'building' ) return $profile;
    $profile['blog_eyebrow'] = __( 'Insights', 'wp-bbtheme-child-building' );
    $profile['blog_archive_title'] = __( 'Maintenance advice, project guidance and trade updates.', 'wp-bbtheme-child-building' );
    $profile['blog_archive_intro'] = __( 'Practical content for property owners, landlords and development teams.', 'wp-bbtheme-child-building' );
    return $profile;
}
add_filter( 'wp_theme_demo_profile', 'wpbb_building_blog_profile', 90 );


function wpbb_building_demo_attachment( $filename, $title ) {
    $slug = sanitize_title( pathinfo( $filename, PATHINFO_FILENAME ) );
    $existing = get_page_by_path( 'wpbb-building-' . $slug, OBJECT, 'attachment' );
    if ( $existing ) return $existing->ID;
    $source = get_stylesheet_directory() . '/assets/img/demo/' . basename( $filename );
    if ( ! is_readable( $source ) ) return 0;
    $uploads = wp_upload_dir(); $dir = trailingslashit( $uploads['basedir'] ) . 'wpbb-building'; wp_mkdir_p( $dir );
    $target = $dir . '/' . basename( $filename ); if ( ! file_exists( $target ) ) copy( $source, $target );
    $filetype = wp_check_filetype( $target );
    $id = wp_insert_attachment( array( 'post_mime_type'=>$filetype['type'] ?: 'image/jpeg', 'post_title'=>$title, 'post_name'=>'wpbb-building-' . $slug, 'post_status'=>'inherit' ), $target );
    if ( $id && ! is_wp_error( $id ) ) {
        if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
        $meta = wp_generate_attachment_metadata( $id, $target ); if ( $meta ) wp_update_attachment_metadata( $id, $meta ); update_post_meta( $id, '_wp_attachment_image_alt', $title );
        return (int) $id;
    }
    return 0;
}

function wpbb_building_register_directory() {
    register_post_type( 'trade_service', array(
        'labels'=>array('name'=>__( 'Trade Services', 'wp-bbtheme-child-building' ),'singular_name'=>__( 'Trade Service', 'wp-bbtheme-child-building' ),'add_new_item'=>__( 'Add Trade Service', 'wp-bbtheme-child-building' )),
        'public'=>true,'show_in_rest'=>true,'has_archive'=>'trade-services','rewrite'=>array('slug'=>'trade-services'),'menu_icon'=>'dashicons-hammer','supports'=>array('title','editor','excerpt','thumbnail','page-attributes')
    ) );
    register_taxonomy( 'trade_type', 'trade_service', array( 'label'=>__( 'Trades', 'wp-bbtheme-child-building' ), 'public'=>true, 'show_in_rest'=>true, 'hierarchical'=>true, 'rewrite'=>array('slug'=>'trade') ) ); register_taxonomy( 'property_work', 'trade_service', array( 'label'=>__( 'Property work', 'wp-bbtheme-child-building' ), 'public'=>true, 'show_in_rest'=>true, 'hierarchical'=>true, 'rewrite'=>array('slug'=>'property-work') ) );
}
add_action( 'init', 'wpbb_building_register_directory', 12 );

function wpbb_building_meta_fields() { return array('callout'=>__( 'Typical call-out', 'wp-bbtheme-child-building' ),'response'=>__( 'Response target', 'wp-bbtheme-child-building' ),'emergency'=>__( 'Emergency service', 'wp-bbtheme-child-building' ),'coverage'=>__( 'Coverage', 'wp-bbtheme-child-building' ),'qualification'=>__( 'Qualification / assurance', 'wp-bbtheme-child-building' )); }
function wpbb_building_meta_box() { add_meta_box( 'wpbb-building-details', __( 'Trade Service details', 'wp-bbtheme-child-building' ), 'wpbb_building_meta_box_render', 'trade_service', 'normal', 'high' ); }
add_action( 'add_meta_boxes', 'wpbb_building_meta_box' );
function wpbb_building_meta_box_render( $post ) {
    wp_nonce_field( 'wpbb_building_save', 'wpbb_building_nonce' ); echo '<div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px">';
    foreach ( wpbb_building_meta_fields() as $key=>$label ) { $value=get_post_meta($post->ID,'_building_'.$key,true); echo '<label><strong>'.esc_html($label).'</strong><input class="widefat" type="text" name="wpbb_building['.esc_attr($key).']" value="'.esc_attr($value).'"></label>'; } echo '</div>';
}
function wpbb_building_save_meta( $post_id ) {
    if ( empty($_POST['wpbb_building_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpbb_building_nonce'])),'wpbb_building_save') || !current_user_can('edit_post',$post_id) ) return;
    $values=isset($_POST['wpbb_building'])&&is_array($_POST['wpbb_building'])?wp_unslash($_POST['wpbb_building']):array(); foreach(wpbb_building_meta_fields() as $key=>$label) update_post_meta($post_id,'_building_'.$key,sanitize_text_field($values[$key]??''));
}
add_action( 'save_post_trade_service', 'wpbb_building_save_meta' );

function wpbb_building_directory_configs( $configs ) {
    $configs['building'] = array(
      'post_type'=>'trade_service','eyebrow'=>__( 'Trade services', 'wp-bbtheme-child-building' ),'title'=>__( 'Find the right trade for the job.', 'wp-bbtheme-child-building' ),'intro'=>__( 'Filter by trade, emergency availability, coverage and call-out budget.', 'wp-bbtheme-child-building' ),'keyword_label'=>__( 'Search services', 'wp-bbtheme-child-building' ),'keyword_placeholder'=>__( 'Leak, sockets, decorating…', 'wp-bbtheme-child-building' ),'button_label'=>__( 'Find service', 'wp-bbtheme-child-building' ),'results_label'=>__( 'services', 'wp-bbtheme-child-building' ),'limit'=>8,'default_sort'=>'featured',
      'filters'=>array(array('type'=>'taxonomy','key'=>'trade','label'=>__( 'Trade', 'wp-bbtheme-child-building' ),'taxonomy'=>'trade_type','all_label'=>'Any trade'),array('type'=>'meta_select','key'=>'emergency','label'=>__( 'Emergency', 'wp-bbtheme-child-building' ),'meta_key'=>'_building_emergency','all_label'=>'Any availability','options'=>array('Yes'=>__( 'Emergency available', 'wp-bbtheme-child-building' ),'No'=>__( 'Planned work', 'wp-bbtheme-child-building' ))),array('type'=>'meta_max','key'=>'max_callout','label'=>__( 'Max call-out', 'wp-bbtheme-child-building' ),'meta_key'=>'_building_callout','placeholder'=>'Any','step'=>10),array('type'=>'meta_select','key'=>'coverage','label'=>__( 'Coverage', 'wp-bbtheme-child-building' ),'meta_key'=>'_building_coverage','all_label'=>'Any area','options'=>array('City'=>__( 'City', 'wp-bbtheme-child-building' ),'County'=>__( 'County', 'wp-bbtheme-child-building' ),'Regional'=>__( 'Regional', 'wp-bbtheme-child-building' )))),'sorts'=>array('featured'=>array('label'=>__( 'Recommended', 'wp-bbtheme-child-building' ),'orderby'=>'menu_order','order'=>'ASC'),'rate-asc'=>array('label'=>__( 'Call-out: low to high', 'wp-bbtheme-child-building' ),'orderby'=>'meta_value_num','order'=>'ASC','meta_key'=>'_building_callout')),'card_taxonomies'=>array('trade_type','property_work'),'card_meta'=>array(array('key'=>'_building_callout','label'=>__( 'Call-out', 'wp-bbtheme-child-building' ),'format'=>'money','currency'=>'£'),array('key'=>'_building_response','label'=>__( 'Response', 'wp-bbtheme-child-building' )),array('key'=>'_building_emergency','label'=>__( 'Emergency', 'wp-bbtheme-child-building' )),array('key'=>'_building_coverage','label'=>__( 'Coverage', 'wp-bbtheme-child-building' ))),'card_button'=>__( 'View service', 'wp-bbtheme-child-building' )
    ); return $configs;
}
add_filter( 'wp_theme_sector_directory_configs', 'wpbb_building_directory_configs' );

function wpbb_building_seed_directory( $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'building' ) return;
    $rows=array(array('title'=>'Emergency Plumbing','slug'=>'emergency-plumbing','excerpt'=>'Urgent leak, burst pipe and water-supply call-outs.','content'=>'Urgent leak, burst pipe and water-supply call-outs.','terms'=>array('trade_type'=>'Plumbing','property_work'=>'Repairs'),'meta'=>array('callout'=>'95','response'=>'90 minutes','emergency'=>'Yes','coverage'=>'City','qualification'=>'Gas Safe partner network'),'image'=>'item-1.jpg'),array('title'=>'Bathroom Plumbing','slug'=>'bathroom-plumbing','excerpt'=>'Plumbing work for bathroom refits, fixtures and upgrades.','content'=>'Plumbing work for bathroom refits, fixtures and upgrades.','terms'=>array('trade_type'=>'Plumbing','property_work'=>'Installation'),'meta'=>array('callout'=>'75','response'=>'2–3 working days','emergency'=>'No','coverage'=>'County','qualification'=>'Insured installers'),'image'=>'item-2.jpg'),array('title'=>'Electrical Fault Finding','slug'=>'electrical-fault-finding','excerpt'=>'Diagnosis and repair for tripping circuits, sockets and lighting faults.','content'=>'Diagnosis and repair for tripping circuits, sockets and lighting faults.','terms'=>array('trade_type'=>'Electrical','property_work'=>'Repairs'),'meta'=>array('callout'=>'90','response'=>'Same day','emergency'=>'Yes','coverage'=>'City','qualification'=>'NICEIC approved'),'image'=>'item-3.jpg'),array('title'=>'Consumer Unit Upgrades','slug'=>'consumer-unit-upgrades','excerpt'=>'Assessment and replacement of domestic consumer units.','content'=>'Assessment and replacement of domestic consumer units.','terms'=>array('trade_type'=>'Electrical','property_work'=>'Installation'),'meta'=>array('callout'=>'70','response'=>'3–5 working days','emergency'=>'No','coverage'=>'County','qualification'=>'NICEIC approved'),'image'=>'item-4.jpg'),array('title'=>'Handyman & Snagging','slug'=>'handyman-snagging','excerpt'=>'Fixtures, small repairs, flat-pack, patching and snag lists.','content'=>'Fixtures, small repairs, flat-pack, patching and snag lists.','terms'=>array('trade_type'=>'Handyman','property_work'=>'Maintenance'),'meta'=>array('callout'=>'55','response'=>'1–2 working days','emergency'=>'No','coverage'=>'City','qualification'=>'Insured multi-trade team'),'image'=>'item-5.jpg'),array('title'=>'Developer Maintenance','slug'=>'developer-maintenance','excerpt'=>'Coordinated multi-trade support for managed portfolios and development teams.','content'=>'Coordinated multi-trade support for managed portfolios and development teams.','terms'=>array('trade_type'=>'Multi-trade','property_work'=>'Developer support'),'meta'=>array('callout'=>'0','response'=>'Contract SLA','emergency'=>'Yes','coverage'=>'Regional','qualification'=>'RAMS / insured teams'),'image'=>'item-6.jpg'));
    foreach($rows as $i=>$row){
      foreach($row['terms'] as $tax=>$term) if(taxonomy_exists($tax)&&!term_exists($term,$tax)) wp_insert_term($term,$tax);
      $existing=get_page_by_path($row['slug'],OBJECT,'trade_service'); $args=array('post_type'=>'trade_service','post_status'=>'publish','post_title'=>$row['title'],'post_name'=>$row['slug'],'menu_order'=>$i,'post_excerpt'=>$row['excerpt'],'post_content'=>'<!-- wp:paragraph --><p>'.esc_html($row['content']).'</p><!-- /wp:paragraph -->');
      if($existing){$args['ID']=$existing->ID;$id=wp_update_post($args);}else{$id=wp_insert_post($args);} if(!$id||is_wp_error($id))continue;
      foreach($row['terms'] as $tax=>$term)wp_set_object_terms($id,$term,$tax); foreach($row['meta'] as $key=>$value)update_post_meta($id,'_building_'.$key,$value); $img=wpbb_building_demo_attachment($row['image'],$row['title']); if($img)set_post_thumbnail($id,$img); update_post_meta($id,'_wp_theme_demo_trade_service',1);
    }
}
add_action( 'wp_theme_seed_sector_pages', 'wpbb_building_seed_directory', 25 );

function wpbb_building_after_hero_finder( $content, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'building' ) return $content;
    return $content . '<!-- wp:group {"className":"wp-theme-section-shell wpbb-building-finder-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wpbb-building-finder-section"><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><!-- wp:wpbb/sector-finder {"context":"building","limit":8} /--><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';
}
add_filter( 'wp_theme_demo_after_hero_sections', 'wpbb_building_after_hero_finder', 20, 2 );

function wpbb_building_navigation( $items, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'building' ) return $items;
    array_splice( $items, 1, 0, array( array('key'=>'trade_service','title'=>__( 'Services', 'wp-bbtheme-child-building' ),'type'=>'post_type_archive','object'=>'trade_service','locations'=>array('header','footer')) ) ); return $items;
}
add_filter( 'wp_theme_demo_navigation_items', 'wpbb_building_navigation', 20, 2 );

function wpbb_building_header_search_types( $types ) { if(post_type_exists('trade_service'))$types[]='trade_service'; return array_values(array_unique($types)); }
add_filter( 'wp_theme_header_search_post_types', 'wpbb_building_header_search_types' );

function wpbb_building_single_content( $content ) {
    if ( !is_singular('trade_service') || !in_the_loop() || !is_main_query() ) return $content; $id=get_the_ID(); $image=get_the_post_thumbnail_url($id,'large'); $gallery=function_exists('wp_theme_item_gallery_single_markup')?wp_theme_item_gallery_single_markup($id):'';
    $facts=''; foreach(wpbb_building_meta_fields() as $key=>$label){$value=get_post_meta($id,'_building_'.$key,true);if(''!==trim((string)$value))$facts.='<div><small>'.esc_html($label).'</small><strong>'.esc_html($value).'</strong></div>';}
    $html='<section class="wpbb-sector-single"><div class="container"><div class="wpbb-sector-single__hero"><div class="wpbb-sector-single__media">'.($gallery?:($image?'<img src="'.esc_url($image).'" alt="'.esc_attr(get_the_title()).'">':'')).'</div><div><p class="wp-theme-sector-eyebrow">'.esc_html('Trade Service').'</p><h1>'.esc_html(get_the_title()).'</h1><p class="wp-theme-sector-lead">'.esc_html(get_the_excerpt()).'</p><div class="wpbb-sector-single__facts">'.$facts.'</div></div></div><div class="wpbb-sector-single__content">'.$content.'</div>';
    if(function_exists('wpbb_building_request_form'))$html.=wpbb_building_request_form($id); return $html.'</div></section>';
}
add_filter( 'the_content', 'wpbb_building_single_content', 25 );

function wpbb_building_polylang_post_types( $types, $settings ) { $types['trade_service']='trade_service'; return $types; }
add_filter( 'pll_get_post_types', 'wpbb_building_polylang_post_types', 10, 2 );
function wpbb_building_pll_trade_type( $tax, $settings ) { $tax['trade_type']='trade_type'; return $tax; }
add_filter( 'pll_get_taxonomies', 'wpbb_building_pll_trade_type', 10, 2 );
function wpbb_building_pll_property_work( $tax, $settings ) { $tax['property_work']='property_work'; return $tax; }
add_filter( 'pll_get_taxonomies', 'wpbb_building_pll_property_work', 10, 2 );

function wpbb_building_register_requests() { register_post_type('trade_quote',array('labels'=>array('name'=>__( 'Trade Quotes', 'wp-bbtheme-child-building' ),'singular_name'=>__( 'Trade Quote', 'wp-bbtheme-child-building' )),'public'=>false,'show_ui'=>true,'show_in_menu'=>'edit.php?post_type=trade_service','supports'=>array('title'))); }
add_action('init','wpbb_building_register_requests',14);
function wpbb_building_request_form( $object_id ) {
    $success=isset($_GET['request'])&&'received'===sanitize_key(wp_unslash($_GET['request'])); ob_start(); ?>
    <div class="wpbb-sector-request" id="request"><p class="wp-theme-sector-eyebrow"><?php echo esc_html(__( 'Request a quote', 'wp-bbtheme-child-building' )); ?></p><h2><?php echo esc_html(__( 'Describe the property and the work needed.', 'wp-bbtheme-child-building' )); ?></h2><?php if($success):?><div class="alert alert-success"><?php echo esc_html(__( 'Thanks. Your trade request has been received.', 'wp-bbtheme-child-building' )); ?></div><?php endif;?>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="wpbb_building_submit_request"><input type="hidden" name="object_id" value="<?php echo esc_attr($object_id); ?>"><?php wp_nonce_field('wpbb_building_request_'.$object_id,'wpbb_building_request_nonce'); ?>
      <?php echo '<label class=""><span>'.esc_html(__( 'Name', 'wp-bbtheme-child-building' )).'</span><input type="text" name="name" required></label>' . '<label class=""><span>'.esc_html(__( 'Email', 'wp-bbtheme-child-building' )).'</span><input type="email" name="email" required></label>' . '<label class=""><span>'.esc_html(__( 'Phone', 'wp-bbtheme-child-building' )).'</span><input type="tel" name="phone" required></label>' . '<label class=""><span>'.esc_html(__( 'Postcode', 'wp-bbtheme-child-building' )).'</span><input type="text" name="postcode" required></label>' . '<label class=""><span>'.esc_html(__( 'Property type', 'wp-bbtheme-child-building' )).'</span><select name="property_type"><option value="house">House</option><option value="flat">Flat</option><option value="commercial">Commercial</option><option value="development">Development</option></select></label>' . '<label class=""><span>'.esc_html(__( 'Urgency', 'wp-bbtheme-child-building' )).'</span><select name="urgency"><option value="emergency">Emergency</option><option value="soon">Within a few days</option><option value="planned">Planned work</option></select></label>' . '<label class="is-wide"><span>'.esc_html(__( 'Describe the work', 'wp-bbtheme-child-building' )).'</span><textarea name="message" rows="5" required></textarea></label>'; ?><button class="btn btn-primary" type="submit"><?php echo esc_html(__( 'Send job request', 'wp-bbtheme-child-building' )); ?></button>
    </form></div><?php return ob_get_clean();
}
function wpbb_building_submit_request() {
    $object_id=absint($_POST['object_id']??0); if(!$object_id||'trade_service'!==get_post_type($object_id))wp_die(esc_html(__( 'Invalid request.', 'wp-bbtheme-child-building' ))); if(empty($_POST['wpbb_building_request_nonce'])||!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpbb_building_request_nonce'])),'wpbb_building_request_'.$object_id))wp_die(esc_html(__( 'The form expired. Please try again.', 'wp-bbtheme-child-building' )));
    $name=sanitize_text_field(wp_unslash($_POST['name']??'')); $email=sanitize_email(wp_unslash($_POST['email']??'')); $phone=sanitize_text_field(wp_unslash($_POST['phone']??'')); $postcode=sanitize_text_field(wp_unslash($_POST['postcode']??'')); $property_type=sanitize_text_field(wp_unslash($_POST['property_type']??'')); $urgency=sanitize_text_field(wp_unslash($_POST['urgency']??'')); $message=sanitize_textarea_field(wp_unslash($_POST['message']??'')); if('' === (string) $name || ! is_email( $email ) || '' === (string) $phone || '' === (string) $postcode || '' === (string) $message)wp_die(esc_html(__( 'Please complete the required fields.', 'wp-bbtheme-child-building' )));
    $request_id=wp_insert_post(array('post_type'=>'trade_quote','post_status'=>'publish','post_title'=>sprintf('%s — %s',get_the_title($object_id),isset($name)?$name:current_time('mysql')))); if($request_id&&!is_wp_error($request_id)){foreach(array('object_id'=>$object_id,'name'=>$name,'email'=>$email,'phone'=>$phone,'postcode'=>$postcode,'property_type'=>$property_type,'urgency'=>$urgency,'message'=>$message,'status'=>'new') as $key=>$value)update_post_meta($request_id,'_building_request_'.$key,$value);}
    wp_safe_redirect(add_query_arg('request','received',get_permalink($object_id)).'#request'); exit;
}
add_action('admin_post_wpbb_building_submit_request','wpbb_building_submit_request'); add_action('admin_post_nopriv_wpbb_building_submit_request','wpbb_building_submit_request');

function wpbb_building_mega_menu( $definitions, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'building' ) return $definitions; $archive=get_post_type_archive_link('trade_service')?:home_url('/trade-services/');
    $definitions['trade_service']=array('title'=>__( 'Services navigation', 'wp-bbtheme-child-building' ),'target_key'=>'trade_service','eyebrow'=>__( 'Services', 'wp-bbtheme-child-building' ),'heading'=>__( 'Get the right trade involved first time.', 'wp-bbtheme-child-building' ),'intro'=>__( 'Browse plumbing, electrical and maintenance services by need.', 'wp-bbtheme-child-building' ),'columns'=>array(
      array('title'=>__( 'Explore', 'wp-bbtheme-child-building' ),'links'=>array(array(__( 'Services', 'wp-bbtheme-child-building' ),__( 'Filter by trade, emergency availability, coverage and call-out budget.', 'wp-bbtheme-child-building' ),$archive),array(__( 'Services', 'wp-bbtheme-child-building' ),__( 'Property repairs, installations and maintenance organised by the job people need done.', 'wp-bbtheme-child-building' ),wp_theme_demo_page_url('services')),array(__( 'Solutions', 'wp-bbtheme-child-building' ),__( 'One system for plumbing, electricity, maintenance, fit-out and handyman work.', 'wp-bbtheme-child-building' ),wp_theme_demo_page_url('industries')))),
      array('title'=>__( 'Plan', 'wp-bbtheme-child-building' ),'links'=>array(array(__( 'How it works', 'wp-bbtheme-child-building' ),__( 'Choose the trade, describe the job and get the right team involved.', 'wp-bbtheme-child-building' ),wp_theme_demo_page_url('services')),array(__( 'About', 'wp-bbtheme-child-building' ),__( 'Services are structured by trade, urgency and coverage with direct quote requests for homeowners, landlords and developers.', 'wp-bbtheme-child-building' ),wp_theme_demo_page_url('about')),array(__( 'Contact', 'wp-bbtheme-child-building' ),__( 'Talk to the team about the next step.', 'wp-bbtheme-child-building' ),wp_theme_demo_page_url('contact')))),
      array('title'=>__( 'Useful', 'wp-bbtheme-child-building' ),'links'=>array(array(__( 'Insights', 'wp-bbtheme-child-building' ),__( 'Practical content for property owners, landlords and development teams.', 'wp-bbtheme-child-building' ),get_permalink(get_option('page_for_posts'))?:home_url('/blog/')),array(__( 'Search', 'wp-bbtheme-child-building' ),__( 'Use the live finder to narrow the catalogue.', 'wp-bbtheme-child-building' ),$archive),array(__( 'Enquire', 'wp-bbtheme-child-building' ),__( 'Send the details needed for a useful response.', 'wp-bbtheme-child-building' ),wp_theme_demo_page_url('contact'))))
    )); return $definitions;
}
add_filter('wp_theme_demo_mega_menu_definitions','wpbb_building_mega_menu',20,2);
