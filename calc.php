<?php

$data = file_get_contents('donate.json');

$data = json_decode($data);

$total = 0;

$users = array();

foreach ($data as $user) {
    $total += $user->amount;

    if (!empty($user->url)) {
        $user->host = parse_url($user->url, PHP_URL_HOST);
    } else {
        $user->host = null;
    }

    if (isset($users[$user->email.$user->name])) {
        $users[$user->email.$user->name]->amount += $user->amount;
    } else {
        $users[$user->email.$user->name] = $user;
    }
}
?>