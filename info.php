<?php

$dates = Array (
    "2014-09-01" => "73206",
    "2014-09-17" => "73205",
    "2014-10-01" => "73206",
    "2014-10-17" => "73207",
    "2014-11-01" => "73208",
    "2014-11-18" => "73209",
    "2014-12-01" => "73210",
    "2014-12-18" => "73209",
    "2014-12-18" => "73208",
    "2014-01-01" => "73209",
    "2014-01-19" => "73210",
    "2014-02-01" => "73211",
    "2014-02-19" => "73210"
);


function getMounthFirstDates($dates) {

    $results = [];

    foreach ($dates as $key => $value) {
        $getdate=date('d',strtotime($key));
        if($getdate=='01' || $getdate=='1'){
            $results[$key] = $value;
        }

    }

    return $results;

}

print_r(getMounthFirstDates($dates));
