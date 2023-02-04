<div class="modal modal-sm active" id="example-modal-2"><a class="modal-overlay" href="<?=$HOST?>" aria-label="Close"></a>
    <div class="modal-container" role="document">
        <div class="modal-header">
            <a class="btn btn-clear float-right" href="<?=$HOST?>" aria-label="Close"></a>
            <div class="modal-title h5">Новый канал</div>
        </div>
        <form action="<?=$HOST?>/functions/channel/create.php" method="post">
            <div class="modal-body">
                <div class="content">
                    <div class="form-group">
                        <label class="form-label" for="input-name">Название</label>
                        <input id="new-channel-input" class="form-input" id="input-name" name="name" required minlength="3" type="text" placeholder="Название канала">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="input-description">Описание</label>
                        <input class="form-input" id="input-description" name="description" type="text" placeholder="Описание канала">
                    </div>
                    <div class="form-group">
                        <label class="form-switch">
                            <input type="checkbox" name="liked" value="off">
                            <i class="form-icon"></i> Доверенный канал
                        </label>
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