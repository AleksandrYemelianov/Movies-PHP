<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 */
?>


<?php $view->component(name: 'start')?>
<h1>Add movie</h1>

<form action="/admin/movies/add" method="post" enctype="multipart/form-data">
    <p>Name</p>

    <div>
        <input type="text" name="name">
    </div>
    <?php if ($session->has('name')) {?>
    <ul style="color: red; font-size: 12px; font-weight: bold">
        <?php foreach ($session->getFlash('name') as $error) {?>
            <li><?= $error; ?></li>
        <?php }?>
    </ul>
    <?php }?>
    <div>
        <input type="file" name="images">
    </div>
    <button>Add</button>
</form>
<?php $view->component(name: 'end')?>
