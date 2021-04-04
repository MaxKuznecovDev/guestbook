<div class="userName"><?= $userName;?></div>
<?php if(isset($currentPage)) { ?>
    <div>
        <nav>
            <ul class="pagination">
                <?php if ($currentPage == 1) { ?>
                    <li class="disabled">
                        <a href="" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?= '/' . $userUrn . '/page/' . ($currentPage - 1) . '/' ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php }
                foreach ($_SESSION['Pages'] as $page) { ?>
                    <li><a href="<?= '/' . $userUrn . "/page/" . $page . "/" ?>"><?= $page ?></a></li>
                <?php }
                if ($currentPage == $countPage) { ?>
                    <li class="disabled">
                        <a href="" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?= '/' . $userUrn . '/page/' . ($currentPage + 1) . '/' ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <?php


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
            <?php
            if ($comment["ID_USER"] == $_SESSION["id_user"]) {
                ?>
                <div class="edit">
                    <a href="<?= '/' . $userUrn . '/edit/' . $comment["ID_COMMENT"]; ?>">Редактировать</a>
                    <a href="<?= '/' . $userUrn . '/delete/' . $comment["ID_COMMENT"]; ?>">Удалить</a>
                </div>
                <?php
            }
            ?>
        </div>
</div>

    <?php }
}else {
    $currentPage = 1;
}

if(isset($arrMessage)) {

    \core\mvc\View::messageOutput($arrMessage);
}
?>
<div id="form">
    <form action="<?='/'.$userUrn.'/page/'.($currentPage).'/'; ?>" method="POST" >
        <p><textarea class="form-control" name="text" placeholder="Ваш отзыв"></textarea></p>
        <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
    </form>
</div>
<div class="log">
    <a  href="/">Выход</a>
</div>
