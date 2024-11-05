<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quản trị hệ thống | Đăng nhập</title>
    <link rel="shortcut icon" href="../../../images/logo-nobg.png" type="image/x-icon" />

    <!-- Font Awesome CSS -->
    <link href="../../../view/css/all.css" rel="stylesheet" />

    <!-- Preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../view/css/bootstrap.min.css" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="../../../view/css/style.css" />

    <!-- Tailwind CSS -->
    <script src="../../../view/js/tailwindcss.js"></script>

    <!-- jQuery -->
    <script src="../../../view/js/jquery.min.js"></script>

    <!-- Chart -->
    <script src="../../../view/js/chart.js"></script>

    <!-- Font Awesome JS -->
    <script src="../../../view/js/all.js"></script>

    <!-- Bootstrap JS (bundle includes Popper.js) -->
    <script src="../../../view/js/bootstrap.bundle.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: "Playwrite DE Grund", cursive;
        }

        .firefly {
            position: absolute;
            background-color: rgba(255, 223, 0, 0.6);
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(255, 223, 0, 0.8);
            width: 8px;
            height: 8px;
            opacity: 0;
            animation: firefly-flicker 3s infinite alternate,
                firefly-move 6s infinite linear;
        }

        @keyframes firefly-flicker {

            0%,
            100% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }
        }

        @keyframes firefly-move {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(calc(100vw - 10px), calc(100vh - 10px));
            }
        }
        
        .swal2-modal {
            width: 50%;
            border-radius: 15px;
        }
        
        .swal2-icon {
            font-size: 0.8rem;
        }
        
        .swal2-title {
            font-size: 1.3rem;
        }
        
        .swal2-confirm {
            border-radius: 8px;
            padding: 6px 20px;
        }
    </style>
</head>

<?php
session_start();

include("../../../model/connect.php");
$db = new Database;
$conn = $db->connect();

if (isset($_POST["btndn"])) {
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    if (empty($email) || empty($psw))
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Vui lòng nhập đầy đủ thông tin!',
                    icon: 'warning',
                    confirmButtonColor: 'red',
                    confirmButtonText: 'Đồng ý'
                });
            });
        </script>";
    else {
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$psw'";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $_SESSION["userName"] = $row["userName"];
            $_SESSION["login"] = 1;

            switch ($row["roleID"]) {
                case 1:
                    echo "<script>window.location.href = '../admin/index.php'</script>";
                    break;
                case 2:
                    echo "<script>window.location.href = '../manager/index.php'</script>";
                    break;
                case 3:
                    echo "<script>window.location.href = '../orderstaff/index.php'</script>";
                    break;
                case 4:
                    echo "<script>window.location.href = '../kitchenstaff/index.php'</script>";
                    break;
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Thông tin đăng nhập không hợp lệ. Vui lòng nhập lại!',
                        icon: 'warning',
                        confirmButtonColor: 'red',
                        confirmButtonText: 'Đồng ý'
                    });
                });
            </script>";
        }
    }
}
?>

<body class="overflow-hidden" style="background: linear-gradient(135deg, #0d1b2a, #1b263b 40%, #243447 70%, #2a2a2a 90%);">
    <div class="flex h-screen w-screen">
        <div class="w-1/3 h-5/6 bg-transparent flex border-sky-400 border-2 flex-col justify-center items-center p-10 mx-auto my-auto rounded-lg" style="box-shadow: 0 0 10px rgb(56, 189, 248);">
            <div class="mb-8 flex flex-col items-center justify-center">
                <img alt="Logo" class="mb-4 size-24 rounded-full" src="../../../images/logo.png" />
                <h1 class="text-[#ffdd87] text-2xl font-semibold mb-2">ĐĂNG NHẬP</h1>
                <p class="text-gray-500">Welcome back!</p>
            </div>
            <div class="w-full max-w-sm">
                <form action="" method="POST">
                    <div class="relative mb-4">
                        <i class="fas fa-user absolute left-4 top-3 text-[#8ecae6]"></i>
                        <input type="email" class="w-full border border-gray-300 py-2 px-5 rounded-lg form-control" name="email"
                            placeholder="Email" />
                    </div>
                    <div class="relative mb-10">
                        <i class="fas fa-lock absolute left-4 top-3 text-[#8ecae6]"></i>
                        <input type="password" class="w-full border border-gray-300 py-2 px-5 rounded-lg form-control" name="psw"
                            placeholder="Mật khẩu" />
                    </div>
                    <!-- <div class="flex justify-center items-center mt-10 mb-4 text-sm">
                        <input type="radio" name="role" id="role1" value="1"
                            class="mr-1 size-4 rounded-full peer/role1 accent-amber-700" /><label for="role1"
                            class="text-gray-500 peer-checked/role1:text-amber-700">QLCCH</label>
                        <input type="radio" name="role" id="role2" value="2"
                            class="ml-6 mr-1 size-4 rounded-full peer/role2 accent-amber-700" /><label for="role2"
                            class="text-gray-500  peer-checked/role2:text-amber-700">QLCH</label>
                        <input type="radio" name="role" id="role3" value="3"
                            class="ml-6 mr-1 size-4 rounded-full peer/role3 accent-amber-700" /><label for="role3"
                            class="text-gray-500  peer-checked/role3:text-amber-700">NVND</label>
                        <input type="radio" name="role" id="role4" value="4"
                            class="ml-6 mr-1 size-4 rounded-full peer/role4 accent-amber-700" /><label for="role4" 
                            class="text-gray-500 peer-checked/role4:text-amber-700">NVB</label>
                    </div> -->
                    <button class="w-full text-white py-2 px-4 rounded-lg btn btn-primary" name="btndn">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const fireflyCount = 20;

        for (let i = 0; i < fireflyCount; i++) {
            let firefly = document.createElement("div");
            firefly.classList.add("firefly");
            firefly.style.left = Math.random() * 100 + "vw";
            firefly.style.top = Math.random() * 100 + "vh";
            firefly.style.animationDelay = Math.random() * 5 + "s";
            firefly.style.animationDuration = 5 + Math.random() * 5 + "s";
            document.body.appendChild(firefly);
        }
    </script>
</body>

</html>