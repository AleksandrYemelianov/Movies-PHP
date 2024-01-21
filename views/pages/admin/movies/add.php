<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var array<\App\Models\CategoryModel> $categories
 * */
?>

<?php $view->component('start'); ?>
<main>
    <div class="container">
        <h3 class="mt-3">Add Movie</h3>
        <hr>
    </div>
    <div class="container">
        <form action="/admin/movies/add" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input
                                type="text"
                                class="form-control <?php echo $session->has('name') ? 'is-invalid' : ''?>"
                                id="name"
                                name="name"
                                placeholder="The Matrix"
                        >
                        <label for="name">Name</label>
                        <?php if ($session->has('name')) {?>
                            <div id="name" class="invalid-feedback">
                                <?php echo $session->getFlash('name')[0]?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <textarea
                                style="height: 100px; resize: none"
                                type="text"
                                class="form-control <?php echo $session->has('description') ? 'is-invalid' : ''?>"
                                name="description"
                                id="description"
                                placeholder="A film about..."
                        ></textarea>
                        <label for="description">Description</label>
                        <?php if ($session->has('description')) { ?>
                            <div id="description" class="invalid-feedback">
                                <?php echo $session->getFlash('description')[0] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label>
                        <input
                                type="file"
                                class="form-control"
                                id="image"
                                name="image"
                        >
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <select class="form-select" name="categories">
                    <option selected disabled>Genres</option>
                    <?php foreach ($categories as $category) {?>
                        <option value="<?php echo $category->getId()?>"><?php echo $category->getName()?></option>
                    <?php }?>
                </select>
            </div>
                <button class="btn btn-primary">Add Movie</button>
            </div>
        </form>
    </div>

</main>
<?php $view->component('end'); ?>
