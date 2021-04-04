<div class="note">
    <p>
        <span class="date"><?= $comment["DATA"];?></span>
    </p>
    <?php
    if(isset($arrMessage)) {
        \core\mvc\View::messageOutput($arrMessage);
    }
?>
    <div id="form">
        <form action="<?= '/'.REQUEST_USER; ?>" method="POST">
            <p><textarea class="form-control" name="text" ><?= $comment["TEXT"];?></textarea></p>
            <p><input type="submit" class="btn btn-info btn-block" value="Редактировать"></p>
        </form>
    </div>
    <div class="log">
        <a  href="<?= '/user/'.$userId."/page/".$_SESSION["Pages"][0]."/"; ?>">Назад</a>
    </div>