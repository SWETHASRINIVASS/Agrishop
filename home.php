<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        list-style: none;
        scroll-behavior: smooth;
        text-decoration: none;
        }
        body{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            
            
        }
        nav a:hover{
            text-decoration: underline;
        }
        .banner{
            width:100%;
            height: 760px;
            background: url('images/banner.png');
            background-position:center;
            background-size: cover;
        
        }
        .container{
            max-width: 1200px;
            margin: 20px auto;
            padding: 0px;
            background-color:rgb(91, 218, 115);
        }
        h1{
            color: #28a745;
            text-align: center;
        }
        ul.products{
            display: flex;
            flex-wrap: wrap;
            list-style-type: none;
            padding: 0;
            justify-content: center;
        }
        ul.products li{
            flex: 1 1 30%;
            background-color: #f9f9f9;
            margin: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .content-section li{
            font-size: 15px;
        }
        ul.products li img{
            width: 100%;
            max-height: 150px;
            object-fit: cover;
        }
        .content-section{
            padding: 20px;
            /* background-color: #7fda9d; */
            text-align: center;
        }
        .content-section h2{
            font-size: 28px;
            margin-bottom: 20px;
        }
        .content-section p{
            font-size: 18px;
            line-height: 1.6;
        }
        .content-section ul{
            list-style: none;
        }
        .header .icon-buttons {
            display: flex;
            gap: 50px;
        
        }
        .icon-buttons button {
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 20px;
            margin-left: 50px;
        }
        .icon-buttons button:hover {
            color: #ccc;
        }

/* Media Queries */

@media (max-width: 768px) {
    .banner {
        height: 400px;
    }
    .content-section h2 {
        font-size: 24px; 
    }
    .content-section p {
        font-size: 16px; 
    }
    ul.products li {
        flex: 1 1 45%; 
    }
}

@media (max-width: 450px) {
    .banner {
        height: 300px; 
    }
    .content-section h2 {
        font-size: 20px; 
    }
    .content-section p {
        font-size: 14px; 
    }
    ul.products li {
        flex: 1 1 100%; 
    }
    .icon-buttons {
        flex-direction: column; 
        gap: 20px; 
    }
}
    </style>
</head>
<body>

<?php include 'header.php'; ?>
<!-- Banner for Home Page -->
<div class="banner">
    <img src="images/banner.pngimages" alt="">
    <!-- Add Banner Image Here -->
</div>

<!-- Content Section 1 -->
    <section class="content-section" >
        <h2>Welcome to Agri Root</h2>
        <p>
            Agri Root is a leading agricultural company committed to providing the best quality agricultural products for farms and markets across the world. Our goal is to revolutionize the farming industry by offering innovative and sustainable solutions.
        </p>
        <p>
            Our products are designed to ensure that farmers and distributors can maximize their yield and sustainability. Whether it's organic seeds, fertilizers, or farming equipment, we have everything you need.
        </p>
    </section>

    <!-- Content Section 2 -->
    <section class="content-section" >
        <h2>Who We Are</h2>
        <p>
            Agri Root was founded with the mission to innovate and lead in the field of agriculture. We believe that farming should be sustainable and profitable, and we work closely with our partners to create better products for the global market. Our team of experts is always looking for ways to improve efficiency, reduce waste, and increase production.
        </p>
    </section>

    <!-- Content Section 3 -->
    <section class="content-section" >
        <h2>Our Visionary Approach</h2>
        <p>
            Our vision is to create a future where agriculture meets innovation, creating harmony between nature and technology. We aim to empower farmers and producers with tools and knowledge that help create sustainable and profitable farming practices.
        </p>
    </section>

    <!-- Content Section 4 (Product List) -->
    <section class="content-section" >
        <h2>What We Sell</h2>
        <p>
            Explore our wide range of agricultural products. From premium quality seeds to state-of-the-art farming tools, we have everything you need to enhance your farming experience.
        </p>
        <ul>
            <li>Bitter Guard Seeds</li>
            <li>Bottle Guars Seeds</li>
            <li>Brinjal Seeds</li>
            <li>Coriander Seeds</li>
            <li>Fenugreek Seeds</li>
            <li>Moringa Seeds</li>
            <li>Muskmelon Seeds</li>
            <li>Mustard Seeds</li>
            <li>Wheat Seeds</li>
            <li>Onion Seeds</li>
            <li>Pea Seeds</li>
            <li>Pumpkin Seeds</li>
            <li>Radish Seeds</li>
            <li>Tomato Seeds</li>
            <li>Watermelon Seeds</li>
        </ul>
    </section>

    <!-- Content Section 5 (Contact Information) -->
    <section class="content-section">
        <h2>Get Connect To Us</h2>
        <p>
            We are always here to help! If you have any questions or inquiries, feel free to reach out to us.
        </p>
        
    </section>


<?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>



