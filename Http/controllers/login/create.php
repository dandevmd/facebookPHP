<?php
use Core\Session;



view('login.view.php', [
  'errors' => Session::get('errors') ?? [],
  'old' => Session::get('old') ?? [],

]);