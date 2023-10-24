<?php


$router->get('/register', 'register/create.php')->only('guest');
$router->post('/register', 'register/store.php')->only('guest');

$router->get('/login', 'login/create.php')->only('guest');
$router->post('/login', 'login/store.php')->only('guest');

$router->delete('/logout', 'logout.php')->only('auth');

//user
$router->get('/home', 'home.php')->only('auth');
$router->get('/followed-dashboard', 'followed/followedDashboard.php')->only('auth');
$router->post("/manage-followed", 'followed/manageFollowed.php')->only('auth');
$router->get('/cabinet', 'cabinet/userCabinet.php')->only('auth');
$router->post('/cabinet/upload-pic', 'cabinet/uploadPic.php')->only('auth');
$router->post('/cabinet/user-update', 'register/update.php')->only('auth');


//conversations 
$router->get('/chat', 'messaging/conversations/index.php');
$router->post('/chat/store', 'messaging/conversations/store.php');
$router->delete('/chat/delete', 'messaging/conversations/delete.php');
//messaging
$router->get('/chat/messages/{id}', 'messaging/messages/index.php');
$router->post('/chat/messages/store', 'messaging/messages/store.php');


//post 
$router->post('/post', 'post/store.php')->only('auth');
$router->delete('/post', 'post/delete.php')->only('auth');


$router->update('/post/like', 'post/like.php')->only('auth');
$router->update('/post/dislike', 'post/like.php')->only('auth');

//comment
$router->post('/comment', 'comment/store.php')->only('auth');
$router->delete('/comment', 'comment/delete.php')->only('auth');

//profile
$router->get("/user/{email}", 'profile.php')->only('auth');