<div class="tile tag">
    <div class="tile-content">
        <p class="tile-title tag-header text-bold">
            <span class="btn message-author"><?=$tag['name']?></span>
            <a href="<?=$HOST?>/functions/tag/remove.php?id=<?=$tag['id']?>" class="btn btn-primary btn-action btn-lg btn-delete tooltip tooltip-left" data-tooltip="Удалить хештег"><i class="icon icon-delete"></i></a>

        </p>
        <?=($message['save'] ? '<span class="label message-hidden">Скрыто</span>' : '')?>
    </div>
</div>