<?php

require "./vendor/autoload.php";
use App\Entities\PostEntity;
use App\Models\Post;    
use App\Models\User;
use App\Models\setting;

$post = new PostEntity([
    'id' => '9',
    'title' => 'this is a title 10',
    'content' => 'my content',
    'date' => date('Y-m-d H:i:s'),
    'category' => 'sport',
    'image' => './images/9.jpeg',
    'view' => '2554'
]);
$model = new Post() ;
$model->editData($post);

