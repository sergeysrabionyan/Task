<?php require_once __DIR__ . '/header.php' ?>
    <div style="text-align: center;">
        <h1>Регистрация</h1>
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>
        <form action="newReg" method="post">
            <label>Дата рождения <input type="date" name="date" value="<?= $_POST['date'] ?? '' ?>"></label>
            <br><br>
            <label>Логин <input type="text" name="login" value="<?= $_POST['login'] ?? '' ?>"></label>
            <br><br>
            <label>Пароль <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
            <br><br>
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
<?php require_once __DIR__ . '/footer.php' ?>