<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>


<?php $view->component(name: 'start')?>
    <h1>Login</h1>
    <?php if ($session->has('error')) {?>
    <p style="color: red; font-size: 12px; font-weight: bold">
        <?php echo $session->getFlash('error')?>
    </p>
    <?php }?>

    <form action="/login" method="post">
        <p>Email</p>
        <input type="email" name="email">

        <p>Password</p>
        <input type="password" name="password">
        <div>
            <button>Login</button>
        </div>
    </form>
<?php $view->component(name: 'end')?>