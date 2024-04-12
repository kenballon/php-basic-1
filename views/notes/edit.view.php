<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main class="mx-auto mt-16 max-w-xl sm:mt-20">
    <h1 class="text-4xl font-bold mb-5">
        Create a List
    </h1>
    <form method="POST" action="/note">
        
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $note['id'] ?>">

        <div class="form__inner-div py-4">
            <div class="input-parent">
                <div class="flex flex-col p-4">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" autocomplete="off" value="<?= $note['title'] ?>">
                </div>
                <div class="flex flex-col p-4">
                    <label for="synopsis">Short Description</label>
                    <textarea name="synopsis" id="synopsis"><?= $note['synopsis'] ?></textarea>
                </div>
                <div class="flex flex-col px-4 pb-4">
                    <?php if (isset($errors['title'])) : ?>
                        <p class="text-red-700 italic">
                            <?= $errors['title'] ?>
                        </p>
                    <?php endif; ?>
                    <?php if (isset($errors['synopsis'])) : ?>
                        <p class="text-red-700 italic">
                            <?= $errors['synopsis'] ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="btn-wrapper flex gap-1">
                <div class="ms-auto flex">
                    <a href="/notes">
                        <div class="p-3 rounded bg-sky-200 hover:bg-sky-400 text-primary hover:text-white mr-2">Cancel</div>
                    </a>
                    <button type="submit" class="p-3 rounded bg-sky-600 hover:bg-sky-700 text-white hover:text-white mr-2">Update</button>
                </div>
            </div>
        </div>
    </form>
</main>


<?php require base_path('views/partials/footer.php') ?>