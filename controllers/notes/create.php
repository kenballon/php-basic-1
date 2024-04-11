<?php

$pageTitle = 'Add a movie to a list';

require view('notes/create.view.php', [
    'errors' => $errors ?? [],
]);