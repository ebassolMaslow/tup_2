document.addEventListener('DOMContentLoaded', function () {
    var editBtns = document.querySelectorAll('.edit_btn');
    var ModalUpdateTable = document.getElementById('modal_update_table');
    var closeBtn = ModalUpdateTable.querySelector('.close');
    var idRolePlaceholder = document.getElementById('id_role_placeholder');
    var nameRoleInput = document.getElementById('name_role_input');

    // Перебираем все кнопки "Edit" и назначаем на каждую обработчик события клика
    editBtns.forEach(function (editBtn) {
        editBtn.addEventListener('click', function () {
            ModalUpdateTable.style.display = "block"; // Показываем модальное окно

            // Получаем id_role из атрибута data-id кнопки "Edit"
            var idRole = editBtn.getAttribute('data-id');

            // Заполняем плейсхолдер для id_role
            idRolePlaceholder.textContent = idRole;
        });
    });

    closeBtn.addEventListener('click', function () {
        ModalUpdateTable.style.display = "none"; // Закрываем модальное окно при клике на кнопку "Close"
    });

    window.addEventListener('click', function (event) {
        if (event.target === ModalUpdateTable) {
            ModalUpdateTable.style.display = "none"; // Закрываем модальное окно при клике за его пределами
        }
    });
});