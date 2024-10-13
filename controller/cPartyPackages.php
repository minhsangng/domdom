<?php
include("./model/mPartyPackages.php");

class cPartyPackages extends mPartyPackages
{
    public function showPartyPackagesHome($sql)
    {
        if ($this->showPartyPackages($sql)) {
            $db = new Database;
            $conn = $db->connect();
            $result = $conn->query($sql);
            $count = 0;

            while ($row = $result->fetch_assoc()) {
                $count++;
                if ($count % 2 == 0)
                    echo "<div class='partypackage flex justify-between items-center mb-4 py-4 w-full border-b'>
                        <div class='w-3/5 text-left'>
                            <p class='font-bold text-3xl uppercase'>" . $row["partyPackageName"] . "</p>
                            <p class='text-gray-300 text-xl mt-2'>" . $row["price"] . "</p>
                            <button class='btn btn-danger mt-4 text-xl px-4 py-2 rounded-lg'>Xem thêm</button>
                        </div>
                        <div class='w-2/5'>
                            <img src='images/nodish.png' alt='" . $row["partyPackageName"] . "' class='w-full h-60 border-2' style='border-radius: 50% 30px 30% 0; border-color: var(--fourth-color);'>
                        </div>
                    </div>";
                else
                    echo "<div class='partypackage flex justify-between items-center py-4 w-full border-b'>
                        <div class='w-2/5'>
                            <img src='images/nodish.png' alt='" . $row["partyPackageName"] . "' class='w-full h-60 border-2'' style='border-radius: 30px 50% 0 30%; border-color: var(--fourth-color);'>
                        </div>
                        <div class='w-3/5 text-right'>
                            <p class='font-bold text-3xl uppercase'>" . $row["partyPackageName"] . "</p>
                            <p class='text-gray-300 text-xl mt-2'>" . $row["price"] . "</p>
                            <button class='btn btn-danger mt-4 text-xl px-4 py-2 rounded-lg'>Xem thêm</button>
                        </div>
                    </div>";
            }
        } else echo "Không có dữ liệu.";
    }
}
