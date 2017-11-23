<?php

/* $_POST */
function post( $key, $value = '' ) {
    if( isset( $_POST[ $key ] ) ) {
        return $_POST[ $key ];
    }
    else {
        return $value;
    }
}

/* $_GET */
function get( $key, $value = '' ) {
    if( isset( $_GET[ $key ] ) ) {
        return $_GET[ $key ];
    }
    else {
        return $value;
    }
}


/* Get url */
function helper_url() {
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}

function helper_url_way() {
    $url = helper_url_array();
    $url_string = '';

    foreach( $url as $value ) {
        $url_string .= '/';
        $url_string .= $value;
    }

    return $url_string;
}

function helper_url_array() {
    $url = parse_url( helper_url(), PHP_URL_PATH );
    $url = substr( $url, 1 );
    $url = explode( '/', $url );
    unset( $url[0] );

    return $url;
}

function helper_url_section( $id = 0 ) {
    $url = helper_url_array();
    return $url[ $id ];
}

function russian_date_to_seconds( $date ) {

    $new_date = $date;
    $new_date = str_replace( ' в ', ' ', $new_date );

    $months = array(
        array( 'December',  'декабря'),
        array( 'November',  'ноября'),
        array( 'October',   'октября'),
        array( 'September', 'сентября'),
        array( 'August',    'августа'),
        array( 'July',      'июля'),
        array( 'June',      'июня'),
        array( 'May',       'мая'),
        array( 'April',     'апреля'),
        array( 'March',     'марта'),
        array( 'February',  'февраля'),
        array( 'January',   'января'),
    );

    foreach( $months as $item ) {
        if( stristr( $date, $item[1] ) !== FALSE ) {
            $new_date = str_replace( $item[1], $item[0] . ' + ', $new_date );
            $new_date = str_replace( ':', ' hours ', $new_date );
            $new_date .= ' minutes';

            return strtotime( $new_date ) + 3600;
        }
    }

    $days = array(
        array( 'сегодня',   date( 'd F' ) ),
        array( 'вчера',     date( 'd F', time() - 1 * 24 * 3600 ) )
    );

    foreach( $days as $day ) {
        if( stristr( $date, $day[0] ) !== FALSE ) {

            $new_date = str_replace( $day[0], $day[1] . ' + ', $new_date );

            $new_date = str_replace( ':', ' hours ', $new_date );
            $new_date .= ' minutes';

            return strtotime( $new_date ) + 3600;
        }
    }

    return time();
}

/* Show */
function helper_show( $array = array() ) {
    echo '<br>';
    echo '~~~';
    echo '<pre>';
    print_r( $array );
    echo '<pre>';
    echo '~~~';
    echo '<br>';
}
