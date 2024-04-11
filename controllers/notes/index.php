<?php

use Core\Database;

$pageTitle = 'Movies';

$config = require base_path('config.php');
$db = new Database($config['database']);

$notes = $db->query('select * from posts where author = 2', [])->get();

require view('notes/index.view.php', [
    'notes' => $notes,
]);