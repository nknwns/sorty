<div class="tile message <?=($message['user_id'] == $USER['id'] ? 'message-self' : '')?>">
    <div class="tile-icon">
        <figure class="avatar" data-initial="<?=$users[$message['user_id']]['short']?>"></figure>
    </div>
    <div class="tile-content">
        <p class="tile-title message-header text-bold">
            <span class="message-author"><?=$users[$message['user_id']]['name']?></span>
        </p>
        <p class="tile-subtitle"><?=$message['description']?></p>
        <?=($message['save'] ? '<span class="label message-hidden">Скрыто</span>' : '')?>
    </div>
</div>