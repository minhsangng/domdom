<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true || strpos($currentPath, "orderstaff") == true || strpos($currentPath, "kitchenstaff") == true)
    $path = "../../../model/mPromotions.php";
else $path = "./model/mPromotions.php";

if (!class_exists("mPromotions"))
    require_once($path);
    
class cPromotions extends mPromotions
{
    public function showPromotionsHome()
    {
        if ($this->showPromotions()) {
            $result = $this->showPromotions();
            $count = 0;
            $bg = "";
            $color = "";
            $img_pomotion = "";

            while ($row = $result->fetch_assoc()) {
                $count++;
                $img_pomotion = "images/promotion/".$row["image"];
                if (!file_exists($img_pomotion))
                    $img_pomotion = "images/nodish.png";
                    
                if ($count % 2 == 0) {
                    $bg = "#EF5350";
                    $color = "rgb(255, 255, 255)";
                } else {
                    $bg = "rgba(255, 255, 255)";
                    $color = "#EF5350";
                }

                echo "
                    <div class='rounded-3xl pb-6 flex flex-col items-center h-fit relative hover:scale-125 transition-all' style='background-color: " . $bg . "; color: " . $color . ";'>
                        <img alt='" . $row["promotionName"] . "' class='rounded-full size-48 absolute bottom-32 border-dark-300 border-2' src='".$img_pomotion."'/>
                        <h2 class='text-lg font-semibold mt-32 mb-2'>" . $row["promotionName"] . "</h2>
                        <p class='text-md text-center'>" . $row["description"] . "</p>
                    </div>";
            }
        } else echo "<p class='text-center col-span-3'>Chưa có dữ liệu!</p>";
    }
    
    public function showPromotionsList($sql)
    {
        if ($this->showPromotions()) {
            $result = $this->showPromotions();
            $img_pomotion = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_pomotion = "images/promotion/".$row["image"];
                if (!file_exists($img_pomotion))
                    $img_pomotion = "images/nodish.png";
                    
                echo "<div class='mx-auto relative'>
                    <a href=''>
                        <img src='".$img_pomotion."' alt='".$row["promotionName"]."' class='border-2 rounded-3xl w-80 h-48'>
                        <div class='absolute top-40 left-14 w-2/3 text-center p-3 rounded-lg h-60 hover:-translate-y-10 hover:scale-125 transition-all' style='background-color: var(--third-color);'>
                            <h3 class='text-lg font-bold uppercase text-red-500'>".$row["promotionName"]."</h3>
                            <hr class='my-2'>
                            <p>".$row["description"]."</p>
                            <p class='text-base'>".$row["startDate"]." <br> đến <br> ".$row["endDate"]."</p>
                        </div>
                    </a>
                </div>";
            }
        } else echo "<p class='text-center col-span-3'>Chưa có dữ liệu!</p>";
    }
    
    public function cGetAllPromotion() {
        if ($this->mGetAllPromotion() != 0) {
            $result = $this->mGetAllPromotion();
            
            if ($result->num_rows > 0)
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td class='py-2 border-2'>#KM0" . ($row["promotionID"] < 10 ? "0".$row["promotionID"] : $row["promotionID"]) . "</td>
                            <td class='py-2 border-2'>" . $row["promotionName"] . "</td>
                            <td class='py-2 border-2 w-40'>" . $row["description"] . "</td>
                            <td class='py-2 border-2'>" . str_replace(".00", "%", $row["discountPercentage"]). "</td>
                            <td class='py-2 border-2'>" . $row["startDate"] . "</td>
                            <td class='py-2 border-2'>" . $row["endDate"] . "</td>
                            <td class='py-2 border-2'><img src='../../../images/promotion/" . $row["image"] . "' alt='".$row["promotionName"]."' class='size-24' /></td>
                            <td class='py-2 border-2 text-" . ($row["status"] == 1 ? "green" : "red") . "-500'>" . ($row["status"] == 1 ? "Đang áp dụng" : "Ngưng áp dụng") . "</td>
                            <td class='py-2 border-2 flex justify-center items-center h-28'>
                                <button class='btn btn-secondary mr-1' name='btncapnhat' value='" . $row["promotionID"] . "'>Cập nhật</button>
                                <button class='btn btn-danger ml-1' name='btnkhoa'>Xóa</button>
                            </td>
                        </tr>";
                }
            else echo "<tr><td colspan='9' class='text-center pt-2'>Chưa có dữ liệu!</td></tr>";
        }
    }
    
    public function cGetPromotionNotStatus($status) {
        if ($this->mGetPromotionNotStatus($status) != 0) {
            $result = $this->mGetPromotionNotStatus($status);
            
            return $result;
        }
    }
    
    public function cGetPromotionById($proID) {
        if ($this->mGetPromotionById($proID) != 0) {
            $result = $this->mGetPromotionById($proID);
            
            return $result->fetch_assoc();
        }
    }
    
    public function cInsertPromotion($proName, $des, $percent, $start, $end, $image, $status) {
        if ($this->mInsertPromotion($proName, $des, $percent, $start, $end, $image, $status) != 0) {
            echo "<script>alert('Thêm khuyến mãi thành công');</script>";
        }
    }
    
    public function cUpdatePromotion($proName, $des, $percent, $start, $end, $image, $status) {
        if ($this->mInsertPromotion($proName, $des, $percent, $start, $end, $image, $status) != 0) {
            echo "<script>alert('Cập nhật khuyến mãi thành công');</script>";
        }
    }
    
    public function cLockPromotion($proID) {  
        if ($this->mLockPromotion($proID) != 0) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                confirm('Bạn có chắc chắn khóa tài khoản này?');
            });
          </script>";
        }
    }
}
