<?php

$pageTitle = 'Add a movie to a list';

view('notes/create.view.php', [
    'errors' => $errors ?? [],
]);