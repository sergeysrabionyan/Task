<?php require_once __DIR__ . '/header.php' ?>
    <div style="text-align: center;">
        <h1>Вход</h1>
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>
        <form action="login" method="post">
            <label>Логин <input type="text" name="login" value="<?= $_POST['login'] ?? '' ?>"></label>
            <br><br>
            <label>Пароль <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
            <br><br>
            <button type="submit">Вход</button>
        </form>
        <form action="register" method="post">
            <button type="submit">Зарегаться</button>
        </form>
    </div>
<?php require_once __DIR__ . '/footer.php' ?>