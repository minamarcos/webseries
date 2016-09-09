<?php

add_action('init','gc_webisodes');
add_action('init','gc_products');
add_action('save_post','set_featured_webseries');
// add_action('save_post','create_webisode_thumbnails');
add_action('init','webseries_fields');
add_theme_support( 'post-thumbnails' );

// TODO:
// Add a function wherein on save, the uploaded images are resized.

function gc_webisodes() {
    $args = array(
        'public' => true,
        'description' => 'Webisodes',
        'exclude_from_search' => false,
        'has_archive' => true,
        // 'supports' => array('title','page-attributes'),
        'labels' => array(
            'name' => 'GC Webisodes',
            'singular_name' => 'GC Webisode',
            'menu_name' => 'GC Webisode',
            'name_admin_bar' => 'Add New GC Webisode',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New GC Webisode',
            'edit_item' => 'Edit GC Webisode',
            'new_item' => 'New GC Webisode',
            'view_item' => 'View GC Webisode',
            'search_items' => 'Search GC Webisode',
            'not_found' => 'No GC Webisode Found',
            'not_found_in_trash' => 'No GC Webisode found in trash',
            'parent_item_colon' => 'Parent GC Webisodes:',
            'edit' => 'Edit',
            'view' => 'View',
        ),
        'map_meta_cap' => true,
        'capability_type' => array('webisode','webisodes'),
        'capabilities' => array(
          'publish_posts' => 'publish_s',
          'edit_published_posts' => 'edit_published_webisodes',
          'delete_published_posts' => 'delete_published_webisodes',
          'edit_posts' => 'edit_webisodes',
          'edit_others_posts' => 'edit_other_webisodes',
          'delete_posts' => 'delete_webisodes',
          'delete_others_posts' => 'delete_others_webisodes',
          'read_private_posts' => 'read_private_webisodes',
          'edit_post' => 'edit_webisode',
          'delete_post' => 'delete_webisode',
          'read_post' => 'read_webisodes'
        ),
        // 'query_var' => 'gcwebisodes',
        'rewrite' => array('slug' => 'webisode'),
        'menu_position' => 10,
    );
    register_post_type('webisodes',$args);
}

function gc_products() {
    $args = array(
        'public' => true,
        'description' => 'GC Products',
        'exclude_from_search' => false,
        'has_archive' => true,
        'supports' => array(
            'title',
            'thumbnail',
        ),
        'labels' => array(
            'name' => 'GC Products',
            'singular_name' => 'GC Product',
            'menu_name' => 'GC Product',
            'name_admin_bar' => 'Add New GC Product',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New GC Product',
            'edit_item' => 'Edit GC Product',
            'new_item' => 'New GC Product',
            'view_item' => 'View GC Product',
            'search_items' => 'Search GC Product',
            'not_found' => 'No GC Product Found',
            'not_found_in_trash' => 'No GC Product found in trash',
            'parent_item_colon' => 'Parent GC Products:',
            'edit' => 'Edit',
            'view' => 'View',
        ),
        'map_meta_cap' => true,
        'capability_type' => array('gcproduct','gcproducts'),
        'capabilities' => array(
          'publish_posts' => 'publish_gcproducts',
          'edit_published_posts' => 'edit_published_gcproducts',
          'delete_published_posts' => 'delete_published_gcproducts',
          'edit_posts' => 'edit_gcproducts',
          'edit_others_posts' => 'edit_other_gcproducts',
          'delete_posts' => 'delete_gcproducts',
          'delete_others_posts' => 'delete_others_gcproducts',
          'read_private_posts' => 'read_private_gcproducts',
          'edit_post' => 'edit_gcproduct',
          'delete_post' => 'delete_gcproduct',
          'read_post' => 'read_gcproducts'
        ),
        'query_var' => 'gcproducts',
        'rewrite' => array('slug' => 'gcproduct'),
        'menu_position' => 15,
    );
    register_post_type('gcproducts',$args);
    // flush_rewrite_rules();
}

function webseries_fields() {
    // Artist Info
    if(function_exists("register_field_group")) {
        $artist_fields = array (
         'id' => 'acf_webseries',
         'title' => 'Webseries',
         'fields' => array (
             array (
                 'key' => 'artist',
                 'label' => 'Artist',
                 'name' => '',
                 'type' => 'tab',
             ),
             array (
                 'key' => 'site',
                 'label' => 'Site',
                 'name' => 'site',
                 'type' => 'text',
                 'instructions' => 'Enter artist\'s web page.',
                 'default_value' => '',
                 'placeholder' => '',
                 'prepend' => '',
                 'append' => '',
                 'formatting' => 'none',
                 'maxlength' => '',
             ),
             array (
                 'key' => 'description',
                 'label' => 'Description',
                 'name' => 'description',
                 'type' => 'textarea',
                 'default_value' => '',
                 'placeholder' => '',
                 'maxlength' => '',
                 'rows' => '3',
                 'formatting' => 'br',
             ),
             array (
                 'key' => 'main_image',
                 'label' => 'Main Image',
                 'name' => 'main_image',
                 'type' => 'image',
                 'instructions' => 'Upload image size 1600x800 only.',
                 'required' => 1,
                 'save_format' => 'url',
                 'preview_size' => 'medium',
                 'library' => 'all',
             ),
             array (
                 'key' => 'thumbnail_image',
                 'label' => 'Thumbnail Image',
                 'name' => 'thumbnail_image',
                 'type' => 'image',
                 'instructions' => 'Upload image size 400x200 (optionally the main Webseries photo).',
                 'required' => 1,
                 'save_format' => 'url',
                 'preview_size' => 'medium',
                 'library' => 'all',
             ),             
             array (
                 'key' => 'gallery',
                 'label' => 'Gallery',
                 'name' => '',
                 'type' => 'tab',
             ),
             array (
                 'key' => 'photos',
                 'label' => 'Photos',
                 'name' => 'photos',
                 'type' => 'repeater',
                 'instructions' => 'Upload image size 1600x800 only.',
                 'sub_fields' => array (
                     array (
                         'key' => 'name',
                         'label' => 'Name',
                         'name' => 'name',
                         'type' => 'text',
                         'column_width' => '',
                         'default_value' => '',
                         'placeholder' => '',
                         'prepend' => '',
                         'append' => '',
                         'formatting' => 'html',
                         'maxlength' => '',
                     ),
                     array (
                         'key' => 'photo',
                         'label' => 'Photo',
                         'name' => 'photo',
                         'type' => 'image',
                         'column_width' => '',
                         'save_format' => 'url',
                         'preview_size' => 'medium',
                         'library' => 'all',
                     ),
                 ),
                 'row_min' => '',
                 'row_limit' => '',
                 'layout' => 'table',
                 'button_label' => 'Add Row',
             ),
             array (
                 'key' => 'videos_tab',
                 'label' => 'Videos',
                 'name' => '',
                 'type' => 'tab',
             ),
             array (
                 'key' => 'videos',
                 'label' => 'Videos',
                 'name' => 'videos',
                 'type' => 'repeater',
                 'instructions' => 'Limit only to three (3) videos',
                 'sub_fields' => array (
                     array (
                        'key' => 'video_type',
                        'label' => 'Video Type',
                        'name' => 'video_type',
                        'type' => 'select',
                        'column_width' => '',
                        'choices' => array (
                            'youtube' => 'Youtube',
                            'vevo' => 'Vevo',
                        ),
                        'default_value' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                     ),
                     array (
                         'key' => 'video_title',
                         'label' => 'Title',
                         'name' => 'title',
                         'type' => 'text',
                         'column_width' => '',
                         'default_value' => '',
                         'placeholder' => '',
                         'prepend' => '',
                         'append' => '',
                         'formatting' => 'html',
                         'maxlength' => 100,
                     ),
                     array (
                         'key' => 'video_url',
                         'label' => 'Video Code',
                         'name' => 'video_url',
                         'type' => 'text',
                         'instructions' => 'Only the video code, not the URL. Youtube only, please.',
                         'column_width' => '',
                         'default_value' => '',
                         'placeholder' => '',
                         'prepend' => 'http://www.youtube.com/embed/',
                         'append' => '',
                         'formatting' => 'none',
                         'maxlength' => '',
                     ),
                 ),
                 'row_min' => '',
                 'row_limit' => '',
                 'layout' => 'table',
                 'button_label' => 'Add Row',
             ),
             array (
                 'key' => 'album',
                 'label' => 'Album',
                 'name' => '',
                 'type' => 'tab',
             ),
             array (
                 'key' => 'album_title',
                 'label' => 'Album Title',
                 'name' => 'album_title',
                 'type' => 'text',
                 'default_value' => '',
                 'placeholder' => '',
                 'prepend' => '',
                 'append' => '',
                 'formatting' => 'none',
                 'maxlength' => '',
             ),
             array (
                 'key' => 'album_link',
                 'label' => 'Album Link',
                 'name' => 'album_link',
                 'type' => 'text',
                 'instructions' => 'Set the album link to iTunes (complete URL)',
                 'default_value' => '',
                 'placeholder' => '',
                 'prepend' => '',
                 'append' => '',
                 'formatting' => 'none',
                 'maxlength' => '',
             ),
             array (
                 'key' => 'album_thumbnail',
                 'label' => 'Album Thumbnail',
                 'name' => 'album_thumbnail',
                 'type' => 'image',
                 'instructions' => 'Add image size 150x150 only.',
                 'save_format' => 'url',
                 'preview_size' => 'large',
                 'library' => 'all',
             ),
         ),
         'location' => array (
             array (
                 array (
                     'param' => 'post_type',
                     'operator' => '==',
                     'value' => 'webisodes',
                     'order_no' => 0,
                     'group_no' => 0,
                 ),
             ),
         ),
         'options' => array (
             'position' => 'normal',
             'layout' => 'default',
             'hide_on_screen' => array (
                 0 => 'the_content',
                 1 => 'discussion',
                 2 => 'comments',
                 3 => 'format',
                 4 => 'featured_image',
                 5 => 'categories',
                 6 => 'tags',
                 7 => 'send-trackbacks',
             ),
         ),
         'menu_order' => 0,
        );
        register_field_group($artist_fields);
    }

    // Season Info
    if(function_exists("register_field_group")) {
        $season_info = array (
            'id' => 'acf_webisode',
            'title' => 'Webisode',
            'fields' => array (
                 array (
                     'key' => 'season',
                     'label' => 'Season',
                     'name' => 'season',
                     'type' => 'text',
                     'default_value' => '',
                     'placeholder' => '',
                     'prepend' => '',
                     'append' => '',
                     'formatting' => 'none',
                     'maxlength' => '',
                 ),
                 array (
                     'key' => 'episode',
                     'label' => 'Episode',
                     'name' => 'episode',
                     'type' => 'text',
                     'default_value' => '',
                     'placeholder' => '',
                     'prepend' => '',
                     'append' => '',
                     'formatting' => 'none',
                     'maxlength' => '',
                 ),
                array (
                    'key' => 'is_featured',
                    'label' => 'Is Featured?',
                    'name' => 'is_featured',
                    'type' => 'select',
                    'choices' => array (
                        'No',
                        'Yes'
                    ),
                    'default_value' => "1",
                    'layout' => 'vertical',
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'webisodes',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'side',
                'layout' => 'default',
                'hide_on_screen' => array (
                    0 => 'the_content',
                    1 => 'discussion',
                    2 => 'comments',
                    3 => 'format',
                    4 => 'featured_image',
                    5 => 'categories',
                    6 => 'tags',
                    7 => 'send-trackbacks',
                ),
            ),
            'menu_order' => 0,
        );
        register_field_group($season_info);
    }

    if(function_exists("register_field_group")) {
        $gcproduct_url = array (
            'id' => 'acf_gc-products-url',
            'title' => 'GC Products URL',
            'fields' => array (
                array (
                    'key' => 'product_url',
                    'label' => 'GC Product URL',
                    'name' => 'url',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'html',
                    'maxlength' => '',
                ),
                 array (
                     'key' => 'product_description',
                     'label' => 'Product Description',
                     'name' => 'product_description',
                     'type' => 'textarea',
                     'default_value' => '',
                     'placeholder' => '',
                     'prepend' => '',
                     'append' => '',
                     'formatting' => 'none',
                     'maxlength' => '',
                 ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'gcproducts',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array (),
            ),
            'menu_order' => 0,
        );
        register_field_group($gcproduct_url);
    }
}

function get_artist_image($image_type,$post_id) {
    $image_id = null;
    switch($image_type) {
        case 'album_thumbnail':
            $image_id = get_post_meta($post_id,'album_thumbnail',true);
            break;
        case 'main_image':
            $image_id = get_post_meta($post_id,'main_image',true);
            break;
        case 'thumbnail_image':
            $image_id = get_post_meta($post_id,'thumbnail_image',true);
        default:
            break;
    }
    return wp_get_attachment_url($image_id);
}

function get_artist_thumbnail($artist_id,$artist_slug) {
    if (phpversion >= "5.5.11" || is_null($artist_id)) {
        $image_url = get_stylesheet_directory_uri() . "/images/webisodes/" . $artist_slug . ".jpg";
    } else {
        $image_url = get_artist_image($artist_id);
    }
    return $image_url;
}


function get_videos() {
    $videos = array();
    for ($i=0;$i<=20;$i++) {
        $video['video'] = wp_get_attachment_url(get_post_meta($post_id,'videos_'. $i .'_video',true));
        $video['name'] = get_post_meta($post_id,'videos_'. $i .'_name',true);
        if (!empty($video['video']) || !empty($video['name'])) {
            array_push($videos,$video);
        }
    }
    return $videos;
}

function get_gallery($post_id) {
    $photos = array();
    for ($i=0;$i<=20;$i++) {
        $photo['photo'] = wp_get_attachment_url(get_post_meta($post_id,'photos_'. $i .'_photo',true));
        $photo['name'] = get_post_meta($post_id,'photos_'. $i .'_name',true);
        if (!empty($photo['photo']) || !empty($photo['name'])) {
            array_push($photos,$photo);
        }
    }
    return $photos;
}



/* Photo Gallery */
function get_images($post_id) {
    $images = array();
    for ($i=0;$i<=20;$i++) {
        $image_id = get_post_meta($post_id,'images_'. $i .'_image',true);
        $image['image'] = wp_get_attachment_url($image_id);
        $thumbnail_id = get_post_meta($post_id,'images_'. $i .'_image_thumbnail',true);
        $image['thumbnail'] = wp_get_attachment_url($thumbnail_id);
        $image['title'] = get_post_meta($post_id,'images_'. $i .'_image_title',true);
        if (!empty($image['image']) || !empty($image['thumbnail']) || !empty($image['title'])) {
            array_push($images,$image);
        }
    }
    return $images;
}

/* Products */
function get_product_description($post_id) {
    return get_post_meta($post_id,'product_description',true);
}

function get_product_link($post_id) {
    return get_post_meta($post_id,'url',true);
}

function get_thumbnail($post_id) {
    return wp_get_attachment_url(get_post_thumbnail_id($post_id));
}


/* Webisode REST */
function get_webisode_json($webisodes,$has_pager) {
    foreach($webisodes as $webisode) {
        $webisode->thumbnail_image = get_artist_image('thumbnail_image',$webisode->ID);
        $webisode->episode = get_post_meta($webisode->ID,'episode',true);
    }
    $posts['webisodes'] = $webisodes;
    if ($has_pager) {
        $posts['pager']['previous'] = get_previous_webisode($webisode->episode);
        $posts['pager']['next'] = get_next_webisode($webisode->episode);
        $posts['pager']['last_page'] = get_last_page();
    }
    return json_encode($posts);
}

function get_previous_webisode($current_webisode) {
    $last_page = get_last_page();
    $page = ($current_webisode==1) ? $last_page : $current_webisode - 1;
    return $page;
}

function get_next_webisode($current_webisode) {
    $last_page = get_last_page();
    $page = ($current_webisode==$last_page) ? 1 : $current_webisode + 1;
    return $page;
}

function get_last_page() {
    $posts = get_webisodes(0,-1,false);
    $last_page = sizeof(get_posts($posts));
    return $last_page;
}

function get_webisodes($start,$number_of_posts,$is_pager) {
    $args = array(
        'posts_per_page'   => $number_of_posts,
        'offset'           => $start,
        'meta_key'         => 'episode',
        'orderby'          => 'meta_value_num',
        'order'            => $is_pager ? 'ASC' : 'DESC',
        'include'          => '',
        'exclude'          => '',
        'post_type'        => 'webisodes',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'           => '',
        'post_status'      => 'publish',
        'suppress_filters' => true
    );
    return $args;
}


/* Featured Webseries */
function set_featured_webseries() {
    global $post;
    $current_webseries_id = get_site_option('featured_webseries');
    $post_is_featured = get_post_meta($post->ID,'is_featured',true);

    if ($post_is_featured==1) { // If published post is_featured
        update_option('featured_webseries',$post->ID,'yes'); // Update the featured_webseries
        update_post_meta($current_webseries_id,'is_featured',0); // Update is_featured value of "current" featured_webseries to "No" or 0
        update_post_meta($post->ID,'is_featured',1); // Update is_featured of current_webseries to "Yes" or 1
    }
}

function create_webisode_thumbnails() {
    global $post;
    $artist_slug = $post->post_name;
    $filename = wp_get_attachment_url(get_post_meta($post->ID,'main_image',true));
    $write_filename = get_stylesheet_directory() . "/images/webisodes/" . $post->post_name . ".jpg";
    $percent = 0.25;

    // Get new dimensions
    list($width, $height) = getimagesize($filename);
    $new_width = $width * $percent;
    $new_height = $height * $percent;

    // Resample
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    // Output
    imagejpeg($image_p, $write_filename, 100); // Change null to target filename.
    imagedestroy($image_p);
    return 1;
}

// function get_episode_number($post_id) {
//     return get_post_meta($post_id,'episode',true);
// }

// function isCurrentEpisode($episodeId,$post_id) {
//     $episodeNumber = get_episode_number($episodeId);
//     $currentEpisodeNumber = get_episode_number($post_id);
//     return $episodeNumber === $currentEpisodeNumber ? true : false;
// }

// function get_previous_episode_number($currentEpisodeNumber,$episodes_count) {
//     $episodeNumber = ($currentEpisodeNumber-1) <=0 ? $episodes_count : $currentEpisodeNumber - 1;
//     return $episodeNumber;
// }

// function get_next_episode_number($currentEpisodeNumber,$episodes_count) {
//     $episodeNumber = ($currentEpisodeNumber+1) > $episodes_count ? 1 : $currentEpisodeNumber + 1;
//     return $episodeNumber;
// }

// function get_last_episode_number($webisodes) {
//     return count($webisodes);
// }

// function get_webisode_permalink($episodeNumber) {
//     global $wpdb;
//     $results = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$episodeNumber'");
//     return get_permalink($results[0]->post_id);
// }

// function get_episode_info($post_id,$episodeId,$episodeNumber,$episodes_count) {
//     if ($post_id==$episodeId) {
//         return "Episode " . $episodeNumber . " of " . $episodes_count . " ";
//     }
// }


/* Debugger */
function add_debugger_screen() {
    global $post;
    $featured_id = get_site_option('featured_webseries');
    // echo set_featured_webseries() . "<br/>";
    echo "<b>Artist ID:</b> " . $featured_id . "<br/>";
    echo "<b>Artist Name:</b> " . get_the_title($featured_id) . "<br/>";
    echo "<b>Image:</b> " . print_r(create_webisode_thumbnails()) . "<br/>";
}

function add_debugger_meta_box() {
    add_meta_box('debugger',__('Current Webseries','add_debugger_screen'),'add_debugger_screen','webisodes');
}

add_action('add_meta_boxes','add_debugger_meta_box');

