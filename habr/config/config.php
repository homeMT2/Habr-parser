<?php
/*
 * Config
 * */

/* Defines */
define( 'PHP', '.php' );

/* Config file */
$config = array();

/* Site URL */
$config['site_url']     = 'http://localhost:8888/habr/';

/* Parsed site */
$config['parse_site']           = 'https://habrahabr.ru/all/all/';
$config['parse_site_page_part'] = 'page';
$config['parse_stop']           = 'Страница не найдена';

/* Time Format */
$config['time_format'] = 'd / F / Y G:h';

/* Directories */
$config['dir_controller']  = './controller/';
$config['dir_helper']      = './helper/';
$config['dir_assets']      = './assets/';
$config['dir_model']       = './model/';
$config['dir_view']        = './view/';
$config['dir_lib']         = './lib/';

/* Files */
$config['file_helper']          = $config['dir_helper']     . 'helper.php';
$config['file_helper_parser']   = $config['dir_helper']     . 'helper_parser.php';
$config['file_db']              = $config['dir_model']      . 'db.php';
$config['file_html_parser']     = $config['dir_lib']        . 'html_parser.php';
$config['file_support']         = $config['dir_controller'] . 'support.php';


/* Page name */
$config['page_home']    = 'home';
$config['page_post']    = 'post';
$config['page_404']     = '404';
$config['page_get']     = 'get';

/* Pages */
$config['home']     = $config['dir_view'] . $config['page_home'] . PHP;
$config['post']     = $config['dir_view'] . $config['page_post'] . PHP;
$config['404']      = $config['dir_view'] . $config['page_404']  . PHP;
$config['get']      = $config['dir_view'] . $config['page_get']  . PHP;

/* DataBase */
$config['db_name'] = 'habr';
$config['db_user'] = 'dev';
$config['db_pass'] = '12345';
$config['db_host'] = 'localhost';

function config( $key ) {

    global $config;

    if( isset( $config[ $key ] ) ) {
        return $config[ $key ];
    }
    else {
        return '';
    }
}

function get_page( $file_name ) {

    if( file_exists( config( $file_name ) ) ) {
        include config( $file_name );
    }
    else if( file_exists( config( '404' ) ) ) {
        include config('404');
    }
    else {
        echo 'Wow! 404 page not find... ';
    }

}

function include_files() {
    global $config;

    include_once $config['file_helper'];
    include_once $config['file_helper_parser'];
    include_once $config['file_db'];
    include_once $config['file_support'];
}