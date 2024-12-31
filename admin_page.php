<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>

 <!-- font awesome cdn link  -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
<?php include 'admin_header.php'; ?>
<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $select_pendings = $conn->prepare("SELECT COUNT(*) as total_pendings FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         $fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC);
         $total_pendings = $fetch_pendings['total_pendings'];
      ?>
      <h3><?= $total_pendings; ?></h3>
      <p>total pendings</p>
      <a href="admin_orders.php?status=pending" class="btn">see orders</a>
      </div>
      <div class="box">
      <?php
         $select_completed = $conn->prepare("SELECT COUNT(*) as total_completed FROM `orders` WHERE payment_status = ?");
         $select_completed->execute(['completed']);
         $fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC);
         $total_completed = $fetch_completed['total_completed'];
      ?>
      <h3><?= $total_completed; ?></h3>
      <p>completed orders</p>
      <a href="admin_orders.php?status=completed" class="btn">see orders</a>
      </div>
      <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT COUNT(*) as total_orders FROM `orders`");
         $select_orders->execute();
         $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);
         $number_of_orders = $fetch_orders['total_orders'];
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>orders placed</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>
      <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT COUNT(*) as total_products FROM `products`");
         $select_products->execute();
         $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
         $number_of_products = $fetch_products['total_products'];
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>products added</p>
      <a href="admin_products.php" class="btn">see products</a>
      </div>
      <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT COUNT(*) as total_users FROM `users` WHERE user_type = ?");
         $select_users->execute(['user']);
         $number_of_users = $select_users->fetch(PDO::FETCH_ASSOC)['total_users'];
      ?>
      <h3><?= $number_of_users; ?></h3>
      <p>total users</p>
      <a href="admin_users.php?type=user" class="btn">see accounts</a>
      </div>
      <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT COUNT(*) as total_admins FROM `users` WHERE user_type = ?");
         $select_admins->execute(['admin']);
         $number_of_admins = $select_admins->fetch(PDO::FETCH_ASSOC)['total_admins'];
      ?>
      <h3><?= $number_of_admins; ?></h3>
      <p>total admins</p>
      <a href="admin_users.php?type=admin" class="btn">see accounts</a>
      </div>
      <div class="box">
      <?php
         $select_accounts = $conn->prepare("SELECT COUNT(*) as total_accounts FROM `users`");
         $select_accounts->execute();
         $number_of_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)['total_accounts'];
      ?>
      <h3><?= $number_of_accounts; ?></h3>
      <p>total accounts</p>
      <a href="admin_users.php" class="btn">see accounts</a>
      </div>
      <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT COUNT(*) as total_messages FROM `message`");
         $select_messages->execute();
         $number_of_messages = $select_messages->fetch(PDO::FETCH_ASSOC)['total_messages'];
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>total messages</p>
      <a href="admin_contacts.php" class="btn">see messages</a>
      </div>
   </div>
</section>
<script src="js/script.js"></script>
</body>
</html>