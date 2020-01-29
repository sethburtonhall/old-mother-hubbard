<?php
// Register menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu', 'jointswp' ),   // Main nav in header
		'secondary-nav' => __( 'Secondary Menu', 'jointswp' ),   // Main nav in header
		'social-links' => __( 'Social Media Links', 'jointswp' ),
		'footer-company-links' => __( 'Footer Company Links', 'jointswp' ),
		'footer-services-links' => __( 'Footer Services Links', 'jointswp' ),
		'footer-links' => __( 'Footer Links', 'jointswp' ) // Secondary nav in footer
	)
);

// The Top Menu
function joints_top_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        // 'menu_class' => 'medium-horizontal menu',       // Adding custom nav class
        // 'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
				'items_wrap' => '%3$s',
				'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 2,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
				'thumbnail' => true,
				// 'thumbnail_attr' => array( 'class' => 'nav_thumb my_thumb', 'alt' => 'test', 'title' => 'test' ),
				'thumbnail_size' => 'medium',
				'thumbnail_link' => true,
        'walker' => new Topbar_Menu_Walker()
    ));
}

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = Array() ) {
	  $indent = str_repeat("\t", $depth);
	  $output .= "\n$indent<ul class=\"menu\"><span>\n";
	}

	function end_lvl(&$output, $depth = 0, $args = Array() ) {
	  $indent = str_repeat("\t", $depth);
	  $output .= "\n$indent</span></ul>\n";
	}

	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		// get user defined attributes for thumbnail images
		$attr_defaults = array(
			'class' => 'nav_thumb',
			'alt'   => esc_attr( $item->attr_title ),
			'title' => esc_attr( $item->attr_title )
		);
		$attr					= isset( $args->thumbnail_attr ) ? $args->thumbnail_attr : '';
		$attr					= wp_parse_args( $attr, $attr_defaults );
		$item_output 	= $args->before;
		// menu link output
		$item_output .= "\n".$indent.'<a ' . $attributes . '>'."\n";

		if(get_the_post_thumbnail( $item->object_id, ( isset( $args->thumbnail_size ) ))) {
			$item_output .= "\n".$indent.'<span class="menu_link_thumbnail">';
			$item_output .= $indent.apply_filters( 'menu_item_thumbnail', ( isset( $args->thumbnail ) && $args->thumbnail ) ? get_the_post_thumbnail( $item->object_id, ( isset( $args->thumbnail_size ) ) ? $args->thumbnail_size : 'thumbnail', $attr ) : '', $item, $args, $depth );
			$item_output .= $indent.'</span>'."\n";
		}

		$item_output .= "\n".$indent.'<span class="menu_link_title">';
		$item_output .= $indent.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $indent.'</span>'."\n";

		// menu description output based on depth
		// $item_output .= ( $args->desc_depth >= $depth ) ? '<br /><span class="sub">' . $item->description . '</span>' : '';
		// close menu link anchor
		$item_output .= "\n".$indent.'</a>'."\n".$indent;
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// The Social Links Menu
function joints_social_links() {
	wp_nav_menu(array(
  	'container' => 'false',                         // Remove nav container
  	'menu' => __( 'Social Media Links', 'jointswp' ),   	// Nav name
  	'menu_class' => 'social-links menu horizontal footer-social',      					// Adding custom nav class
  	'theme_location' => 'social-links',             // Where it's located in the theme
      'depth' => 1,                                   // Limit the depth of the nav
  	'fallback_cb' => '',
		'walker' => new Social_Media_Walker()  							// Fallback function
	));
} /* End Social Links Menu */

function joints_secondary_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => '',       			// Adding custom nav class
        'items_wrap' => '%3$s',
        'theme_location' => 'secondary-nav',        			// Where it's located in the theme
        'depth' => 1,                                   // Limit the depth of the nav
        'fallback_cb' => false                         // Fallback function (see below)
    ));
}

function joints_secondary_nav_mobile() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'button-menu',       			// Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
        'theme_location' => 'secondary-nav',        			// Where it's located in the theme
        'depth' => 1,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
				'walker' => new Secondary_Nav_Mobile_Walker()
    ));
}

class Secondary_Nav_Mobile_Walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$output .= sprintf( "\n<li><a class=\"button hollow\" href='%s'>$item->title</a></li>\n",
					$item->url,
					$item->title
			);
	}
}

function joints_footer_company_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => '',       			// Adding custom nav class
        'items_wrap' => '%3$s',
        'theme_location' => 'footer-company-links',        			// Where it's located in the theme
        'depth' => 1,                                   // Limit the depth of the nav
        'fallback_cb' => false                         // Fallback function (see below)
    ));
}

function joints_footer_services_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => '',       			// Adding custom nav class
        'items_wrap' => '%3$s',
        'theme_location' => 'footer-services-links',        			// Where it's located in the theme
        'depth' => 1,                                   // Limit the depth of the nav
        'fallback_cb' => false                         // Fallback function (see below)
    ));
}

// The Off Canvas Menu
function joints_off_canvas_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical menu accordion-menu',       			// Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Off_Canvas_Menu_Walker()
    ));
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\">\n";
    }
}

// The Footer Menu
function joints_footer_links() {
    wp_nav_menu(array(
    	'container' => 'false',                         // Remove nav container
    	'menu_class' => 'menu',      					// Adding custom nav class
    	'theme_location' => 'footer-links',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */

// Header Fallback Menu
function joints_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => '',      						// Adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                           // Before each link
        'link_after' => ''                             // After each link
	) );
}

// Footer Fallback Menu
function joints_footer_links_fallback() {
	/* You can put a default here if you like */
}

class Social_Media_Walker extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id'
    );

    function joints_get_svg( $args = array() ) {

			$socialPlatform = $args['icon'];
			$socialLower = strtolower($args['icon']);
			$socialIcons = array(
				'500px','adn','amazon','android','angellist','apple','behance','bitbucket','bitcoin','black-tie','blogger-b','btc','buysellads','cc-amex','cc-diners-club','cc-discover','cc-jcb','cc-mastercard','cc-paypal','cc-stripe','cc-visa','chrome','codepen','connectdevelop','contao','creative-commons','css3','dashcube','delicious','deviantart','digg','dribbble','dropbox','drupal','empire','expeditedssl','facebook-official','facebook-square','facebook','facebook-f','firefox','flickr','fonticons','forumbee','foursquare','ge','get-pocket','gg-circle','gg','git-square','git','github-alt','github-square','github','gittip','google-plus-square','google-plus','google-wallet','google','hacker-news','houzz','html5','instagram','internet-explorer','ioxhost','joomla','jsfiddle','lastfm-square','lastfm','leanpub','linkedin-in','linkedin-square','linkedin','linux','maxcdn','meanpath','medium','odnoklassniki-square','odnoklassniki','opencart','openid','opera','optin-monster','pagelines','paypal','pied-piper-alt','pied-piper-square','pied-piper','pinterest-p','pinterest-square','pinterest','qq','ra','rebel','reddit-square','reddit','renren','safari','sellsy','share-alt-square','share-alt','shirtsinbulk','simplybuilt','skyatlas','skype','slack','slideshare','soundcloud','spotify','stack-exchange','stack-overflow','steam-square','steam','stumbleupon-circle','stumbleupon','tencent-weibo','trello','tripadvisor','tumblr-square','tumblr','twitch','twitter-square','twitter','viacoin','vimeo-square','vimeo','vine','vk','wechat','weibo','weixin','wikipedia-w','windows','wordpress','xing-square','xing','y-combinator','yahoo','yc','yelp','youtube-play','youtube-square','youtube',
			);

			if (in_array($socialLower, $socialIcons)) {
			  $icon = $socialLower;
			} else {
				$icon = 'link';
			}

			$social_name = ucfirst(str_replace('-f', '', $icon));

			$svg = '<i class="fab fa-' . esc_attr( $icon ) . '" aria-hidden="true" title="Visit '.get_bloginfo('name').' on '.$social_name.'"><span class="sr-only">Visit '.get_bloginfo('name').' on '.$social_name.'</span></i> ';

			if($icon == 'link'){
				$svg .= $socialPlatform;
			}

			return $svg;
		}

    /**
     * At the start of each element, output a <li> and <a> tag structure.
     *
     * Note: Menu objects include url and title properties, so we will use those.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

	    $icon = $this->joints_get_svg( array( 'icon' => esc_attr( $item->title ) ) );
        $output .= sprintf( "\n<li><a href='%s' target=\"_blank\">$icon</a></li>\n",
            $item->url,
            $item->title
        );
    }
}

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
