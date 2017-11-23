<?php
/*
 * Parser functions
 * */

include_once config( 'file_html_parser' );

/* GET HABR Pages List */
function parser_get_pages_urls( $start = FALSE, $end = FALSE ) {

    $pages_urls = array();
    $habr_url = config( 'parse_site' ) . config( 'parse_site_page_part' );

    if( $start !== FALSE && $end !== FALSE ) {

        if( $start >= 0 && $end >= 0 && $end >= $start ) {

            for ($i = $start + 1; $i <= $end; $i++) {
                array_push( $pages_urls, $habr_url . $i . '/' );
            }

        }

        return $pages_urls;

    }
    else {
        return FALSE;
    }
}

function parser_get_posts_urls( $page_urls ) {

    if( count( $page_urls ) > 0 ) {

        $posts_urls = array();
        $find = '.post__title_link';

        foreach( $page_urls as $url ) {

            $html = file_get_html( $url )->find( $find );

            for( $i = 0; $i < count($html); $i++) {
                array_push(
                    $posts_urls,
                    $html[$i]->href
                );

            }

        }

        return $posts_urls;
    }
    else {
        return FALSE;
    }

}

function parser_get_posts( $post_urls )
{

    if (count($post_urls) > 0) {

        $posts = array();

        foreach( $post_urls as $url ) {
            array_push(
                $posts,
                parser_get_post( $url )
            );
        }

        return $posts;

    }
    else {
        return FALSE;
    }
}

function parser_get_post( $post_url ) {

    $html = file_get_html( $post_url );

    $find = array(
        'post_id'   => '.form_abuse input[name=ti]',
        'tags'      => '.post__tags-list li a',
        'title'     => '.post__title-text',
        'time'      => '.post__time',
        'content'   => '.post_full',
    );

    $tags = array();
    $html_tags = $html->find( $find['tags'] );

    for( $i = 0; $i < count( $html_tags ); $i++ ) {
        array_push(
            $tags,
            $html_tags[$i]->innertext
        );
    }

    $post = array(
        'post_id'   => $html->find( $find['post_id'] )[0]->value,
        'url'       => $post_url,
        'tags'      => $tags,
        'title'     => $html->find( $find['title'] )[0]->innertext,
        'time'      => russian_date_to_seconds( trim( $html->find( $find['time'] )[0]->innertext ) ),
        'add'       => time(),
        'content'   => htmlspecialchars( $html->find( $find['content'] )[0]->innertext, ENT_QUOTES )
    );

    return $post;
}

function parser() {

    $start = 1;
    $end = 2;

    $pages_urls = parser_get_pages_urls( $start, $end );
    $posts_urls = parser_get_posts_urls( $pages_urls );
    $posts      = parser_get_posts( $posts_urls );

    return $posts;
}