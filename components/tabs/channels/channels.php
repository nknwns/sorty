<div class="panel-body">
    <?php
        $channels = get_channels($DATABASE, $_SESSION['tab'] == 'favorites');
        if (count($channels)) {
            foreach ($channels as $channel) {
                require $_SERVER['DOCUMENT_ROOT'] . '/components/tabs/channels/channel.php';
            }
        } else {
            ?>
            <div class="empty">
                <p class="empty-title h5">В данном разделе отсутсвуют каналы</p>
                <p class="empty-subtitle">Создайте новый канал или измените уже существующий.</p>
            </div>
            <?php
        }
    ?>
</div>
<div class="panel-footer">
    <a href="<?=$HOST?>/index.php?m=createChannel" class="btn btn-primary btn-block">Создать новый канал</a>
</div>
