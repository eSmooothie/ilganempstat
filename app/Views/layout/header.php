<!DOCTYPE html>
<html lang="en" class="h-full" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <!-- JQUERY -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
    <!-- TAILWIND -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/output.css">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <!-- PAGE TITLE -->
    <title><?php echo $page_title; ?></title>
</head>
<body class=" h-full" style="font-family: 'Roboto', sans-serif;">
<header class="">
    <!-- NAVIGATION -->
    <nav class=" w-full flex justify-end font-medium space-x-12 px-10 bg-gray-700 py-2 bg-opacity-80">
        <a href="<?php echo "$base_url/";?>" class="text-white hover:text-green-400 cursor-pointer">Home</a>
        <a href="<?php echo "$base_url/graph";?>" class="text-white hover:text-green-400 cursor-pointer">Graph</a>
        <a href="<?php echo "$base_url/form";?>" class="text-white hover:text-green-400 cursor-pointer">Form</a>
        <a href="<?php echo "$base_url/about";?>" class="text-white hover:text-green-400 cursor-pointer">About</a>
        <a href="<?php echo "$base_url/profile";?>" class="text-white hover:text-green-400 cursor-pointer">Profile</a>
    </nav>
    <!-- BANNER -->
    <div class="">
        <?php 
        if($is_image){
            ?>
            <img src="<?php echo $banner_path; ?>" alt="banner"
            class=" w-screen h-96 object-fill">
            <?php
        }else{
            ?>
            <video src="<?php echo $banner_path;?>" 
            class=" w-screen h-96 object-fill" autoplay loop muted preload="metadata"></video>
            <?php
        }
        ?>
    </div>
</header>
