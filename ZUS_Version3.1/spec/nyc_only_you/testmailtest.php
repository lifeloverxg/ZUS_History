<html>
<body>

<?php
  //send email
  $email = "yijunxiao@nycuni.com";
  $subject = "Hello";
  $message = "helloworld";
  mail($email, $subject, $message, $email);

  echo "Thank you for using our mail form";
?>

</body>
</html>