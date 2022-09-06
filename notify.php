<?php

require_once 'vendor/autoload.php';

/* Подключение к базе данных */

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "root", "", "mydeal_master");

$query = "SELECT tasks.id, tasks.name as task_name, tasks.date, users.name as user_name, users.email as email
FROM tasks
JOIN users ON tasks.user_id = users.id
WHERE (TO_DAYS(tasks.date) - TO_DAYS(NOW())) >= 0 AND (TO_DAYS(tasks.date) - TO_DAYS(NOW())) <= 1  ";

$res = mysqli_query($link, $query);

$emails = mysqli_fetch_all($res, MYSQLI_ASSOC);


foreach ($emails as $message) {
  $taskName = $message['task_name'];
  $login = $message['user_name'];
  $date = $message['date'];
  $email = $message['email'];

  $result[$email]['message'] = "Уважаемый(ая)" . $login . " время выполения задачи " . $taskName . " заканчивается $date";
  //echo $result[$email]['message'];
  $messageText = $result[$email]['message'];
  echo "</br>";
  echo $messageText;
  echo "</br>";
  echo $login;
  echo "</br>";
  echo $email;
  echo "</br>";
}



try {


  $transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465))
    ->setUsername('horizon455@yandex.ru')
    ->setPassword('Vlad251436789');

  // Create the Mailer using your created Transport
  $mailer = new Swift_Mailer($transport);

  // Create a message
  $message = (new Swift_Message());
  $message->setSubject('test');
  $message->setFrom(['horizon455@yandex.ru' => 'Владислав']);

  $message->setTo([$email =>  $login]);
  $message->setBody($messageText);


  // Send the message
  $numSent = $mailer->send($message);

  printf("Sent %d messages\n", $numSent);
} catch (Exception $e) {
  echo $e->getMessage();
}
