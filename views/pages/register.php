<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>


<?php $view->component(name: 'start')?>
    <h1>Register</h1>

    <form action="/register" method="post">
        <p>Email</p>
        <input type="email" name="email">
        <?php if ($session->has('email')) {?>
            <ul style="color: red; font-size: 12px; font-weight: bold">
                <?php foreach ($session->getFlash('email') as $error) {?>
                    <li><?= $error; ?></li>
                <?php }?>
            </ul>
        <?php }?>
        <p>Password</p>
        <input type="password" name="password">
        <?php if ($session->has('password')) {?>
            <ul style="color: red; font-size: 12px; font-weight: bold">
                <?php foreach ($session->getFlash('password') as $error) {?>
                    <li><?= $error; ?></li>
                <?php }?>
            </ul>
        <?php }?>
        <div>
            <button>Register</button>
        </div>
    </form>
<?php $view->component(name: 'end')?>