<?php


class SitestudioVue
{

    public function __construct()
    {
        ///add_action('init', [$this, 'remove_redirects']);
        add_action('after_setup_theme', [$this, 'nav_walker']);
        add_theme_support('title-tag');
      //  remove_action('template_redirect', 'redirect_canonical');
        add_action('wp_enqueue_scripts', [$this, 'scripts_styles']);
        if (version_compare(get_bloginfo('version'), '4.7') >= 0) {
            require get_template_directory() . '/includes/back-compat.php';
            return;
        }
    }


    public function scripts_styles()
    {
        wp_enqueue_style('cssmenu-styles', get_template_directory_uri() . '/dist/app.css');
        wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
        wp_enqueue_style('sasa', 'https://blackrockdigital.github.io/startbootstrap-clean-blog/css/clean-blog.min.css');
        wp_enqueue_script('Vuejs', get_template_directory_uri() . '/dist/app.js', '', null, true);
    }

    function nav_walker()
    {
        require_once get_template_directory() . '/includes/walker.php';
    }

// Redirect all requests to index.php so the Vue app is loaded and 404s aren't thrown
    public function remove_redirects()
    {
       // add_rewrite_rule('^/(.+)/?', 'index.php', 'top');
    }
}

if (class_exists('SitestudioVue')) {
    new SitestudioVue();
}
register_nav_menus(
    array(
        'header-menu' => __('Header Menu', 'theme-name')
    )
);

remove_action( 'template_redirect', 'redirect_canonical' );
// Redirect all requests to index.php so the Vue app is loaded and 404s aren't thrown
function remove_redirects() {
    add_rewrite_rule( '^/(.+)/?', 'index.php', 'top' );
}
add_action( 'init', 'remove_redirects' );