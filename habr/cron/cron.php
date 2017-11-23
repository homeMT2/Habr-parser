<?php
session_start();

include_once '../config/config.php';

$cron_time = filemtime("cron_time");

if ( time()-$cron_time >= config( 'cron_interval' ) ) {
    file_put_contents( 'cron_time', '' );
    save_posts();
}