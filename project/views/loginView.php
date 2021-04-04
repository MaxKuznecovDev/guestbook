<?php
if(isset($arrMessage)) {
    \core\mvc\View::messageOutput($arrMessage);
}

?>
    <form action="" method="POST">
        <p><input class="form-control" name="login" placeholder="Ваш логин"   value="<?php if(isset($post)){echo $post["login"];}?>"></input></p>
        <p><input class="form-control" name="password" placeholder="Ваш пароль" value="<?php if(isset($post)){echo $post["password"];}?>"></input></p>
        <p><input type="submit" class="btn btn-info btn-block" value="Войти"></p>
    </form>
<div class="log">
    <a  href="/">Назад</a>
</div>
