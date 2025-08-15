document.addEventListener('DOMContentLoaded', function () {
  var photo = document.querySelector('.profile__photo');
  var modalUpdatePhoto = document.getElementById('modal_update_photo');
  var modalCropPhoto = document.getElementById('cropperModal');
  var closeBtn = document.querySelector('.close');

  photo.addEventListener('click', function () {
    modalUpdatePhoto.style.display = "block"; // Показать первое модальное окно при нажатии на фото
  });

  closeBtn.addEventListener('click', function () {
    modalUpdatePhoto.style.display = "none";
    modalCropPhoto.style.display = "none"; // Закрыть оба модальных окна при нажатии на кнопку закрытия
  });

  window.addEventListener('click', function (event) {
    if (event.target === modalUpdatePhoto) {
      modalUpdatePhoto.style.display = "none"; // Закрыть первое модальное окно при щелчке за его пределами
    }
  });
});

document.getElementById('photoUpload').addEventListener('change', function() {
  var file = this.files[0];
  if (file) {
    var reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById('uploadedImage').src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
});