<div class="column col-6 col-md-12">
    <div class="panel max-h">
        <div class="panel-header text-center">
            <a href="<?=$HOST?>/functions/logout.php" class="btn btn-logout">Выйти</a>
            <figure class="avatar avatar-lg" data-initial="<?=$USER['short']?>"></figure>
            <div class="panel-title h5 mt-10"><?=$USER['name']?></div>
        </div>
        <nav class="panel-nav">
            <?php require '../components/menu.php'; ?>
        </nav>
        <?php
        switch ($_SESSION['tab']) {
            case 'fields': {
                require $_SERVER['DOCUMENT_ROOT'] . '/components/tabs/fields/fields.php';
                break;
            }
            default: {
                require $_SERVER['DOCUMENT_ROOT'] . '/components/tabs/channels/channels.php';
                break;
            }
        }
        ?>
    </div>
</div>