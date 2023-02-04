<?php

?>
<div class="column col-6 col-md-12">
    <?php
        switch($_SESSION['view']) {
            case 'messages': {
                require $_SERVER['DOCUMENT_ROOT'] . '/components/views/messages/messages.php';
                break;
            }
            case 'tags': {
                require $_SERVER['DOCUMENT_ROOT'] . '/components/views/tags/tags.php';
                break;
            }
            case 'empty': {
                require $_SERVER['DOCUMENT_ROOT'] . '/components/views/empty.php';
                break;
            }
        }
    ?>
</div>