<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Tentang Kami</h3>
   <p><a href="home.php">Home</a> <span> / About</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Mengapa Memilih Restoran Kelommpok 1?</h3>
         <p>
            Restoran Kelompok 1 menawarkan pengalaman untuk menikmati makanan yang disajikan dengan bahan-bahan terbaik di seluruh dunia, dan dibuat oleh tenaga ahli yang profesional. Kami berkomitmen untuk menjaga 
            kualitas makanan, menjaga atmosfer restoran agar tetap nyaman, serta berjanji untuk memberikan pelayanan yang terbaik demi kepuasan dan kenyamanan pelanggan.
         </p>
         <a href="menu.php" class="btn">Our Menu</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">3 Step Pemesanan Kami</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>Pilih Menu</h3>
         <p>
            Pilih setiap menu yang anda inginkan sesuai dengan preferensi masing-masing.
         </p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>Pengiriman Secara Cepat</h3>
         <p>
            Makanan akan segera dikirimkan ke tempat Anda secara cepat, dan terjaga kualitasnya.
         </p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>Selamat Menikmati Makanan</h3>
         <p>
            Makanan sudah sampai! Selamat, anda dapat menikmati makanan.
         </p>
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="title">Review Pelanggan Setia Kami</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/wa-2.jpeg" alt="">
            <p>"Makanannya memiliki rasa yang luar biasa. Disajikan dengan pengalaman yang terbaik, didukung dengan atmosfer yang unik dan tenang."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Hito</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/wa-3.jpeg" alt="">
            <p>"Pengalaman yang tak terlupakan untuk dapat mencicipi makanan dengan kualitas terbaik di seluruh dunia. Aku akan berkunjung lagi kesini"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Rio</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/wa-1.jpeg" alt="">
            <p>"Aku mengajak keluarga besarku untuk makan bersama. Sungguh pengalaman yang tak terlupakan untuk dapat menikmati hidangan yang terbaik."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Revan</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/wa-4.jpeg" alt="">
            <p>"Diversitas menu yang disajikan membuat saya tidak pernah bosan dalam mencicipi makanan. Keunikan disajikan dengan kualitas yang terbaik."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>William</h3>
         </div>
      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>