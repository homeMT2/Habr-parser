<?php
/*
 * Database
 * */

/* SQL Connect */
function sql_connect() {

    $mysqli = new mysqli(
        config('db_host'),
        config('db_user'),
        config('db_pass'),
        config('db_name')
    );

    if ( $mysqli->connect_errno ) {
        return FALSE;
    }

    return $mysqli;
}

/* INSERT Post */
function sql_insert_post( $post ) {

    $mysqli = sql_connect();

    if( $mysqli != FALSE ) {

        $sql = "INSERT INTO post
                  ( post_id,
                    url,
                    tags,
                    post_publish,
                    post_add,
                    title,
                    content
                  )
                VALUES
                  ( '" . $post['post_id'] . "',
                    '" . $post['url'] . "',
                    '" . $post['tags'] . "',
                    '" . $post['time'] . "',
                    '" . $post['add'] . "',
                    '" . $post['title'] . "',
                    '" . $post['content'] . "'
                  );";

        $result = $mysqli->query($sql);
        $id = $mysqli->insert_id;
        $mysqli->close();

        if ($result === TRUE) {
            return $id;
        }
        else {
            return FALSE;
        }

    }
    else {
        return FALSE;
    }
}

/* INSERT Tag */
function sql_insert_tag( $tag_name ) {

    $mysqli = sql_connect();

    if( $mysqli != FALSE ) {

        $sql = "INSERT INTO tag
                  (
                    tag_name
                  )
                VALUES
                  (
                    '" . $tag_name . "'
                  )";

        $result = $mysqli->query($sql);
        $id = $mysqli->insert_id;
        $mysqli->close();

        if ( $result === TRUE ) {
            return $id;
        }
        else {
            return FALSE;
        }

    }
    else {
        return FALSE;
    }
}

function sql_order( $order ) {
    if( $order != '' ) {
        return ' ORDER BY post_publish ' . $order;
    }
    else {
        return '';
    }
}

/* SELECT All Post */
function sql_select_all_posts( $attr = array() ) {

    $mysqli = sql_connect();

    if( $mysqli != FALSE ) {

        $sql = "SELECT * FROM post";
        $sql .= sql_order( $attr['date'] );
        $sql .= ';';

        $result = $mysqli->query($sql);
        $mysqli->close();

        if ($result->num_rows > 0) {

            $array = array();

            while($row = $result->fetch_assoc()) {
                array_push( $array, $row );
            }

            return $array;
        }
        else {
            return FALSE;
        }
    }
    else {
        return FALSE;
    }


}

/* SELECT Post by id */
function sql_select_post_by_id( $id ) {

    $mysqli = sql_connect();

    if( $mysqli != FALSE ) {

        $sql = "SELECT * FROM post WHERE id = '" . $id . "'";

        $result = $mysqli->query($sql);

        $mysqli->close();

        if ($result->num_rows > 0) {

            $array = array();

            while ($row = $result->fetch_assoc()) {
                $array = $row;
            }

            return $array;
        }
        else {
            return FALSE;
        }
    }
    else {
        return FALSE;
    }
}

/* SELECT Post by HABR post_id */
function sql_select_post_by_habr_id( $habr_post_id ) {

    $mysqli = sql_connect();

    if( $mysqli != FALSE ) {

        $sql = "SELECT * FROM post WHERE post_id = '" . $habr_post_id . "'";

        $result = $mysqli->query($sql);

        $mysqli->close();

        if ($result->num_rows > 0) {

            $array = array();

            while ($row = $result->fetch_assoc()) {
                $array = $row;
            }

            return $array;
        }
        else {
            return FALSE;
        }
    }
    else {
        return FALSE;
    }
}

/* SELECT Tag by name */
function sql_select_tag_by_name( $tag_name ) {

    $mysqli = sql_connect();

    if( $mysqli != FALSE ) {
        $sql = "SELECT * FROM tag WHERE tag_name = '" . $tag_name . "'";

        $result = $mysqli->query($sql);
        $mysqli->close();

        if ($result->num_rows > 0) {

            $array = array();

            while ($row = $result->fetch_assoc()) {
                $array = $row;
            }

            return $array;
        }
        else {
            return FALSE;
        }
    }
    else {
        return FALSE;
    }
}

/* SELECT Tag by name */
function sql_select_tag_by_id( $id ) {

    $mysqli = sql_connect();

    if( $mysqli != FALSE ) {
        $sql = "SELECT * FROM tag WHERE id = '" . $id . "'";

        $result = $mysqli->query($sql);
        $mysqli->close();

        if ($result->num_rows > 0) {

            $array = array();

            while ($row = $result->fetch_assoc()) {
                $array = $row;
            }

            return $array;
        }
        else {
            return FALSE;
        }
    }
    else {
        return FALSE;
    }
}