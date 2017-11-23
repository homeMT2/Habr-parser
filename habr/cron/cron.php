<?php
session_start();

// https://habrahabr.ru/post/132609/

$num_starts = 60;
$hours = 1;
$time_sec = $hours * 3600;
$time_to_start = array();
ignore_user_abort(1);

function add_time2start() {
    global $time_sec, $time_to_start;
    $new_time = time()+rand(0, $time_sec);
    if (!in_array($new_time, $time_to_start)) {
        $time_to_start[] = $new_time;
    } else {
        add_time2start();
    }
}

$k = 1;
if ($_SESSION["num_st"] == "" || $_SESSION["num_st"][$num_starts-1] < time()) {

    do {
        add_time2start();
        $k++;
    }
    while ($k <= $num_starts);

    sort($time_to_start, SORT_NUMERIC);
    $_SESSION["num_st"] = $time_to_start;
}

$start_time = microtime();
$start_array = explode(" ",$start_time);
$start_time = $start_array[1];
$max_exec = ini_get("max_execution_time");

do {
    $nowtime = time();

    if (in_array($nowtime, $_SESSION["num_st"])) {

        $http = fsockopen('http://localhost:8888/habr/',80);

        fputs($http, "GET http://localhost:8888/habr/get?".session_name()."=".session_id()."&nowtime=$nowtime HTTP/1.0\r\n");
        fputs($http, "Host: http://localhost:8888/habr/\r\n");
        fputs($http, "\r\n");
        fclose($http);
    }

    $now_time = microtime();
    $now_array = explode(" ",$now_time);
    $now_time = $now_array[1];

    $exec_time = $now_time - $start_time + $exec_time;

    usleep(1000000);

    if ( file_exists("stop.txt") ) exit;

}

while($exec_time < ($max_exec - 5));

$http = fsockopen('test.ru',80);

fputs($http, "GET http://localhost:8888/habr/get?".session_name()."=".session_id()."&bu=$max_exec HTTP/1.0\r\n");
fputs($http, "Host: http://localhost:8888/habr/\r\n");
fputs($http, "\r\n");
fclose($http);