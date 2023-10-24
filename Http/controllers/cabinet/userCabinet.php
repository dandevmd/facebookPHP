<?php

use Core\Middleware\UserMatch;


view('userCabinet.view.php', [
  'user' => UserMatch::check($_SESSION['user'])
]);