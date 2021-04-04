<?php
if(isset($arrMessage)) {
    \core\mvc\View::messageOutput($arrMessage);
}
?>
<form action="" method="POST">

    <p><input class="form-control" name="name" placeholder="Ваше имя" value="<?= $post["name"];?>"></input></p>
    <p><input class="form-control" name="email" placeholder="Ваша электронная почта" value="<?= $post["email"];?>"></input></p>
    <p><input class="form-control" name="login" placeholder="Ваш логин"  value="<?= $post["login"];?>"></input></p>
    <p><input class="form-control" name="password" placeholder="Ваш пароль" value="<?= $post["password"];?>" ></input></p>
    <p><input class="form-control" name="passwordRepeat" placeholder="Повторите пароль" value="<?= $post["passwordRepeat"];?>" ></input></p>
    <p><input type="submit" class="btn btn-info btn-block" value="Регистрация"></p>
</form>
<div class="log">
    <a  href="/">Назад</a>
</div>
