<?php
session_start();
include "../php_connect/connect.php";

if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
   $IDuser = $_SESSION['id_user'];
} else {
   // Если id пользователя не установлен или пуст, перенаправляем на страницу входа или другую нужную страницу
   header("Location: login.php");
   exit();
}

if (isset($_FILES['user_photo']) && $_FILES['user_photo']['error'] === UPLOAD_ERR_OK) {
   $file = $_FILES['user_photo'];
   $fileName = $file['name'];
   $fileTmpName = $file['tmp_name'];
   $fileSize = $file['size'];

   // Проверяем тип файла
   $allowedExtensions = array('jpg', 'jpeg', 'png');
   $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

   if (in_array($fileExtension, $allowedExtensions)) {
      // Проверяем размер файла
      if ($fileSize <= 200 * 1024) { // Максимальный размер 200 КБ
         // Генерируем уникальное имя файла
         $newFileName = uniqid('', true) . '.' . $fileExtension;
         $fileDestination = './profile_images/' . $newFileName;

         // Сохраняем файл на сервере
         if (move_uploaded_file($fileTmpName, $fileDestination)) {
            // Получаем старое фото пользователя
            $queryOldPhoto = "SELECT profile_photo FROM user WHERE id_user = '$IDuser'";
            $resultOldPhoto = mysqli_query($connect, $queryOldPhoto);
            $rowOldPhoto = mysqli_fetch_assoc($resultOldPhoto);
            $oldPhoto = $rowOldPhoto['profile_photo'];

            // Обновляем информацию о фотографии пользователя в базе данных
            $updateQuery = "UPDATE user SET profile_photo = '$fileDestination' WHERE id_user = '$IDuser'";
            mysqli_query($connect, $updateQuery);

            // Удаляем предыдущее изображение, если оно существует и отличается от нового
            if (!empty($oldPhoto) && file_exists($oldPhoto) && $oldPhoto !== $fileDestination) {
               unlink($oldPhoto);
            }

            // Перенаправляем пользователя на его профиль
            header("Location: ./profile.php");
            exit();
         }
      } else {
         echo "Размер файла превышает допустимый лимит (200 КБ).";
      }
   } else {
      echo "Недопустимый формат файла. Поддерживаемые форматы: JPG, JPEG, PNG.";
   }
} else {
   echo "Произошла ошибка при загрузке файла.";
}
?>
