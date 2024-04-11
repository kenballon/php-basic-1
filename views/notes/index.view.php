<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main class="mx-auto mt-16 max-w-xl sm:mt-20">
    <h1 class="text-4xl font-bold mb-5">Movie Watchlist</h1>
    <div>
        <ul>
            <?php foreach ($notes as $note): ?>
            <li>
                <a href="/note?id=<?= $note['id'] ?>" class="h-full">
                    <?= htmlspecialchars($note['title']) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="create-list mt-10">
        <a href="/notes/create" class="px-8 py-4 bg-sky-600 hover:bg-sky-700 text-white hover:text-white">Add Movie to
            the
            Watchlist</a>
    </div>
</main>



<?php require base_path('views/partials/footer.php') ?>