<?php

session_start();

include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    $check_email = "SELECT * FROM `user947` WHERE email = '$email'";
    $email_query = mysqli_query($conn, $check_email);

    $email_count = mysqli_num_rows($email_query);

    if ($email_count > 0) {
        echo "<script>
        alert('Email Already Registered');
        </script>";
    } else {
        if ($password === $cpassword) {
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `user947` (`name`, `email`, `password`) VALUES ('$name', '$email', '$pass')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>
                    alert('Account Created Successfully');
                    location = '/cab';
                </script>";
            } else {
                echo "<script>
                    alert('Account not created');
                </script>";
            }
        } else {
            echo "<script>
                alert('Password doesn't match ');
            </script>";
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
    <link rel="icon" href="Assets/images/cab.png" type="image/x-icon">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/utils.css">
    <script src="JavaScript/main.js"></script>
    <title>Ride With Me - Signup</title>
</head>

<body>
    <div class="main">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-2 mx-auto flex flex-wrap items-center">
                <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                    <h1 class="title-font font-bold text-3xl text-black">Welcome To Ride With Me - Cab Service</h1>
                    <p class="leading-relaxed mt-4 text-black">Create an Account</p>
                </div>
                <form class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0" name="myForm" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Sign Up</h2>
                    <div class="relative mb-4">
                        <label for="username" class="leading-7 text-sm text-gray-600">Full Name</label>
                        <input type="text" id="username" name="username" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                    </div>
                    <div class="relative mb-4">
                        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                        <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                    </div>
                    <div class="relative mb-4">
                        <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
                        <input type="password" id="password" name="password" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required minlength="6" maxlength="18">
                    </div>
                    <div class="relative mb-4">
                        <label for="cpassword" class="leading-7 text-sm text-gray-600">Confirm Password</label>
                        <input type="password" id="cpassword" name="cpassword" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required minlength="6" maxlength="18">
                    </div>
                    <div class="flex items-center pl-4">
                        <input id="toggle" type="checkbox" value="" name="bordered-checkbox" class="w-4 h-4 mb-8 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="bordered-checkbox-1" class="w-full py-4 ml-2 mb-8 text-sm font-medium text-gray-900 dark:text-gray-300">Show Password</label>
                    </div>
                    <button type="submit" class="btn text-white border-0 py-2 px-8 focus:outline-none rounded text-lg">Create
                        Account</button>
                    <a class="text-xs mx-auto text-gray-500 mt-3" href="index">OR LOGIN</a>
                </form>
            </div>
        </section>
    </div>
    <script>
        const password = document.getElementById("password");
        const cpassword = document.getElementById("cpassword");
        const toggle = document.getElementById("toggle");

        toggle.addEventListener("click", function() {
            if (password.type === "password") {
                password.setAttribute('type', 'text');
                cpassword.setAttribute('type', 'text');
            } else {
                password.setAttribute('type', 'password');
                cpassword.setAttribute('type', 'password');
            }
        });
    </script>
</body>

</html>