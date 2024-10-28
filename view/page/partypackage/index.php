<title>Dịch vụ | DOMDOM - Chuỗi cửa hàng thức ăn nhanh</title>

<style>
    .arrow {
        animation: bounce 1.5s infinite;
        transition: all 1s linear;
    }

    .arrow:nth-child(2) {
        animation-delay: .15s;
    }

    .arrow:last-child {
        animation-delay: .25s;
    }

    @keyframes bounce {

        0%,
        20%,
        50% {
            transform: translateY(0);
            opacity: 0;
        }

        40% {
            transform: translateY(-15px);
        }

        60% {
            transform: translateY(-10px);
            opacity: 1;
        }

        80% {
            transform: translateY(0);
            opacity: 0.7;
        }

        100% {
            transform: translateY(0);
            opacity: 0.3;
        }
    }

    .text {
        transform: translatey(0px);
        animation: float 5s ease-in-out infinite;
        letter-spacing: 3px;
        color: #774f38;
        background-color: #ece5ce;
        padding: 50px;
        border-radius: 11px;
        box-shadow: 20px 20px #83af9b;
        font-family: "Baloo 2", cursive;
    }

    .text:after {
        transform: translatey(0px);
        animation: float2 5s ease-in-out infinite;
        content: ".";
        font-weight: bold;
        -webkit-text-fill-color: #ece5ce;
        text-shadow: 22px 22px #83af9b;
        text-align: left;
        font-size: 55px;
        width: 55px;
        height: 11px;
        line-height: 30px;
        border-radius: 11px;
        background-color: #ece5ce;
        position: absolute;
        display: block;
        bottom: -30px;
        left: 0;
        box-shadow: 22px 22px #83af9b;
        z-index: -2;
    }

    @keyframes float {
        0% {
            transform: translatey(0px);
        }

        50% {
            transform: translatey(-20px);
        }

        100% {
            transform: translatey(0px);
        }
    }

    @keyframes float2 {
        0% {
            line-height: 30px;
            transform: translatey(0px);
        }

        55% {
            transform: translatey(-20px);
        }

        60% {
            line-height: 10px;
        }

        100% {
            line-height: 30px;
            transform: translatey(0px);
        }
    }
</style>

<div class="flex flex-col justify-center items-center absolute top-48 left-28">
    <h2 class="text font-bold uppercase text-center relative text-3xl">Sử dụng ngay<Br />các gói dịch vụ <br> của chúng tôi! <br>
        <span class="text-sm italic">Tổ chức các bữa tiệc sẽ trở nên đơn giản</span< /h2>
            <!-- <div class="flex flex-col items-center absolute -bottom-36 left-52">
        <i class="fas fa-chevron-down arrow text-3xl text-gray-400 px-3 rounded-t-md" style="background-color: rgba(0, 0, 0, 0.3);"></i>
        <i class="fas fa-chevron-down arrow text-3xl text-gray-400 px-3" style="background-color: rgba(0, 0, 0, 0.3);"></i>
        <i class="fas fa-chevron-down arrow text-3xl text-gray-400 px-3 rounded-b-md" style="background-color: rgba(0, 0, 0, 0.3);"></i>
    </div> -->
</div>

<div class="w-full py-20 bg-white">
    <div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-3 gap-8 mx-14 flex justify-center gap-10 bg-gray-100 px-4 py-6 rounded-md">
        <?php
        /* $ctrl = new cPartyPackages;

        if ($ctrl->cGetAllPartyPackage() != 0) {
            $result = $ctrl->cGetAllPartyPackage(); */
            
            $sql = "SELECT *, GROUP_CONCAT(CONCAT(D.dishName) SEPARATOR ', ') AS Name FROM partypackage AS PP JOIN partypackage_dish AS PPD ON PP.partyPackageID = PPD.partyPackageID JOIN dish AS D ON D.dishID = PPD.dishID GROUP BY PPD.partyPackageID";
            
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<div class='h-fit w-fit rounded-lg flex justify-center items-center group bg-red-400 transition delay-200 ease-linear'>
                <div class='relative flex flex-col justify-center items-center px-6 py-4'>
                    <div class='w-48 mb-2 z-10'>
                        <img src='images/party/sinhnhat.png' class='w-full h-full rounded-lg'>
                    </div>
                    <span class='absolute bg-green-200 bottom-0 left-0 w-6 h-4 rounded-tr-full group-hover:rounded-lg group-hover:w-full group-hover:h-full transition-all ease-linear delay-150'></span>
                    <div class='text-white z-10'>
                        <h3 class='font-bold text-center text-xl group-hover:text-amber-500 '>" . $row["partyPackageName"] . "</h3>
                        <p class='text-wrap font-bold group-hover:text-gray-900'>Combo: <span class='text-gray-bold font-thin'>".$row["Name"]."</span></p>
                    </div>
                </div>
                <div class='translate-y-16 -translate-x-16 absolute opacity-[0.01] group-hover:opacity-100 group-hover:-translate-y-4 group-hover:translate-x-0 transition delay-100 z-10'>
                        <button class='btn btn-danger'>Đặt ngay</button>
                </div>
            </div>";
            }
        /* } */
        ?>
    </div>
</div>