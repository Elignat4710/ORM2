<?php

use App\Models\PostModel;
use App\Models\UserModel;

require 'vendor/autoload.php';

//$user = new UserModel();
//$user->name = 'Max';
//$user->email = 'test@gmail.com';
//$user->save();
//
//$post = new PostModel();
//$post->title = 'title';
//$post->body = 'body';
//$post->user_id = $user->id;
//$post->save();

//$user = UserModel::find(1);
//var_dump($user);
//
//$post = new PostModel();
//$post->title = 'title 2';
//$post->body = 'body 2';
//$post->user_id = $user->id;
//$post->save();

//var_dump(PostModel::with('users', 'user_id', 'id'));
//var_dump(PostModel::with('users', 'user_id', 'id'));
var_dump(PostModel::with('users', 'user_id', 'id')->where([['title', '=', 'title 2']])->get());