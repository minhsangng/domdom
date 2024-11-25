
<?php
    session_start();
    if(!isset($_SESSION['giohang'])) $_SESSION['giohang']=[];
    if(isset($_GET['delcart'])&&($_GET['delcart'])==1) unset($_SESSION['giohang']);
    if(isset($_POST['addcart'])){
        $image=$_POST['image'];
        $dishName=$_POST['dishName'];
        $price=(float)$_POST['price'];
        $quantityofcart=(int)$_POST['quantityofcart'];
        //Kiem tra sp đã có trong giỏ hàng chưa 
        $fl=0;
        for($i=0; $i< sizeof($_SESSION['giohang']); $i++){
            if($_SESSION['giohang'][$i][1]==$dishName){
                $fl=1;
                $soluongnew=$quantityofcart+$_SESSION['giohang'][$i][3];
                $_SESSION['giohang'][$i][3]=$soluongnew;
                break;  
            }
        }
        //Them moi san pham vao gio hang
        if($fl==0){
            $sp=array($image,$dishName,$price,$quantityofcart);
            $_SESSION['giohang'][]=$sp;
        }
        // var_dump($_SESSION['giohang']);git checkout Hieu
    }

    function showgiohang(){
        if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
            $tong=0;
            for($i=0; $i< sizeof($_SESSION['giohang']); $i++){
                $total=(float)$_SESSION['giohang'][$i][2] * (int)$_SESSION['giohang'][$i][3];
                echo $_SESSION['giohang'][$i][0].'<br>';
                echo'<tr>
                        <td>'.($i+1).'</td>
                        <td><img src="images/dish/'.$_SESSION['giohang'][$i][0]. '" alt="" style="width: 80px; height: 80px;"></td>
                        <td>'.$_SESSION['giohang'][$i][1].'</td>
                        <td>'.$_SESSION['giohang'][$i][2].'</td>
                        <td>'.$_SESSION['giohang'][$i][3].'</td>
                        <td>
                            <div>'.$total.'</div>
                        </td>
                    </tr>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .cart-header {
            text-align: center;
            color: #E67E22;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .cart-item .details {
            flex: 1;
            margin-left: 15px;
        }
        .cart-item .details h3 {
            margin: 0;
            font-size: 18px;
        }
        .cart-item .actions {
            text-align: right;
        }
        .cart-item .actions p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="cart-container">
        <h2 class="cart-header">Giỏ Hàng</h2>
        <table class="table table-bordered cart-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php showgiohang(); ?>
            </tbody>
        </table>
        <div class="text-end mt-4">
            <a href="cart.php?delcart=1" class="btn btn-secondary">Xóa giỏ hàng</a>
            <a href="checkout.php" class="btn btn-success">Thanh Toán</a>
            <a href="" class="btn btn-secondary">Tiếp tục mua sắm</a>
        </div>
    </div>

</body>
</html>
