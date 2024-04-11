<?php

use Core\App;
use Core\Database;

$pageTitle = 'Movies';

$db = App::resolve(Database::class);

$notes = $db->query('select * from posts where author = 2', [])->get();

require view('notes/index.view.php', [
    'notes' => $notes,
]);