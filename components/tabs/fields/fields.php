<div class="panel-body">
    <?php
    $fields = get_fields($DATABASE);
    if (count($fields)) {
        foreach ($fields as $field) {
            require $_SERVER['DOCUMENT_ROOT'] . '/components/tabs/fields/field.php';
        }
    } else {
        ?>
        <div class="empty">
            <p class="empty-title h5">Список областей знаний пуст</p>
            <p class="empty-subtitle">Создайте новую область знаний прямо сейчас.</p>
        </div>
        <?php
    }
    ?>
</div>
<div class="panel-footer">
    <a href="<?=$HOST?>/index.php?m=createField" class="btn btn-primary btn-block">Создать новую область знаний</a>
</div>
