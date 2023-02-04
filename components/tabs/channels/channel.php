<div class="tile tile-centered channel <?=($_SESSION['channel-id'] == $channel['id']) ? 'active' : ''?>">
    <div class="tile-content">
        <div class="tile-title channel-title text-bold">
            <a href="<?=$HOST?>?v=messages&id=<?=$channel['id']?>" class="channel-link"><?=$channel['name']?></a>
            <?php
            $delete_link = $HOST . '/functions/channel/remove.php?id=' . $channel['id'];
            $save_link = $HOST . '/functions/channel/toggle.php?id=' . $channel['id'] . '&s=' . $channel['liked'];

            if ($channel['liked']) {
                ?>
                <span class="chip ">
                    Доверенный
                    <a href="<?=$save_link?>" class="btn btn-clear" aria-label="Close" role="button"></a>
                </span>
                <?php
            }

            $message = get_last_message_for_channel($DATABASE, $channel['id']);
            ?>
        </div>
        <div class="tile-subtitle channel-message">
            <?php
                if (is_null($message['description'])) {
                    echo '<span class="empty-message">Будьте первым, кто оставит сообщение!</span>';
                } else {
                    $user = get_user($DATABASE, $message['user_id']);
                    ?>
                    <figure class="avatar avatar-sm" data-initial="<?=$user['short']?>" style="background-color: #5755d9;"></figure>
                    <?php
                    echo $message['description'];
                }
            ?>
        </div>
    </div>
    <div class="tile-action">
        <?php
            if (!$channel['liked']) {
                ?>
                <a href="<?=$save_link?>" class="btn btn-link btn-action btn-lg tooltip tooltip-left" data-tooltip="Сделать доверенным"><i class="icon icon-bookmark"></i></a>
                <?php
            }
        ?>
        <a href="<?=$delete_link?>" class="btn btn-link btn-action btn-lg tooltip tooltip-left" data-tooltip="Удалить канал"><i class="icon icon-delete"></i></a>
    </div>
</div>