<?php
defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/inc/frontend-password-protection.php';

function wpbb_building_project_mode( $mode ) { return 'building'; }
add_filter( 'wp_theme_project_mode', 'wpbb_building_project_mode' );

function wpbb_building_assets() {
    $theme = wp_get_theme();
    $manifest = get_stylesheet_directory() . '/dist/.vite/manifest.json';
    if ( ! is_readable( $manifest ) ) return;
    $data = json_decode( (string) file_get_contents( $manifest ), true );
    if ( ! is_array( $data ) ) return;
    if ( ! empty( $data['src/scss/public.scss']['file'] ) ) {
        wp_enqueue_style( 'wpbb-building-app', get_stylesheet_directory_uri() . '/dist/' . ltrim( $data['src/scss/public.scss']['file'], '/' ), array(), $theme->get( 'Version' ) );
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
    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
    $id = wp_insert_attachment( array( 'post_mime_type'=>$filetype['type'] ?: 'image/jpeg', 'post_title'=>$title, 'post_name'=>'wpbb-building-' . $slug, 'post_status'=>'inherit' ), $target );
    if ( $id && ! is_wp_error( $id ) ) {
        if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
        $meta = wpbb_child_381048_generate_attachment_metadata( $id, $target ); if ( $meta ) wp_update_attachment_metadata( $id, $meta ); update_post_meta( $id, '_wp_attachment_image_alt', $title );
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
    if ( !is_singular('trade_service') || !in_the_loop() || !is_main_query() ) return $content; $content=wpbb_child_381043_dedupe_single_body($content,get_the_excerpt()); $id=get_the_ID(); $image=get_the_post_thumbnail_url($id,'large'); $gallery = function_exists( 'wpbb_child_381045_gallery_single_markup' ) ? wpbb_child_381045_gallery_single_markup( $id ) : ''; if ( ! $gallery && function_exists( 'wp_theme_item_gallery_single_markup' ) ) $gallery = wp_theme_item_gallery_single_markup( $id );
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

/**
 * v3.8.10.20: keep editable Mega Menu content out of public discovery / SEO.
 * The parent already registers these objects as private; child filters make the
 * intent explicit for Core XML sitemaps and common SEO plugins too.
 */
function wpbb_child_private_megamenu_post_type_args( $args, $post_type ) {
    if ( 'megamenu' !== $post_type ) return $args;
    $args['public'] = false;
    $args['publicly_queryable'] = false;
    $args['exclude_from_search'] = true;
    $args['has_archive'] = false;
    $args['rewrite'] = false;
    $args['query_var'] = false;
    return $args;
}
add_filter( 'register_post_type_args', 'wpbb_child_private_megamenu_post_type_args', 20, 2 );

function wpbb_child_private_megamenu_taxonomy_args( $args, $taxonomy ) {
    if ( 'megamenu-cat' !== $taxonomy ) return $args;
    $args['public'] = false;
    $args['publicly_queryable'] = false;
    $args['rewrite'] = false;
    $args['query_var'] = false;
    return $args;
}
add_filter( 'register_taxonomy_args', 'wpbb_child_private_megamenu_taxonomy_args', 20, 2 );

function wpbb_child_core_sitemap_post_types( $post_types ) {
    unset( $post_types['megamenu'] );
    return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'wpbb_child_core_sitemap_post_types', 20 );

function wpbb_child_core_sitemap_taxonomies( $taxonomies ) {
    unset( $taxonomies['megamenu-cat'] );
    return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'wpbb_child_core_sitemap_taxonomies', 20 );

function wpbb_child_mega_robots( $robots ) {
    if ( is_singular( 'megamenu' ) || is_tax( 'megamenu-cat' ) ) {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }
    return $robots;
}
add_filter( 'wp_robots', 'wpbb_child_mega_robots', 20 );

function wpbb_child_yoast_exclude_megamenu_post_type( $excluded, $post_type ) {
    return 'megamenu' === $post_type ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_post_type', 'wpbb_child_yoast_exclude_megamenu_post_type', 20, 2 );

function wpbb_child_yoast_exclude_megamenu_taxonomy( $excluded, $taxonomy ) {
    return 'megamenu-cat' === $taxonomy ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'wpbb_child_yoast_exclude_megamenu_taxonomy', 20, 2 );

function wpbb_child_yoast_mega_robots( $robots ) {
    if ( is_singular( 'megamenu' ) || is_tax( 'megamenu-cat' ) ) return 'noindex, nofollow';
    return $robots;
}
add_filter( 'wpseo_robots', 'wpbb_child_yoast_mega_robots', 20 );


/**
 * v3.8.10.21: global request-a-quote UI is opt-in by child theme.
 * Sector themes with their own quote journeys can keep it; the rest do not
 * expose an unrelated floating "My Quote" control or public route.
 */
if ( ! function_exists( 'wpbb_child_request_quote_enabled' ) ) {
    function wpbb_child_request_quote_enabled() {
        $enabled_themes = array(
            'wp-bbtheme-child-automotive',
            'wp-bbtheme-child-building-services',
            'wp-bbtheme-child-insurance',
            'wp-bbtheme-child-logistics',
            'wp-bbtheme-child-medicine',
            'wp-bbtheme-child-woo-tech-shop',
        );
        $enabled = in_array( get_stylesheet(), $enabled_themes, true );
        return (bool) apply_filters( 'wpbb_child_request_quote_enabled', $enabled, get_stylesheet() );
    }
}

function wpbb_child_request_quote_body_class( $classes ) {
    $classes[] = wpbb_child_request_quote_enabled() ? 'wpbb-request-quote-enabled' : 'wpbb-request-quote-disabled';
    return $classes;
}
add_filter( 'body_class', 'wpbb_child_request_quote_body_class', 30 );

function wpbb_child_request_quote_menu_items( $items ) {
    if ( wpbb_child_request_quote_enabled() ) return $items;
    $target = trim( (string) wp_parse_url( home_url( '/request-a-quote/' ), PHP_URL_PATH ), '/' );
    foreach ( $items as $key => $item ) {
        $path = trim( (string) wp_parse_url( $item->url, PHP_URL_PATH ), '/' );
        if ( $target && $path === $target ) unset( $items[ $key ] );
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'wpbb_child_request_quote_menu_items', 30 );

function wpbb_child_request_quote_disable_route() {
    if ( wpbb_child_request_quote_enabled() ) return;
    $request = isset( $GLOBALS['wp']->request ) ? trim( (string) $GLOBALS['wp']->request, '/' ) : '';
    if ( ! is_page( 'request-a-quote' ) && 'request-a-quote' !== $request ) return;

    global $wp_query;
    if ( $wp_query ) $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
    $template = get_404_template();
    if ( $template ) {
        include $template;
        exit;
    }
    wp_die( esc_html__( 'Page not found.', 'wp-bbtheme-child' ), esc_html__( 'Not found', 'wp-bbtheme-child' ), array( 'response' => 404 ) );
}
add_action( 'template_redirect', 'wpbb_child_request_quote_disable_route', 1 );

function wpbb_child_request_quote_sitemap_args( $args, $post_type ) {
    if ( wpbb_child_request_quote_enabled() || 'page' !== $post_type ) return $args;
    $page = get_page_by_path( 'request-a-quote' );
    if ( $page ) {
        $excluded = isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : array();
        $excluded[] = (int) $page->ID;
        $args['post__not_in'] = array_values( array_unique( $excluded ) );
    }
    return $args;
}
add_filter( 'wp_sitemaps_posts_query_args', 'wpbb_child_request_quote_sitemap_args', 30, 2 );

require_once get_stylesheet_directory() . '/inc/seo-guardrails.php';

/** v3.8.10.24: identify generated legal pages independently of translated slugs. */
function wpbb_child_legal_page_body_class_v381024( $classes ) {
    if ( ! is_page() ) return $classes;
    $post = get_queried_object();
    if ( ! $post instanceof WP_Post ) return $classes;

    $is_legal = function_exists( 'is_privacy_policy' ) && is_privacy_policy();
    if ( ! $is_legal && false !== strpos( (string) $post->post_content, 'wp-theme-legal-section' ) ) {
        $is_legal = true;
    }
    if ( $is_legal ) $classes[] = 'wpbb-legal-page';
    return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'wpbb_child_legal_page_body_class_v381024', 40 );

/** v3.8.10.25: remove generated empty spacing without touching authored copy. */
if ( ! function_exists( 'wpbb_child_remove_empty_paragraphs_v381025' ) ) {
    function wpbb_child_remove_empty_paragraphs_v381025( $content ) {
        if ( is_admin() || ! is_string( $content ) || '' === $content ) return $content;
        return (string) preg_replace(
            '~<p(?:\\s[^>]*)?>(?:\\s|&nbsp;|&#160;|<br\\s*/?>)*</p>~i',
            '',
            $content
        );
    }
}
add_filter( 'the_content', 'wpbb_child_remove_empty_paragraphs_v381025', 120 );

/** v3.8.10.25: do not output a completely empty CTA block above the footer. */
if ( ! function_exists( 'wpbb_child_remove_empty_cta_v381025' ) ) {
    function wpbb_child_remove_empty_cta_v381025( $block_content, $block ) {
        if ( empty( $block['blockName'] ) || 'wpbb/cta-section' !== $block['blockName'] || ! is_string( $block_content ) ) return $block_content;
        if ( preg_match( '~<(?:img|picture|video|iframe|form|button|a)\\b~i', $block_content ) ) return $block_content;
        $plain = trim( html_entity_decode( wp_strip_all_tags( $block_content ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) ) );
        return '' === $plain ? '' : $block_content;
    }
}
add_filter( 'render_block', 'wpbb_child_remove_empty_cta_v381025', 120, 2 );



/** v3.8.10.29: make demo switching/imports self-healing across child themes. */
if ( ! function_exists( 'wpbb_child_demo_refresh_on_activation_v381029' ) ) {
    function wpbb_child_demo_refresh_on_activation_v381029() {
        // The parent importer stores one global version/profile. When a different
        // child theme is activated, invalidate that marker so its own profile is
        // imported instead of reusing the previous child's demo state.
        delete_option( 'wp_theme_demo_import_version' );
        delete_option( 'wp_theme_demo_menu_profile' );
    }
    add_action( 'after_switch_theme', 'wpbb_child_demo_refresh_on_activation_v381029', 5 );
}

if ( ! function_exists( 'wpbb_child_demo_integrity_guard_v381029' ) ) {
    function wpbb_child_demo_integrity_guard_v381029( $page_id = 0, $profile = array() ) {
        $page_id = absint( $page_id ?: get_option( 'page_on_front' ) );
        if ( ! $page_id || 'page' !== get_post_type( $page_id ) ) return;

        $content = (string) get_post_field( 'post_content', $page_id );
        // Never rewrite a real imported or edited homepage. This is only a guard
        // for the genuinely empty/near-empty page seen after switching demos.
        if ( strlen( trim( $content ) ) >= 120 ) return;

        if ( ! is_array( $profile ) ) $profile = array();
        $eyebrow = (string) ( $profile['eyebrow'] ?? __( 'Welcome', 'wp-theme' ) );
        $title = (string) ( $profile['hero_title'] ?? get_bloginfo( 'name' ) );
        $intro = (string) ( $profile['hero_text'] ?? __( 'A practical WordPress starter site ready to edit.', 'wp-theme' ) );
        $primary_label = (string) ( $profile['primary_label'] ?? __( 'Get started', 'wp-theme' ) );
        $primary_url = (string) ( $profile['primary_url'] ?? home_url( '/contact/' ) );
        $secondary_label = (string) ( $profile['secondary_label'] ?? __( 'Explore', 'wp-theme' ) );
        $secondary_url = (string) ( $profile['secondary_url'] ?? home_url( '/services/' ) );
        $services_heading = (string) ( $profile['services_heading'] ?? __( 'Useful services, clearly presented.', 'wp-theme' ) );
        $about_title = (string) ( $profile['about_title'] ?? __( 'A flexible starting point for the real site.', 'wp-theme' ) );
        $about_text = (string) ( $profile['about_text'] ?? $intro );
        $hero_image = esc_url( (string) ( $profile['hero_image'] ?? '' ) );
        $about_image = esc_url( (string) ( $profile['about_image'] ?? $hero_image ) );
        $services = ! empty( $profile['services'] ) && is_array( $profile['services'] ) ? array_slice( $profile['services'], 0, 4 ) : array();
        $stats = ! empty( $profile['stats'] ) && is_array( $profile['stats'] ) ? array_slice( $profile['stats'], 0, 4 ) : array();

        $out = '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-sector-hero wp-theme-demo-repair","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-sector-hero wp-theme-demo-repair"><!-- wp:wpbb/row {"containerClass":"container","customClasses":"align-items-center"} --><!-- wp:wpbb/column {"xs":12,"lg":6} --><p class="wp-theme-sector-eyebrow">' . esc_html( $eyebrow ) . '</p><h1>' . esc_html( $title ) . '</h1><p class="wp-theme-sector-lead">' . esc_html( $intro ) . '</p><div class="wp-theme-demo-buttons"><a class="btn btn-primary" href="' . esc_url( $primary_url ) . '">' . esc_html( $primary_label ) . '</a><a class="btn btn-outline-primary" href="' . esc_url( $secondary_url ) . '">' . esc_html( $secondary_label ) . '</a></div><!-- /wp:wpbb/column -->';
        if ( $hero_image ) $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><figure class="wp-theme-sector-page-image"><img src="' . $hero_image . '" alt="" loading="eager" decoding="async"></figure><!-- /wp:wpbb/column -->';
        $out .= '<!-- /wp:wpbb/row --></div><!-- /wp:group -->';

        if ( 'automotive' === ( $profile['id'] ?? '' ) ) {
            $out .= '<!-- wp:group {"className":"wp-theme-section-shell wpbb-automotive-finder-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wpbb-automotive-finder-section" id="finder"><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><!-- wp:wpbb/sector-finder {"context":"automotive","limit":8} /--><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';
        }

        $out .= '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-services-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-services-section"><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><p class="wp-theme-sector-eyebrow">' . esc_html( (string) ( $profile['services_eyebrow'] ?? __( 'Services', 'wp-theme' ) ) ) . '</p><h2>' . esc_html( $services_heading ) . '</h2><!-- wp:wpbb/row {"gutterX":"gx-4","gutterY":"gy-4"} -->';
        foreach ( $services as $service ) {
            $service_title = is_array( $service ) ? (string) ( $service[0] ?? '' ) : '';
            $service_text = is_array( $service ) ? (string) ( $service[1] ?? '' ) : '';
            if ( '' === trim( $service_title ) ) continue;
            $out .= '<!-- wp:wpbb/column {"xs":12,"md":6,"lg":3} --><article class="wp-theme-sector-card"><h3>' . esc_html( $service_title ) . '</h3><p>' . esc_html( $service_text ) . '</p></article><!-- /wp:wpbb/column -->';
        }
        $out .= '<!-- /wp:wpbb/row --><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';

        $out .= '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-about-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-about-section"><!-- wp:wpbb/row {"containerClass":"container","customClasses":"align-items-center"} -->';
        if ( $about_image ) $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><figure class="wp-theme-sector-page-image"><img src="' . $about_image . '" alt="" loading="lazy" decoding="async"></figure><!-- /wp:wpbb/column -->';
        $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><p class="wp-theme-sector-eyebrow">' . esc_html( (string) ( $profile['about_eyebrow'] ?? __( 'About', 'wp-theme' ) ) ) . '</p><h2>' . esc_html( $about_title ) . '</h2><p class="wp-theme-sector-lead">' . esc_html( $about_text ) . '</p><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';

        if ( $stats ) {
            $out .= '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-sector-proof","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-sector-proof"><!-- wp:wpbb/row {"containerClass":"container","gutterX":"gx-3","gutterY":"gy-3"} -->';
            foreach ( $stats as $stat ) {
                $number = is_array( $stat ) ? (string) ( $stat[0] ?? '' ) : '';
                $label = is_array( $stat ) ? (string) ( $stat[1] ?? '' ) : '';
                $out .= '<!-- wp:wpbb/column {"xs":6,"lg":3} --><div class="wp-theme-sector-proof__item"><h3>' . esc_html( $number ) . '</h3><p>' . esc_html( $label ) . '</p></div><!-- /wp:wpbb/column -->';
            }
            $out .= '<!-- /wp:wpbb/row --></div><!-- /wp:group -->';
        }

        $out .= '<!-- wp:wpbb/cta-section {"title":"' . esc_attr( (string) ( $profile['cta_title'] ?? __( 'Ready to make it yours?', 'wp-theme' ) ) ) . '","titleTag":"h2","text":"' . esc_attr( (string) ( $profile['cta_text'] ?? $intro ) ) . '","buttonText":"' . esc_attr( $primary_label ) . '","buttonUrl":"' . esc_url( $primary_url ) . '","className":"wp-theme-home-cta wp-theme-home-cta--bbuilder"} /-->';

        wp_update_post( array( 'ID' => $page_id, 'post_content' => $out ) );
        update_post_meta( $page_id, '_wp_theme_demo_repaired_381029', current_time( 'mysql' ) );
    }
    add_action( 'wp_theme_after_demo_import', 'wpbb_child_demo_integrity_guard_v381029', 99, 2 );
}


/* v3.8.10.30 visual icon configuration */
function wpbb_building_services_visual_icon_config() {
    $config = array( 'base' => get_stylesheet_directory_uri(), 'icons' => array('tool', 'ruler-measure', 'building', 'home', 'users', 'calendar', 'map-pin', 'shield') );
    echo '<script>window.wpbbChildVisuals=' . wp_json_encode( $config ) . ';</script>';
}
add_action( 'wp_footer', 'wpbb_building_services_visual_icon_config', 1 );


/* v3.8.10.30: realistic demo blog featured images. Runs only after the theme's explicit demo import. */
function wpbb_building_services_demo_blog_photo_attachment( $filename, $title ) {
    $slug = sanitize_title( pathinfo( $filename, PATHINFO_FILENAME ) );
    $existing = get_page_by_path( 'building-services-blog-' . $slug, OBJECT, 'attachment' );
    if ( $existing ) {
        if ( function_exists( 'wpbb_building_services_refresh_bundled_attachment_v381041' ) ) wpbb_building_services_refresh_bundled_attachment_v381041( (int) $existing->ID, 'assets/img/blog' );
        return (int) $existing->ID;
    }
    $source = get_stylesheet_directory() . '/assets/img/blog/' . basename( $filename );
    if ( ! is_readable( $source ) ) return 0;
    $uploads = wp_upload_dir();
    $dir = trailingslashit( $uploads['basedir'] ) . 'building-services-blog';
    wp_mkdir_p( $dir );
    $target = $dir . '/' . basename( $filename );
    if ( ! file_exists( $target ) ) copy( $source, $target );
    $filetype = wp_check_filetype( $target );
    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
    $id = wp_insert_attachment( array(
        'post_mime_type' => $filetype['type'] ?: 'image/jpeg',
        'post_title' => $title,
        'post_name' => 'building-services-blog-' . $slug,
        'post_status' => 'inherit',
    ), $target );
    if ( $id && ! is_wp_error( $id ) ) {
        if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
        $meta = wpbb_child_381048_generate_attachment_metadata( $id, $target );
        if ( $meta ) wp_update_attachment_metadata( $id, $meta );
        update_post_meta( $id, '_wp_attachment_image_alt', $title );
        return (int) $id;
    }
    return 0;
}
function wpbb_building_services_seed_demo_blog_photos( $page_id = 0, $profile = array() ) {
    $posts = get_posts( array( 'post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>12, 'orderby'=>'date', 'order'=>'DESC' ) );
    if ( ! $posts ) return;
    $images = array( 'blog-1.jpg','blog-2.jpg','blog-3.jpg','blog-4.jpg','blog-5.jpg','blog-6.jpg' );
    foreach ( $posts as $index => $post ) {
        $filename = $images[ $index % count( $images ) ];
        $attachment = wpbb_building_services_demo_blog_photo_attachment( $filename, get_the_title( $post ) );
        if ( $attachment ) set_post_thumbnail( $post->ID, $attachment );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_building_services_seed_demo_blog_photos', 70, 2 );


/** v3.8.10.31: apply bundled realistic media to already-imported demos after theme upgrade. */

/**
 * Refresh an already-imported demo attachment from the current child-theme asset.
 *
 * Image optimisation may have changed `_wp_attached_file` from e.g. item-1.jpg to
 * item-1.avif/webp. Resolve the bundled source by filename stem instead of requiring
 * the child theme to ship every generated format, then regenerate all WP sub-sizes.
 */
function wpbb_building_services_refresh_bundled_attachment_v381041( $attachment_id, $asset_dir ) {
    $attachment_id = absint( $attachment_id );
    if ( ! $attachment_id || 'attachment' !== get_post_type( $attachment_id ) ) return false;

    $attached = (string) get_post_meta( $attachment_id, '_wp_attached_file', true );
    $stem = pathinfo( basename( $attached ), PATHINFO_FILENAME );
    if ( '' === $stem ) return false;

    $base = trailingslashit( get_stylesheet_directory() ) . trailingslashit( $asset_dir ) . $stem;
    $source = '';
    foreach ( array( '.jpg', '.jpeg', '.png', '.webp', '.avif' ) as $extension ) {
        if ( is_readable( $base . $extension ) ) {
            $source = $base . $extension;
            break;
        }
    }
    if ( ! $source ) return false;

    $target = get_attached_file( $attachment_id );
    if ( ! $target ) return false;

    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';

    $source_ext = strtolower( (string) pathinfo( $source, PATHINFO_EXTENSION ) );
    $target_ext = strtolower( (string) pathinfo( $target, PATHINFO_EXTENSION ) );
    $written = false;

    if ( $source_ext === $target_ext ) {
        $written = (bool) @copy( $source, $target );
    } else {
        $target_type = wp_check_filetype( $target );
        $target_mime = ! empty( $target_type['type'] ) ? (string) $target_type['type'] : '';
        $editor = wp_get_image_editor( $source );
        if ( ! is_wp_error( $editor ) && 0 === strpos( $target_mime, 'image/' ) ) {
            $saved = $editor->save( $target, $target_mime );
            $written = ! is_wp_error( $saved ) && is_readable( $target );
        }
    }

    // Some hosts can read AVIF/WebP but cannot encode it. Fall back to the bundled
    // source extension and update WordPress to the new original file explicitly.
    if ( ! $written ) {
        $fallback = trailingslashit( dirname( $target ) ) . $stem . '.' . $source_ext;
        if ( ! @copy( $source, $fallback ) ) return false;
        update_attached_file( $attachment_id, $fallback );
        $filetype = wp_check_filetype( $fallback );
        if ( ! empty( $filetype['type'] ) ) {
            wp_update_post( array( 'ID' => $attachment_id, 'post_mime_type' => $filetype['type'] ) );
        }
        $target = $fallback;
    }

    // Remove old generated sizes first. Otherwise stale JPG thumbnails can remain
    // referenced after the original was converted to AVIF/WebP by an optimiser.
    $old_meta = wp_get_attachment_metadata( $attachment_id );
    if ( is_array( $old_meta ) && ! empty( $old_meta['sizes'] ) && is_array( $old_meta['sizes'] ) ) {
        foreach ( $old_meta['sizes'] as $old_size ) {
            if ( empty( $old_size['file'] ) ) continue;
            $old_file = trailingslashit( dirname( $target ) ) . basename( (string) $old_size['file'] );
            if ( is_file( $old_file ) && wp_normalize_path( $old_file ) !== wp_normalize_path( $target ) ) @unlink( $old_file );
        }
    }

    $meta = wpbb_child_381048_generate_attachment_metadata( $attachment_id, $target );
    if ( $meta ) wp_update_attachment_metadata( $attachment_id, $meta );
    clean_attachment_cache( $attachment_id );
    return true;
}

function wpbb_building_services_realistic_media_upgrade_v381041() {
    if ( ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) ) return;
    $done_key = 'wpbb_building_services_realistic_media_upgrade_v381041';
    if ( get_option( $done_key ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;

    $pairs = array(array('wpbb-building','assets/img/demo'),array('building-services-blog','assets/img/blog'));
    foreach ( $pairs as $pair ) {
        $upload_prefix = $pair[0];
        $asset_dir = $pair[1];
        $ids = get_posts( array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array( array( 'key'=>'_wp_attached_file', 'value'=>$upload_prefix . '/', 'compare'=>'LIKE' ) ),
        ) );
        foreach ( $ids as $attachment_id ) {
            wpbb_building_services_refresh_bundled_attachment_v381041( $attachment_id, $asset_dir );
        }
    }
    if ( function_exists( 'wpbb_building_seed_directory' ) ) wpbb_building_seed_directory( array( 'id'=>'building' ) );
    if ( function_exists( 'wpbb_building_services_seed_demo_blog_photos' ) ) wpbb_building_services_seed_demo_blog_photos( 0, array() );
    update_option( $done_key, current_time( 'mysql' ), false );
}
add_action( 'admin_init', 'wpbb_building_services_realistic_media_upgrade_v381041', 120 );


/* v3.8.10.42: full-width single-column demo rows + optional frontend demo protection. */
function wpbb_child_381042_repair_single_columns( $blocks ) {
    foreach ( $blocks as &$block ) {
        if ( 'wpbb/row' === ( $block['blockName'] ?? '' ) && ! empty( $block['innerBlocks'] ) ) {
            $column_indexes = array();
            foreach ( $block['innerBlocks'] as $index => $inner ) {
                if ( 'wpbb/column' === ( $inner['blockName'] ?? '' ) ) $column_indexes[] = $index;
            }
            if ( 1 === count( $column_indexes ) ) {
                $idx = $column_indexes[0];
                $attrs = $block['innerBlocks'][ $idx ]['attrs'] ?? array();
                if ( 12 === (int) ( $attrs['xs'] ?? 12 ) ) {
                    $attrs['xs'] = 12;
                    foreach ( array( 'sm', 'md', 'lg', 'xl', 'xxl' ) as $breakpoint ) unset( $attrs[ $breakpoint ] );
                    $block['innerBlocks'][ $idx ]['attrs'] = $attrs;
                }
            }
        }
        if ( ! empty( $block['innerBlocks'] ) ) $block['innerBlocks'] = wpbb_child_381042_repair_single_columns( $block['innerBlocks'] );
    }
    unset( $block );
    return $blocks;
}

function wpbb_child_381042_repair_demo_page_widths() {
    $pages = get_posts( array(
        'post_type' => 'page', 'post_status' => 'any', 'posts_per_page' => -1,
        'meta_key' => '_wp_theme_demo_managed', 'meta_value' => '1', 'fields' => 'ids',
    ) );
    foreach ( $pages as $page_id ) {
        $content = (string) get_post_field( 'post_content', $page_id );
        if ( false === strpos( $content, 'wpbb/column' ) ) continue;
        $blocks = parse_blocks( $content );
        $repaired = serialize_blocks( wpbb_child_381042_repair_single_columns( $blocks ) );
        if ( $repaired !== $content ) wp_update_post( array( 'ID' => $page_id, 'post_content' => $repaired ) );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_child_381042_repair_demo_page_widths', 140 );
function wpbb_child_381042_repair_demo_page_widths_once() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) return;
    $key = 'wpbb_381042_single_col_' . sanitize_key( get_stylesheet() );
    if ( get_option( $key ) ) return;
    wpbb_child_381042_repair_demo_page_widths();
    update_option( $key, 1, false );
}
add_action( 'admin_init', 'wpbb_child_381042_repair_demo_page_widths_once', 40 );

/**
 * v3.8.10.43: repair shared demo alignment and force one fresh media pass.
 *
 * The previous media migration was intentionally one-shot. This release uses a
 * new per-theme marker so sites that already ran v381041 receive the current
 * child-owned room/product/project/blog images as well.
 */
if ( ! function_exists( 'wpbb_child_381043_normalize_text' ) ) {
    function wpbb_child_381043_normalize_text( $value ) {
        $value = html_entity_decode( wp_strip_all_tags( (string) $value ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) );
        return trim( preg_replace( '/\\s+/u', ' ', $value ) );
    }
}

if ( ! function_exists( 'wpbb_child_381043_dedupe_single_body' ) ) {
    function wpbb_child_381043_dedupe_single_body( $content, $excerpt = '' ) {
        $excerpt_text = wpbb_child_381043_normalize_text( $excerpt );
        if ( '' === $excerpt_text ) return $content;

        $content_text = wpbb_child_381043_normalize_text( $content );
        if ( $content_text === $excerpt_text ) return '';

        if ( preg_match( '~^\\s*<p(?:\\s[^>]*)?>(.*?)</p>~is', (string) $content, $match ) ) {
            if ( wpbb_child_381043_normalize_text( $match[1] ) === $excerpt_text ) {
                return ltrim( substr( (string) $content, strlen( $match[0] ) ) );
            }
        }
        return $content;
    }
}

if ( ! function_exists( 'wpbb_child_381043_repair_block_alignment' ) ) {
    function wpbb_child_381043_repair_block_alignment( $blocks ) {
        foreach ( $blocks as &$block ) {
            if ( 'wpbb/row' === ( $block['blockName'] ?? '' ) ) {
                $attrs = $block['attrs'] ?? array();
                $classes = preg_split( '/\\s+/', trim( (string) ( $attrs['customClasses'] ?? '' ) ) );
                $classes = array_values( array_filter( array_map( 'sanitize_html_class', $classes ) ) );
                if ( in_array( 'wp-theme-sector-media-text', $classes, true ) ) {
                    $classes = array_values( array_diff( $classes, array( 'align-items-center', 'align-items-end' ) ) );
                    if ( ! in_array( 'align-items-start', $classes, true ) ) $classes[] = 'align-items-start';
                    $attrs['customClasses'] = implode( ' ', $classes );
                    $block['attrs'] = $attrs;
                }
            }
            if ( ! empty( $block['innerBlocks'] ) ) {
                $block['innerBlocks'] = wpbb_child_381043_repair_block_alignment( $block['innerBlocks'] );
            }
        }
        unset( $block );
        return $blocks;
    }
}

if ( ! function_exists( 'wpbb_child_381043_repair_demo_pages' ) ) {
    function wpbb_child_381043_repair_demo_pages() {
        // Repair every page that actually contains the theme's media/text row.
        // This also covers front pages imported before the managed-page marker existed.
        $page_ids = get_posts( array(
            'post_type' => 'page',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'fields' => 'ids',
        ) );
        foreach ( $page_ids as $page_id ) {
            $content = (string) get_post_field( 'post_content', $page_id );
            if ( false === strpos( $content, 'wp-theme-sector-media-text' ) ) continue;
            $repaired = serialize_blocks( wpbb_child_381043_repair_block_alignment( parse_blocks( $content ) ) );
            if ( $repaired !== $content ) {
                wp_update_post( array( 'ID' => $page_id, 'post_content' => $repaired ) );
                clean_post_cache( $page_id );
            }
        }
    }
}

if ( ! function_exists( 'wpbb_child_381043_refresh_media_once' ) ) {
    function wpbb_child_381043_refresh_media_once( $page_id = 0, $profile = array() ) {
        if ( ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) ) return;
        if ( ! current_user_can( 'manage_options' ) ) return;

        $current_stylesheet = sanitize_key( get_stylesheet() );
        $done_key = 'wpbb_child_381043_media_' . $current_stylesheet;
        $owner_key = 'wpbb_child_381043_media_owner';
        // Demo posts are shared while child themes are switched. Refresh again
        // whenever a different child theme last supplied the active media.
        if ( get_option( $done_key ) && $current_stylesheet === (string) get_option( $owner_key ) ) return;

        $defined = get_defined_functions();
        foreach ( (array) ( $defined['user'] ?? array() ) as $function_name ) {
            if ( ! preg_match( '/^wpbb_[a-z0-9_]+_realistic_media_upgrade_v381041$/', $function_name ) ) continue;
            delete_option( $function_name );
            call_user_func( $function_name );
        }

        // Correct stale titles/alt text left behind when the same demo posts were
        // reused while switching child themes.
        $post_ids = get_posts( array(
            'post_type' => 'any',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => '_thumbnail_id',
            'fields' => 'ids',
        ) );
        foreach ( $post_ids as $post_id ) {
            $thumbnail_id = (int) get_post_thumbnail_id( $post_id );
            if ( ! $thumbnail_id ) continue;
            $attached = (string) get_post_meta( $thumbnail_id, '_wp_attached_file', true );
            $attachment_name = (string) get_post_field( 'post_name', $thumbnail_id );
            if ( false === strpos( $attached, '-blog/' ) && 0 !== strpos( $attachment_name, 'wpbb-' ) ) continue;
            $title = get_the_title( $post_id );
            if ( '' === trim( (string) $title ) ) continue;
            wp_update_post( array( 'ID' => $thumbnail_id, 'post_title' => $title ) );
            update_post_meta( $thumbnail_id, '_wp_attachment_image_alt', $title );
            clean_post_cache( $post_id );
            clean_attachment_cache( $thumbnail_id );
        }

        wpbb_child_381043_repair_demo_pages();
        update_option( $done_key, current_time( 'mysql' ), false );
        update_option( $owner_key, $current_stylesheet, false );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_child_381043_refresh_media_once', 180, 2 );
add_action( 'admin_init', 'wpbb_child_381043_refresh_media_once', 130 );

/**
 * v3.8.10.45: shared rhythm, contrast, sector-media and gallery repair.
 */
require_once __DIR__ . '/inc/sector-consistency.php';
