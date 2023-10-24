<?php

include '../components/connect.php';

session_start();

function generateCaptcha() {
   $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   $captcha = '';

   for ($i = 0; $i < 6; $i++) {
       $randomIndex = mt_rand(0, strlen($characters) - 1);
       $captcha .= $characters[$randomIndex];
   }

   return $captcha;
}

if (!isset($_SESSION['captcha'])) {
   // Generate CAPTCHA if not set in the session
   $_SESSION['captcha'] = generateCaptcha();
}

if (isset($_POST['submit'])) {
   // Verify CAPTCHA first
   $userInput = filter_var($_POST['captcha'], FILTER_SANITIZE_STRING);
   if ($_SESSION['captcha'] !== $userInput) {
       $message[] = 'CAPTCHA verification failed!';
   } else {
       // Your existing admin login logic
       $name = $_POST['name'];
       $name = filter_var($name, FILTER_SANITIZE_STRING);
       $pass = sha1($_POST['pass']);
       $pass = filter_var($pass, FILTER_SANITIZE_STRING);

       $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
       $select_admin->execute([$name, $pass]);

       if ($select_admin->rowCount() > 0) {
           $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
           $_SESSION['admin_id'] = $fetch_admin_id['id'];
           header('location:dashboard.php');
       } else {
           $message[] = 'Incorrect username or password!';
       }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      .captcha-container {
         text-align: center;
      }

      .captcha {
         background-color: #f2f2f2;
         font-size: 24px;
         font-weight: bold;
         padding: 10px;
         margin-bottom: 10px;
         display: inline-block;
      }
   </style>

</head>

<body>

<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- admin login form section starts  -->

<section class="form-container">

   <form action="" method="POST" onsubmit="return validateForm()">
      <h3>Login now</h3>
      <p>Default username = <span>admin</span> & Password = <span>uts</span></p>
      <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="box"
             oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="Enter your password" class="box"
             oninput="this.value = this.value.replace(/\s/g, '')">

      <div class="captcha-container">
         <div class="captcha" id="captcha"><?php echo $_SESSION['captcha']; ?></div>
         <input type="text" name="captcha" required placeholder="Enter the CAPTCHA" class="box">
      </div>

      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- admin login form section ends -->

<!-- custom js file link  -->
<script src="../js/script.js"></script>
<script>
   function validateForm() {
      const captchaText = document.getElementById('captcha').innerText;
      const userInput = document.querySelector('input[name="captcha"]').value;

      if (userInput !== captchaText) {
         alert('CAPTCHA verification failed. Please try again.');
         return false;
      }

      return true;
   }

   // Initial generation of CAPTCHA on page load
   document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('captcha').innerText = '<?php echo $_SESSION['captcha']; ?>';
   });
</script>

</body>

</html>
