<div class="log">
    <a  href="/login">Вход</a> / <a href="/registration">Регистрация</a>
</div>
<?php
if(count($comments) > 0) {
    foreach ($comments as $comment) {
        ?>
        <div class="wrapper_note">
            <div class="note">
                <p>
                    <span class="date"><?= $comment["DATA"]; ?></span>
                    <span class="name"><?= $comment["NAME"]; ?></span>
                </p>
                <p>
                    <?= $comment["TEXT"]; ?>
                </p>
            </div>
        </div>
    <?php }
}else{
    \core\mvc\View::messageOutput(["Пока не было оставлено ни одного комментария! Будьте первым!"]);
}

