<?php

$pageName = 'Movies';

$config = require 'config.php';
$db = new Database($config['database']);

$notes = $db->query('select * from posts where author = 2', [])->get();

require 'views/notes/index.view.php';