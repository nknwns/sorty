<?php
$delete_link = $HOST . '/functions/field/remove.php?id=' . $field['id'];
?>
<div class="tile tile-centered channel <?=($_SESSION['field-id'] == $field['id']) ? 'active' : ''?>">
    <div class="tile-content field">
        <div class="tile-title channel-title text-bold">
            <a href="<?=$HOST?>?v=tags&id=<?=$field['id']?>" class="channel-link"><?=$field['name']?></a><span class="label"><?=$field['count']?></span>
        </div>
        <div class="tile-subtitle">
            <?php
            if (is_null($field['description']) || !strlen($field['description'])) {
                echo '<span class="empty-message">У данной области отсутствует описание..</span>';
            } else {
                echo $field['description'];
            }
            ?>
        </div>
    </div>
    <div class="tile-action">
        <a href="<?=$delete_link?>" class="btn btn-link btn-action btn-lg tooltip tooltip-left" data-tooltip="Удалить область"><i class="icon icon-delete"></i></a>
    </div>
</div>