<div class="modal modal-sm active" id="example-modal-2"><a class="modal-overlay" href="<?=$HOST?>" aria-label="Close"></a>
    <div class="modal-container" role="document">
        <div class="modal-header">
            <a class="btn btn-clear float-right" href="<?=$HOST?>" aria-label="Close"></a>
            <div class="modal-title h5">Установить фильтр</div>
        </div>
        <form action="<?=$HOST?>" method="get">
            <div class="modal-body">
                <div class="content">
                    <div class="form-group">
                        <input id="new-channel-input" class="form-input" id="input-name" name="filter" required minlength="3" pattern="#[a-zA-Zа-яА-Я]+" type="text" placeholder="#хештег">
                        <label class="form-label" for="input-name">Название хештега</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button name="create" class="btn btn-primary">Применить</button>
                <a class="btn btn-link" href="<?=$HOST?>" aria-label="Close">Отменить</a>
            </div>
        </form>
    </div>
</div>