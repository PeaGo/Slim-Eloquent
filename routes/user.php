<?php
require APP_PATH .'/models/User.php';
use App\Models\User as User;

$app->get('/users', function($req, $res) {
    $user = new User;
    $list = $user::all();
    // var_dump($user);
    return $res->withJson([
        'name' => 'Peago',
        'age' => '22',
        'list' => $list
    ]);
});