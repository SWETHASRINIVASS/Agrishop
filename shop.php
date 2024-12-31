<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to cart!';
   }

}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>shop</title>

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">
        <script>
        function updatePrice(selectElement, priceInputId, displayPriceId) {
            const prices = {
                "250g": 70,
                "500g": 150,
                "1kg": 250
            };
            const selectedQuantity = selectElement.value;
            const priceInput = document.getElementById(priceInputId);
            const displayPrice = document.getElementById(displayPriceId);
            priceInput.value = prices[selectedQuantity];
            displayPrice.textContent = "Rs " + prices[selectedQuantity];
        }
    </script>

        <title>Agri Root Products</title>
        <style>

    .container {
        max-width: 1700px;
        margin: auto;
        padding: 30px;
        background-color:rgb(91, 218, 115) ;
        margin:0;
        font-size: 15px;
    } 
    h1 {
    text-align: center;
    color: #333;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 20px;
    }
    .product {
        background-color: white;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .product img {
        width: 100%;
        height: 360px;
        object-fit: cover;
        border-radius: 10px;
    }
    .product h3 {
        margin: 15px 0;
        font-size: 1.2em;
        color: #333;
    }
    .price span {
        font-weight: lighter;
        color: #333;
    }
    .quantity-selection {
        margin-bottom: 15px;
    }
    button {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.5rem;
        margin-top: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    button:hover {
        background-color: orange;
    }
    .product .name {
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 2rem;
    }
    .product .quantity .selection{
        margin-bottom: 10px;
    }
    /* media queries */
    @media (max-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
        .product img {
            height: 200px;
        }
        button {
            font-size: 1rem;
            padding: 8px 16px;
        }
    }

</style>

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>Agri Root Products</h1>
    <div class="product-grid">
    
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="product">
         <form action="" method="post">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="p_name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="p_price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="p_image" value="uploaded_img/<?= $fetch_product['image']; ?>">
            <img src="uploaded_img/<?= $fetch_product['image']; ?>" alt="">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="quantity-selection">
                <select onchange="updatePrice(this, 'price_<?= $fetch_product['id']; ?>', 'display_price_<?= $fetch_product['id']; ?>')">
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
         </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">No products available!</p>';
         }
      ?>
   
        <!-- Product 1 -->
        <div class="product">
            <img src="images\bitter guard.png" alt="Product 1">
            <h3>Bitter Guard Seeds</h3>
            <form action="shop.php" method="POST">
            <div class="quantity-selection">
                <select onchange="updatePrice(this, 'price_<?= $fetch_product['id']; ?>')">>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <!-- <form action="shop.php" method="POST"> -->
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Bitter Guard Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\bitter guard.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Product 2 -->
        <div class="product">
            <img src="images\bottel guard.png" alt="Product 2">
            <h3>Bottle Guard Seeds</h3>
            <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="bottel guard Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\bottel guard.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Product 3 -->
        <div class="product">
            <img src="images\brinjal.png" alt="Product 3">
            <h3>Brinjal Seeds</h3>
                <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Brinjal Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\brinjal.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Product 4 -->
        <div class="product">
            <img src="images\coriander.png" alt="Product 4">
            <h3>Coriander seeds</h3>
            <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Coriander Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\coriander.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Product 5 -->
        <div class="product">
            <img src="images\fenugreek.png" alt="Product 5">
            <h3>Fenugreek Seeds</h3>
            <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Fenugreek Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\fenugreek.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Product 6 -->
        <div class="product">
            <img src="images\moringa.png" alt="Product 6">
            <h3>Moringa Seeds</h3>
            <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Moringa Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\moringa.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Product 7 -->
        <div class="product">
            <img src="images\mustard.png" alt="Product 7">
            <h3>Mustard Seeds</h3>
            <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Mustard Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\mustard.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Product 8 -->
        <div class="product">
            <img src="images\onion.png" alt="Product 8">
            <h3>Onion Seeds</h3>
            <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Onion Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\onion .png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
         <!-- Product 9 -->
         <div class="product">
            <img src="images\pea.png" alt="Product 9">
            <h3>Pea Seeds</h3>
            <div class="quantity-selection">
                <select>
                    <option value="250g">250g - Rs.70</option>
                    <option value="500g">500g - Rs.150</option>
                    <option value="1kg">1kg - Rs.250</option>
                </select>
            </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Pea Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\pea.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
 <!-- Product 10 -->
 <div class="product">
    <img src="images\pumpkin.png" alt="Product 10">
    <h3>Pumpkin Seeds</h3>
    <div class="quantity-selection">
        <select>
            <option value="250g">250g - Rs.70</option>
            <option value="500g">500g - Rs.150</option>
            <option value="1kg">1kg - Rs.250</option>
        </select>
    </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Pumpkin Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\pumpkin.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
</div>
 <!-- Product 11 -->
 <div class="product">
    <img src="images\radish.png" alt="Product 11">
    <h3>Radish Seeds</h3>
    <div class="quantity-selection">
        <select>
            <option value="250g">250g - Rs.70</option>
            <option value="500g">500g - Rs.150</option>
            <option value="1kg">1kg - Rs.250</option>
        </select>
    </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Radish Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\radish.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
</div>
 <!-- Product 12 -->
 <div class="product">
    <img src="images\tomato.png" alt="Product 12">
    <h3>Tomato Seeds</h3>
    <div class="quantity-selection">
        <select>
            <option value="250g">250g - Rs.70</option>
            <option value="500g">500g - Rs.150</option>
            <option value="1kg">1kg - Rs.250</option>
        </select>
    </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Tomato Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\tomato.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
</div>
 <!-- Product 13 -->
 <div class="product">
    <img src="images\watermelon seed.png" alt="Product 13">
    <h3>Watermelon Seeds</h3>
    <div class="quantity-selection">
        <select>
            <option value="250g">250g - Rs.70</option>
            <option value="500g">500g - Rs.150</option>
            <option value="1kg">1kg - Rs.250</option>
        </select>
    </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Watermelon Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\watermelon.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
</div>
 <!-- Product 14 -->
 <div class="product">
    <img src="images\Wheat Seeds.png" alt="Product 14">
    <h3>Wheat</h3>
    <div class="quantity-selection">
        <select>
            <option value="250g">250g - Rs.70</option>
            <option value="500g">500g - Rs.150</option>
            <option value="1kg">1kg - Rs.250</option>
        </select>
    </div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Wheat Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\Wheat Seeds .png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
</div>
 <!-- Product 15 -->
 <div class="product">
    <img src="images\muskmelon.png" alt="Product 15">
    <h3>Muskmelon Seeds</h3>
    <div class="quantity-selection">
        <select>
            <option value=" 250g">250g - Rs.70</option>
            <option value="500g">500g - Rs.150</option>
             <option value="1kg">1kg - Rs.250</option>
        </select>
</div>
            <form action="shop.php" method="POST">
            <input type="hidden" name="pid" value="1">
            <input type="hidden" name="p_name" value="Muskmelon Seeds">
            <input type="hidden" name="p_price" value="70">
            <input type="hidden" name="p_image" value="images\muskmelon.png">
            <button type="submit" name="add_to_wishlist">Add to wishlist</button>
            <button type="submit" name="add_to_cart">Add to Cart</button>
     </form>
</div>
    </div>
</div>



<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>