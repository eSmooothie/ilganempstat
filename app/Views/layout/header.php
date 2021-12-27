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
    <!-- FLOWBITE -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" /> -->
    <!-- GENERAL JS -->
    <script src="<?php echo $base_url;?>/assets/js/function.js"></script>
    <!-- PAGE TITLE -->
    <title><?php echo $page_title; ?></title>
</head>
<body class=" h-full" style="font-family: 'Roboto', sans-serif;">
<!-- HEADER -->
<header class="">
    <!-- NAVIGATION -->
    <nav class=" w-full flex justify-end font-medium space-x-12 px-10 bg-gray-700 py-2 bg-opacity-80">
        <a href="<?php echo "$base_url/";?>" class="text-white hover:text-green-400 cursor-pointer uppercase">Home</a>
        <a href="<?php echo "$base_url/graph";?>" class="text-white hover:text-green-400 cursor-pointer uppercase">Graph</a>
        <?php if($is_login){ ?>
            <a href="<?php echo "$base_url/form";?>" class="text-white hover:text-green-400 cursor-pointer uppercase">Form</a>
        <?php } ?>
        <a href="<?php echo "$base_url/about";?>" class="text-white hover:text-green-400 cursor-pointer uppercase">About</a>
        <?php if($is_login) {?>
        <a href="<?php echo "$base_url/profile";?>" class="text-white hover:text-green-400 cursor-pointer uppercase">Profile</a>
        <?php }else{ ?>
            <button href="<?php echo "$base_url/login";?>" 
            class="text-white hover:text-green-400 cursor-pointer uppercase font-medium" 
            data-modal-toggle="login-modal">Login</button>
        <?php } ?>
        <?php if($is_login){ ?>
            <a href="<?php echo "$base_url/sign_out";?>" 
            class="text-white hover:text-green-400 cursor-pointer uppercase font-medium" 
            >Sign out</a>
        <?php } ?>
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
<!-- LOGIN MODAL -->
<div id="login-modal" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button" 
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" 
                data-modal-toggle="login-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" id="login_form">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your username</label>
                    <input type="text" name="username" id="username" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                    placeholder="username" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div class="mb-6">
                    <p class="font-medium mt-2 text-sm text-red-600" id="validation_msg"></p>
                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Not registered? <a target="_blank" href="<?php echo $base_url;?>/register" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                </div>
            </form>
        </div>
    </div>
</div> 