<?php

if (!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) { // проверка что в запросе пришли и логин и пароль
    $email = strip_tags($_REQUEST['email']); // удаляю теги из логина
    $result = $conn->query('select * from users where email = "' . $email . '" and user_password = "' . md5($_REQUEST['password']) . '"'); // проверяю наличие пользователя с переданными параметрами в базе
    if ($result->num_rows > 0) { // если количество полученых строк больше 0
        $user = $result->fetch_assoc(); // полученные данные в виде массива записываю в переменную
        auth($conn, $user['id']); // вызываю функцию авторизации
        header('Location: /'); // редирект на главную
    } else {
        $errorMessage .= 'Wrong email or password!'; // ошибка неверный логин или пароль
    }
}

include_once('../view/auth.php'); // подключаю представление
