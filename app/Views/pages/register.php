<!DOCTYPE html>
<html lang="en" class="h-full" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JQUERY -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
    <!-- TAILWIND -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/output.css">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <!-- FLOWBITE -->
    <!-- GENERAL JS -->
    <script src="<?php echo $base_url;?>/assets/js/function.js"></script>
    <!-- PAGE TITLE -->
    <title><?php echo $page_title; ?></title>
</head>
<body class=" h-full bg-gradient-to-tr to-teal-500 from-blue-500 " style="font-family: 'Roboto', sans-serif;">
    <div class="w-1/2 mx-auto h-full flex items-center">
        <form id="register" class=" w-10/12 mx-auto border border-black p-10 bg-gray-100 rounded-lg">
            <div class="mb-6">
                <p class="font-medium text-center">Create Account</p>
            </div>
            <div class="mb-6">
                <label for="username" 
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                focus:border-blue-500 block w-full p-2.5 
                " placeholder="" required>
            </div>
            <div class="mb-6">
                <label for="password" 
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
                rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                " placeholder="" required>
            </div>
            <div class="mb-6">
                <label for="confirm_password" 
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
                rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                " placeholder="" required>
            </div>
            <div class="mb-6 hidden text-center" id="err_msg_container">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>&nbsp;<span id="err_message"></span></p>
            </div>
            <div class="mb-6 hidden text-center" id="suc_msg_container">
                <p class="mt-2 text-sm text-green-600 dark:text-green-500">
                    <span class="font-medium">Success!</span>
                </p>
                <a href="/" class="mt-2 text-sm text-blue-600 dark:text-blue-500 underline font-medium">Back to Home</a>
            </div>
            <div class="flex justify-center">
                <button type="submit" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Register new account</button>
            </div>
        </form>
    </div>    
</body>
</html>

<script>
    $(document).ready(function(){
        
        $('#register').submit(function(e){
            e.preventDefault();

            const formData = $(this).serializeArray();

            // validate password
            const pass = formData[1]['value'];
            const confirm_pass = formData[2]['value'];
            const is_match = pass.localeCompare(confirm_pass);

            if(is_match != 0){
                document.getElementById('err_message').innerHTML = "Password does not match";
                document.getElementById('err_msg_container').classList.remove("hidden");
                document.getElementById('suc_msg_container').classList.add("hidden");
                document.getElementById('password').value = '';
                document.getElementById('confirm_password').value = '';
            }else{
                const path = "create/account";
                sendPostRequest({
                    path : path,
                    data : formData,
                    done : function(data){
                        if(data['data'] == null){
                            document.getElementById('err_message').innerHTML = data['message'];
                            document.getElementById('err_msg_container').classList.remove("hidden");
                            document.getElementById('suc_msg_container').classList.add("hidden");
                            document.getElementById('password').value = '';
                            document.getElementById('confirm_password').value = '';
                            document.getElementById('username').value = '';
                        }else{
                            document.getElementById('suc_msg_container').classList.remove("hidden");
                            document.getElementById('err_msg_container').classList.add("hidden");
                            document.getElementById('password').value = '';
                            document.getElementById('confirm_password').value = '';
                            document.getElementById('username').value = '';
                        }
                    },
                });
            }
        });
    });
</script>