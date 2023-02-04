const use_callback = (element, callback) => {
    (document.querySelectorAll(element) || []).forEach(el => callback(el));
}

const removeAlert = (button) => {
    button.addEventListener('click', event => event.currentTarget.parentNode.remove());
}

const scrollPanel = (panel) => {
    panel.scrollTop = panel.scrollHeight + 40;
}

const checkValidationForMessage = (input) => {
    input.setCustomValidity('Пожалуйста, введите сообщение правильно. От 3-х символов. Не более одного хештега.');
}

const checkValidationForChannel = (input) => {
    input.setCustomValidity('Пожалуйста, введите название канала правильно. От 3-х символов.');
}

const checkValidationForTag = (input) => {
    input.setCustomValidity('Пожалуйста, введите хештег правильно. От 3-х символов. Только буквы английского и русского алфавита.');
}

const checkValidationForField = (input) => {
    input.setCustomValidity('Пожалуйста, введите название области правильно. От 3-х символов.');
}

use_callback('.toast .btn-clear', removeAlert);
use_callback('.panel-body', scrollPanel);

// use_callback('#new-message-input', checkValidationForMessage);
// use_callback('#new-channel-input', checkValidationForChannel);
//use_callback('#new-tag-input', checkValidationForTag);
// use_callback('#new-field-input', checkValidationForField);