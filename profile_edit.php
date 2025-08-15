<?php
session_start();

include "./php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

$qInfoUser = "SELECT * FROM user WHERE id_user='$IDuser'";
addslashes($qInfoUser);
$resInfoUser = mysqli_query($connect, $qInfoUser) or die(mysqli_error($connect));
$InfoUser = mysqli_fetch_object($resInfoUser);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/main.css">
    <title>Редактирование профиля | Технологический университет программирования</title>
    <link rel="shortcut icon" href="./images/svg/shortcut_icon.svg" type="image/svg">
    <meta name="robots" content="noindex">
</head>

<body>
    <h1 class="profile_edit__title">Изменение данных</h1>
    <div class="container">
        <form action="./php_handler/profile_edit_handler.php" class="profile_edit__form" method="post" id="profile_edit_form">
            <?php
            session_start();
            if (isset($_SESSION['success_message'])) {
                echo "<div class='success-message'>" . $_SESSION['success_message'] . "</div>";
                unset($_SESSION['success_message']); // Удаление сообщения после его показа
            }
            if (isset($_SESSION['error_message'])) {
                echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
                unset($_SESSION['error_message']); // Удаление сообщения после его показа
            }
            ?>
            <div class="profile_edit_div">
                <div class="div_input_div">
                    <label class="label_input_auth">Группа</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="ugroup" placeholder="Ваша группа, например вд50-1-20" autocomplete="off" required="required" minlength="4" maxlength="10" value="<?php echo "" . $InfoUser->ugroup . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Почта</label>
                    <div class="div_input">
                        <input type="email" class="input_form" name="email" placeholder="ivanov@mail.ru" autocomplete="off" required="required" minlength="4" maxlength="80" value="<?php echo "" . $InfoUser->email . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Квалификация</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="qualification" placeholder="Ваша квалификация, например Суетолог" autocomplete="off" required="required" minlength="4" maxlength="15" value="<?php echo "" . $InfoUser->qualification . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Телефон</label>
                    <div class="div_input">
                        <input type="text" class="input_form" id="phone" name="telephone" placeholder="8 (903) 555-55-55" autocomplete="off" required="required" minlength="4" maxlength="50" value="<?php echo "" . $InfoUser->telephone . ""; ?>">
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#phone').mask("+7 (999) 999-99-99");
                    });
                </script>
                <div class="div_input_div">
                    <label class="label_input_auth">Специальность</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="specialization" placeholder="Ваша специальность, например 09.09.09" autocomplete="off" required="required" minlength="4" maxlength="10" value="<?php echo "" . $InfoUser->specialization . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Фамилия</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="surname" placeholder="Ваша фамилия" autocomplete="off" required="required" minlength="4" maxlength="50" value="<?php echo "" . $InfoUser->surname . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Курс</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="course" placeholder="Номер курса" autocomplete="off" required="required" minlength="1" maxlength="1" value="<?php echo "" . $InfoUser->course . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Имя</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="uname" placeholder="Ваше имя" autocomplete="off" required="required" minlength="4" maxlength="50" value="<?php echo "" . $InfoUser->uname . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Логин</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="login" placeholder="Логин" autocomplete="off" required="required" minlength="4" maxlength="50" value="<?php echo "" . $InfoUser->login . ""; ?>">
                    </div>
                </div>
                <div class="div_input_div">
                    <label class="label_input_auth">Отчество</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="middlename" placeholder="Ваше отчество" autocomplete="off" required="required" minlength="4" maxlength="50" value="<?php echo "" . $InfoUser->middlename . ""; ?>">
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" class="submit submit_profile_edit" value="Сохранить изменения">
            <a href="./profile.php" class="reset-pass-text back_to_main margin_auto_wo_top">
                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 3.55838V0.999379C7.99968 0.801756 7.94087 0.60865 7.83098 0.444396C7.72109 0.280141 7.56504 0.152089 7.3825 0.0763769C7.19996 0.000664301 6.99909 -0.0193211 6.8052 0.0189399C6.61132 0.057201 6.4331 0.151996 6.293 0.291378L0 6.49938L6.293 12.7064C6.38565 12.7996 6.49581 12.8735 6.61715 12.924C6.73848 12.9744 6.86859 13.0004 7 13.0004C7.13141 13.0004 7.26152 12.9744 7.38285 12.924C7.50419 12.8735 7.61435 12.7996 7.707 12.7064C7.79991 12.6136 7.87361 12.5034 7.92389 12.382C7.97416 12.2607 8.00003 12.1307 8 11.9994V9.51038C10.75 9.57838 13.755 10.0764 16 13.4994V12.4994C16 7.86638 12.5 4.05638 8 3.55838Z" fill="black" />
                </svg>вернуться в профиль</a>
        </form>
    </div>
</body>

</html>