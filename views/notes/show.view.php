<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main class="mx-auto mt-16 max-w-xl sm:mt-20">
    <a href="/notes" class="note-back-link flex items-center mb-3 pb-2 gap-3 hover:text-sky-700">
        <span class="material-symbols-outlined">
            keyboard_backspace
        </span>
        <span>Go Back to Watchlist</span></a>
    <h1 class="text-4xl font-bold mb-5">
        <?= htmlspecialchars($note['title']) ?>
    </h1>
    <div>
        <div class="flex gap-2 items-center mb-4">
            <h2 class="text-2xl">
                Overview Synopsis
            </h2>
        </div>

        <div>
            <?= nl2br($note['synopsis']) ?>
        </div>

        <div class="create-list mt-10 flex gap-3">
            <a href="/notes/edit" class="px-8 py-4 bg-sky-600 hover:bg-sky-700 text-white hover:text-white">Edit this
                list</a>
            <a href="/notes" class="px-8 py-4 bg-red-700  hover:bg-red-900 text-white hover:text-white">Delete this
                List</a>
        </div>
    </div>
</main>



<?php require base_path('views/partials/footer.php') ?>