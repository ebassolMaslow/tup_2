<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./scss/main.css">
    <title>Восстановление пароля</title>
    <link rel="shortcut icon" href="./images/svg/shortcut_icon.svg" type="image/svg">
</head>

<body>
    <h1 class="reset_password__title">Введите новый пароль</h1>
    <form action="./php_handler/handle_new_password.php" method="post" class="form_reset_password">
        <div class="error_message">
            <?php
            session_start();
            if (isset($_SESSION['message'])) {
                echo "<p class=\"error_message_text\">{$_SESSION['message']}</p>";
                unset($_SESSION['message']);
            }
            ?>
        </div>
        <label class="label_input_auth">Введите пароль</label>
        <div class="div_input">
            <input type="password" class="input_form" name="new_password" placeholder="Придумайте пароль" autocomplete="off" required="required" minlength="8" maxlength="30">
        </div>
        <label class="label_input_auth">Подтвердите пароль</label>
        <div class="div_input">
            <input type="password" class="input_form" name="confirm_password" placeholder="Подтвердите пароль" autocomplete="off" required="required" minlength="8" maxlength="30">
        </div>
        <?php
        // Вывод токена сброса пароля как скрытого поля формы
        if (isset($_GET['token'])) {
            echo "<input type=\"hidden\" name=\"reset_token\" value=\"{$_GET['token']}\">";
        }
        ?>
        <input type="submit" name="submit" class="submit" value="Сменить пароль">
        <a href="./" class="reset-pass-text back_to_main">
            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 3.55838V0.999379C7.99968 0.801756 7.94087 0.60865 7.83098 0.444396C7.72109 0.280141 7.56504 0.152089 7.3825 0.0763769C7.19996 0.000664301 6.99909 -0.0193211 6.8052 0.0189399C6.61132 0.057201 6.4331 0.151996 6.293 0.291378L0 6.49938L6.293 12.7064C6.38565 12.7996 6.49581 12.8735 6.61715 12.924C6.73848 12.9744 6.86859 13.0004 7 13.0004C7.13141 13.0004 7.26152 12.9744 7.38285 12.924C7.50419 12.8735 7.61435 12.7996 7.707 12.7064C7.79991 12.6136 7.87361 12.5034 7.92389 12.382C7.97416 12.2607 8.00003 12.1307 8 11.9994V9.51038C10.75 9.57838 13.755 10.0764 16 13.4994V12.4994C16 7.86638 12.5 4.05638 8 3.55838Z" fill="black" />
            </svg>вернуться на главную</a>
    </form>
</body>

</html>