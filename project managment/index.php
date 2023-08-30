<?php
include('connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50">
    <!--===== Navbar====== -->

    <div class="p-6 flex flex-wrap justify-between ">
        <a href="index.php" class='text-center  sm:m-auto md:m-0 lg:m-0'><img class="w-36 h-16 text-center"
                src="file/logo.png" alt="" />
        </a>
        <h1 class="font-extrabold text-4xl text-center pt-2  ">
            <span class=" "> FYP </span> Management System For
            <span class="text-red-900"> IIUI </span>
        </h1>
        <a href="#" class="flex items-center space-x-5 hover:text-red-900 sm:hidden lg:flex">
            <img class="w-10 h-10" src="file/user.png" alt="" />
        </a>
    </div>
    <!--===== Navbar====== -->

    <?php
    if (isset($_POST['login_btn'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM  faculty_tbl where email='$email'";
        $run = mysqli_query($conn, $query);
        $faculty_data = mysqli_fetch_array($run);
        if (!$faculty_data) {
            echo "<script>alert('username or password in incorrect')</script>";
        } else {
            $faculty_id =  $faculty_data['faculty_id'];
            $name_db = $faculty_data['name'];
            $dept_db = $faculty_data['department'];
            $email_db =  $faculty_data['email'];
            $contact_db = $faculty_data['phone_no'];
            $password_db =  $faculty_data['password'];
            $role = $faculty_data['role'];


            if ($email == $email_db && password_verify($password, $password_db)) {
                $_SESSION['LOGIN'] = 1;
                $_SESSION['id'] = $faculty_id;
                $_SESSION['name'] = $name_db;
                $_SESSION['department'] = $dept_db;
                $_SESSION['email'] = $email_db;


                if ($role == 'Coordinator') {
                    header('Location: coordinator/index.php');
                } elseif ($role == 'Supervisor') {
                    header('Location: supervisor/index.php');
                }
            } else {
                echo "<script>alert('username or password in incorrect')</script>";
            }
        }
    }

    ?>

    <!-- Login Here -->
    <div>


        <form action="index.php" method="post" class="grid cols-1 w-1/2 p-20 m-auto gap-4 bg-slate-100 shadow-lg mt-5">
            <h3 class="font-bold text-3xl text-center">
                Log
                <span class="text-red-900">In </span>
            </h3>
            <input type="email" name="email" placeholder="Email " class="w-2/3 m-auto p-2 outline-none" required />
            <input type="password" name="password" placeholder="Password " class="w-2/3 m-auto p-2 outline-none"
                required />

            <button type="submit" name="login_btn"
                class="text-center outline outline-[#927C48] py-1 px-6 text-[#927C48] rounded-md hover:bg-[#927C48] hover:text-white hover:outline-none m-auto">
                Login
            </button>


        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>