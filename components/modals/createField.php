<div class="modal modal-sm active" id="example-modal-2">
    <a class="modal-overlay" href="<?=$HOST?>" aria-label="Close"></a>
    <div class="modal-container" role="document">
        <div class="modal-header">
            <a class="btn btn-clear float-right" href="<?=$HOST?>" aria-label="Close"></a>
            <div class="modal-title h5">Новая область</div>
        </div>
        <form action="<?=$HOST?>/functions/field/create.php" method="post">
            <div class="modal-body">
                <div class="content">
                    <div class="form-group">
                        <label class="form-label" for="input-name">Название</label>
                        <input id="new-field-input" class="form-input" id="input-name" name="name" type="text" required minlength="3" placeholder="Название области">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="input-description">Описание</label>
                        <input class="form-input" id="input-description" name="description" type="text" placeholder="Описание области">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button name="create" class="btn btn-primary">Создать</button>
                <a class="btn btn-link" href="<?=$HOST?>" aria-label="Close">Отменить</a>
            </div>
        </form>
    </div>
</div>