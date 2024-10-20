<?php
$currentPath = $_SERVER["REQUEST_URI"];
$path = "";
if (strpos($currentPath, "admin") == true || strpos($currentPath, "manager") == true)
    $path = "../../../model/mIngredients.php";
else $path = "./model/mIngredients.php";

if (!class_exists("mIngredients"))
    require_once($path);

class cIngredients extends mIngredients
{
    public function cGetAllIngredient()
    {
        if ($this->mGetAllIngredient() != 0) {
            $result = $this->mGetAllIngredient();
            
            if ($result->num_rows > 0)
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td class='py-2 border-2'>#010" . $row["ingredientID"] . "</td>
                            <td class='py-2 border-2'>" . $row["ingredientName"] . "</td>
                            <td class='py-2 border-2'>" . $row["unitOfcalculaton"] . "</td>
                            <td class='py-2 border-2'>" . str_replace(".00", "", number_format($row["price"], "2", ".", ",")) . "</td>
                            <td class='py-2 border-2'>" . $row["typeIngredient"] . "</td>
                            <td class='py-2 border-2 flex justify-center'>
                                <button class='btn btn-secondary mr-1' name='btncapnhat' value='" . $row["ingredientID"] . "'>Cập nhật</button>
                                <button class='btn btn-danger ml-1' name='btnkhoa'>Khóa</button>
                            </td>
                        </tr>";
                }
            else echo "<tr><td colspan='7' class='text-center pt-2'>Chưa có dữ liệu!</td></tr>";
        }
    }
    
    public function cGetIngredientNotType($type) {
        if ($this->mGetIngredientNotType($type) != 0) {
            $result = $this->mGetIngredientNotType($type);
            
            return $result;
        }
    }
    
    public function cGetIngredientById($ingreID) {
        if ($this->mGetIngredientById($ingreID) != 0) {
            $result = $this->mGetIngredientById($ingreID);
            
            return $result->fetch_assoc();
        }
    }
    
    public function cInsertIngredient($ingreName, $unit, $price, $type)
    {
        if ($this->mInsertIngredient($ingreName, $unit, $price, $type) != 0) {
            echo "<script>alert('Thêm nguyên liệu thành công');</script>";
        } else echo "<script>alert('Thêm nguyên liệu thất bại. Vui lòng nhập lại!');</script>";
    }
    
    public function cUpdateIngredient($ingreName, $unit, $price, $type, $ingreID) {
        if ($this->mUpdateIngredient($ingreName, $unit, $price, $type, $ingreID) != 0) {
            echo "<script>alert('Cập nhật nguyên liệu thành công!')</script>";
        }
    }
}
