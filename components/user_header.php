<?php
global $conn;
if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
<style>

    header div .opn{
        color: var(--black);
    }
    header div .opn:hover{
        color: var(--light-yellow);
    }



</style>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">MAX<span>WHELLS</span></a>

      <nav class="navbar" style="margin-left: 20px;">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="orders.php">orders</a>
         <a href="shop.php">shop</a>
         <a href="contact.php">contact</a>
          <a href="main-page-car.php">ckeck out a car</a>
      </nav>

      <div class="icons" >
         <?php

            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
          <div style="display: flex; justify-content: space-between; width: 300px;margin-bottom: -20px;" >  <a class="opn" href="search_page.php"><i class="fas fa-search"></i></a>

              <a href="wishlist.php" class="opn"><i class="fas fa-heart hala opn"> <span  style="font-family: cursive;">(<?= $total_wishlist_counts; ?>)</span></i></a>
              <a href="cart.php" class="opn"><i class="fas fa-shopping-cart opn"> <span  style="font-family: cursive;">(<?= $total_cart_counts; ?>)</span></i></a>
            <button id="user-btn" class="log"  style="color:#fff;margin-bottom: 9px">Login</button>
        </div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
                ?>
                <script>


    let y=document.getElementById('user-btn');
    y.innerText=' ';
    y.classList.add('op');
    y.classList.remove('log')

                </script>
                    <?php
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Welcome <?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <b href="user_login.php" class="option-btn">login</b>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>