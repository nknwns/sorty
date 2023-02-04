<?php
$field = get_field($DATABASE, $_SESSION['field-id']);
?>

<div class="panel max-h">
    <div class="panel-header">
        <div class="panel-title h6"><?=$field['name']?></div>
    </div>
    <div class="panel-body">
        <?php
        if ($field['count']) {
            $tags = get_tags($DATABASE, $_SESSION['field-id']);
            foreach ($tags as $tag) require $_SERVER['DOCUMENT_ROOT'] . "/components/views/tags/tag.php";
        } else {
            ?>
            <div class="empty">
                <p class="empty-title h5">В данной области еще нет хештегов</p>
                <p class="empty-subtitle">Создайте хештег прямо сейчас или перенесите из другой области.</p>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="panel-footer">
        <form action="<?=$HOST?>/functions/tag/create.php" method="post">
            <input type="text" hidden name="field" value="<?=$field['id']?>">
            <div class="input-group">
                <input id="new-tag-input" class="form-input" type="text" name="name" required pattern="#[A-Za-zА-Яа-яЁё]{3,}" placeholder="#хештег">
                <button name="add" class="btn btn-primary input-group-btn">Добавить</button>
            </div>
        </form>
    </div>
</div>