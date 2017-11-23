<?php
/*
 * Dashboard
 * */

include_once realpath( './config' ) . '/config.php';
include_files();

global $page_result;
$way = helper_url_way();

if( $way == '/' ) {
    get_page( 'home' );
}
else if( $way == '/get' ) {
    save_posts();
    get_page( 'get' );
}
else if( $way == '/post/' . helper_url_section(2) &&
         is_numeric( helper_url_section(2) ) &&
         helper_url_section(2) > 0 )
{
    get_page( 'post' );
}
else {
    get_page( '404' );
}

function save_posts() {
    $posts = parser();

    for( $i = 0; $i < count( $posts ); $i++ ) {

        $get_post = sql_select_post_by_habr_id( $posts[$i]['post_id'] );

        if( $get_post == FALSE ) {
            $tag_ids = array();

            for( $j = 0; $j < count( $posts[$i]['tags'] ); $j++ ) {

                $get_tag = sql_select_tag_by_name( $posts[$i]['tags'][$j] );

                if( $get_tag == FALSE ) {
                    $insert_tag = sql_insert_tag( $posts[$i]['tags'][$j] );

                    if( $insert_tag != FALSE ) {
                        array_push( $tag_ids, $insert_tag );
                    }

                }
                else {
                    array_push( $tag_ids, $get_tag['id'] );
                }
            }

            $posts[$i]['tags'] = serialize( $tag_ids );

            $insert_post = sql_insert_post( $posts[$i] );

            if( $insert_post != FALSE ) {}
        }
    }
}