<?php
    $channel = get_channel($DATABASE, $_SESSION['channel-id']);
    if (isset($_SESSION['filter'])) {
        $messages = get_messages_for_channel($DATABASE, $_SESSION['channel-id'], $_SESSION['filter']);
    } else {
        $messages = get_messages_for_channel($DATABASE, $_SESSION['channel-id']);
    }

    $save_link = $HOST . '/functions/channel/toggle.php?id=' . $channel['id'] . '&s=' . $channel['liked'];
    $delete_filter = $HOST . '/functions/filter/remove.php';
?>

<div class="panel max-h">
    <div class="btn disabled h-6"><?=$channel['name']?></div>
    <div class="panel-header">
        <div class="messages-options">
            <?php if ($channel['liked']) { ?>
                <span class="chip">Доверенный
                <a href="<?=$save_link?>" class="btn btn-clear" aria-label="Close" role="button"></a>
            </span>
            <?php } ?>
            <?php if (isset($_SESSION['filter'])) { ?>
                <span class="chip"><?=$_SESSION['filter']?>
                <a href="<?=$delete_filter?>" class="btn btn-clear" aria-label="Close" role="button"></a>
            </span>
            <?php } ?>
            <a href="<?=$HOST?>/index.php?m=setFilter" class="btn btn-filter btn-primary">Фильтр</a>
        </div>
    </div>
    <div class="panel-body">
        <?php
        if (count($messages)) {
            $user_ids = array();
            foreach ($messages as $message) {
                if (!in_array($message['user_id'], $user_ids)) array_push($user_ids, $message['user_id']);
            }
            $users = get_users($DATABASE, $user_ids);

            foreach ($messages as $message) require $_SERVER['DOCUMENT_ROOT'] . "/components/views/messages/message.php";
        } else {
            ?>
            <div class="empty">
                <p class="empty-title h5">В данном канале еще нет сообщений</p>
                <p class="empty-subtitle">Будьте первым, кто оставит сообщение.</p>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="panel-footer">
        <form action="<?=$HOST?>/functions/message/create.php" method="post">
            <input class="form-input hidden" type="text" name="user" value="<?=$USER['id']?>">
            <input class="form-input hidden" type="text" name="channel" value="<?=$channel['id']?>">
            <div class="input-group">
                <label class="form-switch">
                    <input type="checkbox" name="save"><i class="form-icon"></i>
                </label>
                <input id="new-message-input" class="form-input" type="text" name="description" required minlength="3" placeholder="Сообщение">
                <button name="send" class="btn btn-primary input-group-btn">Отправить</button>
            </div>
        </form>
    </div>
</div>