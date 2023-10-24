<?php
use Core\Session;



view('register.view.php', [
  'errors' => Session::get('errors') ?? [],
  'old' => Session::get('old') ?? [],

]);