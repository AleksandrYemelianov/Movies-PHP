<?php
/** @var \App\Kernel\Auth\AuthInterface $auth */
$user = $auth->user();
?>

<header style="margin-bottom: 50px">
    <?php if ($auth->check()) {?>
        <h3>user: <?= $user->getEmail() ?></h3>
        <form action="/logout" method="post">
            <button>Logout</button>
        </form>
        <hr>
    <?php }?>
</header>