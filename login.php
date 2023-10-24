<?php
include 'components/connect.php';

session_start();

function generateCaptcha() {
   $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   $captcha = '';

   for ($i = 0; $i < 6; $i++) {
       $randomIndex = mt_rand(0, strlen($characters) - 1);
       $captcha .= $characters[$randomIndex];  // Use .= to append, not =
   }

   return $captcha;
}

if (!isset($_SESSION['captcha'])) {
   // Generate CAPTCHA if not set in the session
   $_SESSION['captcha'] = generateCaptcha();
}

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {
   // Verify CAPTCHA first
   $userInput = filter_var($_POST['captcha'], FILTER_SANITIZE_STRING);
   if ($_SESSION['captcha'] !== $userInput) {
       $message[] = 'CAPTCHA verification failed!';
   } else {
       // Your existing login logic
       $email = $_POST['email'];
       $email = filter_var($email, FILTER_SANITIZE_STRING);
       $pass = sha1($_POST['pass']);
       $pass = filter_var($pass, FILTER_SANITIZE_STRING);

       $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
       $select_user->execute([$email, $pass]);
       $row = $select_user->fetch(PDO::FETCH_ASSOC);

       if ($select_user->rowCount() > 0) {
           $_SESSION['user_id'] = $row['id'];
           header('location:home.php');
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
   <link rel="stylesheet" href="css/style.css">

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

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <section class="form-container">

      <form action="" method="post" onsubmit="return validateForm()">
         <h3>Login Now</h3>
         <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50"
            oninput="this.value = this.value.replace(/\s/g, '')">

         <div class="captcha-container">
            <div class="captcha" id="captcha"><?php echo $_SESSION['captcha']; ?></div>
            <input type="text" name="captcha" required placeholder="Enter the CAPTCHA" class="box">
         </div>

         <input type="submit" value="login now" name="submit" class="btn">
         <p>Don't have an account? <a href="register.php">Register now</a></p>
      </form>

   </section>

   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>
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
