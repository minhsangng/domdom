<?php
include("./model/mPromotions.php");

class cPromotions extends mPromotions
{
    public function showPromotionsHome($sql)
    {
        if ($this->showPromotions($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
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
                        <img alt='" . $row["promotionName"] . "' class='rounded-full size-48 absolute bottom-24 border-dark-300 border-2' src='".$img_pomotion."'/>
                        <h2 class='text-lg font-semibold mt-32 mb-2'>" . $row["promotionName"] . "</h2>
                        <p class='text-md text-center'>" . $row["description"] . "</p>
                    </div>";
            }
        } else echo "Không có dữ liệu.";
    }
    
    public function showPromotionsList($sql)
    {
        if ($this->showPromotions($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
            $img_pomotion = "";
            
            while ($row = $result->fetch_assoc()) {
                $img_pomotion = "images/promotion/".$row["image"];
                if (!file_exists($img_pomotion))
                    $img_pomotion = "images/nodish.png";
                    
                echo "<div class='mx-auto relative'>
                    <a href=''>
                        <img src='".$img_pomotion."' alt='".$row["promotionName"]."' class='border-2 rounded-3xl w-80 h-48'>
                        <div class='absolute top-40 left-14 w-2/3 text-center p-3 rounded-lg h-56 hover:-translate-y-10 hover:scale-125 transition-all' style='background-color: var(--third-color);'>
                            <h3 class='text-lg font-bold uppercase text-red-500'>".$row["promotionName"]."</h3>
                            <hr class='my-2'>
                            <p>".$row["description"]."</p>
                            <p class='text-base'>".$row["startDate"]." <br> đến <br> ".$row["endDate"]."</p>
                        </div>
                    </a>
                </div>";
            }
        } else echo "Không có dữ liệu.";
    }
}
