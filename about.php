<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    
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
        background-color:whitesmoke; 
    }
    nav a:hover{
        text-decoration: underline;
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
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .container p{
        font-size: 18px;
    }
    .image-text  {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding-top: 30px;
    }
    .image-text div {
        flex: 1;
        padding: 20px;
        background-color: #c7eec9;
        border-radius: 8px;
        text-align: center;
    }
    .image-text div h2 {
        font-size: 28px;
        color: #4CAF50;
        margin-bottom: 10px;
    }
    .image-text div img {
        width: 100%;
        max-width: 500px;
        height: auto;
    }
    .image-tex div p{
        font-size: 18px;
        color: #555;
    }     
    .vision-mission {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }
    .vision-mission div {
        flex: 1;
        padding: 20px;
        background-color: #eaf7ea;
        border-radius: 8px;
        text-align: center;
    }
    .vision-mission div h3 {
        font-size: 28px;
        color: #4CAF50;
        margin-bottom: 10px;
    }
    .vision-mission div p {
        font-size: 18px;
        color: #555;
    }
    .other-content {
        text-align: center;
    }
    .other-content img {
        margin-bottom: 20px;
        border-radius: 8px;
    }
    .other-content p {
        font-size: 25px;
        color: #555;
        line-height: 1.8;
    }
    .header .icon-buttons {
        display: flex;
        gap: 20px;
    }
    .icon-buttons button {
        background-color: transparent;
        border: none;
        color: white;
        cursor: pointer;
        font-size: 18px;
    }
    .icon-buttons button:hover {
     color: #ccc;
    }
    /* media queries */
    @media (max-width: 768px) {
        .image-text {
            flex-direction: column;
        }
        .image-text div {
            padding: 10px;
        }
        .image-text div img {
            max-width: 100%;
        }
        .vision-mission {
            flex-direction: column;
        }
        .vision-mission div {
            padding: 10px;
        }
    }
    @media (max-width: 480px) {
        .container {
            padding: 10px;
        }
        .image-text, .vision-mission {
            flex-direction: column;
        }
        .image-text div, .vision-mission div {
            padding: 10px;
        }
        .image-text div img, .vision-mission div img {
            max-width: 100%;
        }
        .header .icon-buttons {
            flex-direction: column;
            gap: 10px;
        }
        .icon-buttons button {
            font-size: 16px;
        }
    }
</style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>About Us</h1>
    <p>We are a team of dedicated farmers and agricultural specialists committed to bringing you the best products. Our mission is to promote sustainable farming while providing top-quality produce.</p>
</div>
</head>
    <!-- Main Content Container -->
    <div class="container">

        <!-- Vision and Mission Section -->
        <div class="section vision-mission">
            <div class="vision">
                <h3>Our Vision</h3>
                <p>To lead the agricultural industry with innovation and sustainability, empowering farmers with modern tools to create a greener, more productive world.</p>
            </div>
            <div class="mission">
                <h3>Our Mission</h3>
                <p>To provide cutting-edge, eco-friendly products and services that improve farming efficiency, increase productivity, and support global food security.</p>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="section image-text">
            <div class="text">
                <h2>Who We Are</h2>
                <p>
                    Agri Root is a global leader in agricultural innovation, focusing on sustainable solutions for farmers of all scales. Our team is comprised of agricultural scientists, technologists, and experts who are passionate about making farming smarter and more efficient.
                </p>
                <p>
                    With over 20 years of experience, we have built a reputation for excellence, offering a comprehensive portfolio of products ranging from organic fertilizers and seeds to advanced farming technologies and equipment.
                </p>
            </div>
            <div class="image">
            <img src="images\about.jpg" alt="About Us Image">
            </div>
        </div>

        <!-- Our Values Section -->
        <div class="section image-text">
           <div class="image">
            <img src="images\abt.jpg" alt="Values Image">
            </div>
            <div class="text">
            <h2>Our Values</h2>
            <p>
                We believe in the power of innovation, sustainability, and collaboration. Our values guide us in our quest to create farming solutions that benefit both the environment and the global food supply. By partnering with communities, farmers, and stakeholders, we aim to create lasting change and growth.
            </p>
            </div>
        </div>

        <!-- Sustainability Goals Section -->
        <div class="section image-text">
            <div class="text">
            <h2>Our Sustainability Goals</h2>
            <p>
                At Agri Root, sustainability isn't just a buzzword—it's a core tenet of our business. From reducing carbon footprints in farming to minimizing waste and water usage, our sustainability goals drive our innovation. We are committed to offering eco-friendly products that meet the needs of the planet and its people.
            </p>
        </div>
        <div class="image">
            <img src="images\goal.jpg" alt="Sustainability Image">
        </div>
        </div>

        <!-- Other Content Section -->
        <div class="section image-text">
            <div class="image">
                 <img src="images\world.jpg" alt="Global Impact Image">
            </div>
            <div class="text">
            <h2>Our Global Impact</h2>
                       <p>
                Agri Root has touched the lives of millions of farmers around the world. Our reach spans across continents, empowering rural and urban farmers alike with the tools they need to thrive in a changing world. Our global network allows us to address the unique challenges faced by diverse agricultural communities, ensuring that everyone benefits from our innovations.
            </p>
        </div>
        </div>

    </div>
    
<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>



