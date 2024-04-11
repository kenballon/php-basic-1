<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main class="mx-auto mt-16 max-w-xl sm:mt-20">
    <h1 class="text-4xl font-bold mb-5">
        Create a List
    </h1>
    <form method="POST" action="/notes" autocomplete="off">
        <div class="form__inner-div py-4">
            <div class="input-parent">
                <div class="flex flex-col p-4">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Add list..." autocomplete="off"
                        value="<?= $_POST['title'] ?? '' ?>">
                </div>
                <div class="flex flex-col p-4">
                    <label for="synopsis">Short Description</label>
                    <textarea name="synopsis" id="synopsis"
                        placeholder="short movie synopsis here..."><?= $_POST['synopsis'] ?? '' ?></textarea>
                </div>
                <div class="flex flex-col px-4 pb-4">
                    <?php if (isset($errors['title'])): ?>
                    <p class="text-red-700 italic">
                        <?= $errors['title'] ?>
                    </p>
                    <?php endif; ?>
                    <?php if (isset($errors['synopsis'])): ?>
                    <p class="text-red-700 italic">
                        <?= $errors['synopsis'] ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="btn-wrapper flex">
                <button type="submit"
                    class="ms-auto p-3 rounded bg-sky-600 hover:bg-sky-700 text-white hover:text-white mr-2">Add To
                    List</button>
            </div>
        </div>
    </form>
</main>



<?php require base_path('views/partials/footer.php') ?>