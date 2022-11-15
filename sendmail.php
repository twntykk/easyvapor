<?php
// Файлы phpmailer
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

$name = $_POST['name'];
$sname = $_POST['2name'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$select = $_POST['select'];
$otdpocht= $_POST['otdpocht'];
$pocht= $_POST['pocht'];
$poln=$_POST['poln'];
$product=$_POST['product'];
if($poln=="1"){
    $poln="Подтвердил что больше 18 лет";
}else{
    $poln="Не подтвердил что больше 18 лет";
}
// Формирование самого письма
$title = "Новый заказ";
$body = "
<h2>Новый заказ</h2>
<b>Одноразка:</b>$product<br>
<b>Имя:</b> $name<br>
<b>Фамилия:</b> $sname<br>
<b>Город:</b>$city<br>
<b>Номер телефона:</b>$phone<br>
<b>Доставить:</b>$pocht<br>
<b>Оделение почты/Почтовый индекс:</b>$otdpocht<br>
<b>Вкус:</b>$select<br>
<b>18:</b>$poln
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    

    // Настройки вашей почты
    $mail->Host       = 'smtp.ukr.net'; // SMTP сервера вашей почты
    $mail->Username   = 'easyvaportest@ukr.net'; // Логин на почте
    $mail->Password   = 'zAW6V4HinzJfslkK'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 2525;
    $mail->setFrom('easyvaportest@ukr.net', 'EasyVapor'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('easyvaporzakaz@gmail.com');  

    // Прикрипление файлов к письму

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}
require('complite.html');
return 0;
// Отображение результата
