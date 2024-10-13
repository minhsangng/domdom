<div class="grid grid-cols-1 h-fit md:grid-cols-1 gap-6 mt-8">
<div class="bg-white p-6 rounded-lg shadow-lg mb-6">
    <div class="flex justify-center items-center mb-4">
        <h2 class="text-xl font-semibold">
            Đề xuất ý kiến
        </h2>
    </div>
    <div class="h-fit bg-gray-100 rounded-lg px-44 py-6">
        <?php
        $id = $_POST["id"];
        $type = $_POST["proposal"];
        $content = $_POST["content"];
        
        if (isset($_POST["btnpp"])) {
            $sql = "INSERT INTO proposals (userID, typeOfProposal, content) VALUES ($id, '$type', '$content')";
            $result = $conn->query($sql);
            
            echo "<script>alert('Đã gửi đề xuất thành công.');</script>";
        }
        ?>
        <form action="" method="POST">
            <table class="w-full">
                <tbody>
                    <tr>
                        <td  class="mb-4"><label for="" class="form-label font-bold">Mã nhân viên:</label></td>
                        <td><input type="text" name="id" id="" class="form-control mb-2"></td>
                    </tr>
                    <tr>
                        <td><label for="" class="form-label font-bold">Loại đề xuất</label></td>
                        <td>
                            <select name="proposal" id="" class="form-select mb-2">
                                <option value="Đề xuất món ăn">Đề xuất món ăn</option>
                                <option value="Đề xuất khác">Đề xuất khác</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="" class="form-label font-bold">Nội dung đề xuất</label></td>
                        <td><textarea name="content" id="" rows="5" class="form-control mb-2"></textarea></td>
                    </tr>
                    <tr class="border-t-2">
                        <td colspan="2" class="text-center"><button type="submit" name="btnpp" class="btn btn-primary px-4 py-1 rounded-lg mt-2 text-lg">Gửi đề xuất</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
</div>