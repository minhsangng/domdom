<div class="modal modal-lg modalUpdate fade" id="u-updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" class="form-container w-full" enctype="multipart/form-data">
                    <div class="modal-header justify-center">
                        <h2 class="modal-title fs-5 font-bold text-3xl" id="u-updateModalLabel" style="color: #E67E22;">
                            Sửa món ăn</h2>
                    </div>
                    <div class="modal-body">
                        <table class="w-full">
                            <tr id="u-hiddenIngre"></tr>
                            <tr>
                                <td>
                                    <label for="name" class="w-full py-2"><b>Tên món ăn <span
                                                class="text-red-500">*</span></b></label>
                                    <input type="text" class="w-full form-control" name="name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cate" class="w-full py-2"><b>Loại món ăn <span
                                                class="text-red-500">*</span></b></label>
                                    <select name="cate" id="u-cateDish" class="w-full form-control">
                                        <?php
                                        if ($ctrl->cGetAllDish() != 0) {
                                            $result = $ctrl->cGetAllCategory();

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["dishCategory"] . "'>" . $row["dishCategory"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price" class="w-full py-2"><b>Giá bán <span
                                                class="text-red-500">*</span></b></label>
                                    <input type="number" class="w-full form-control" name="price" required>
                                </td>
                            </tr>
                            <tr>
                                <table id="u-tableIngredient" class="w-full  text-center">
                                    <tr class="mb-2">
                                        <td> <label for="name" class="w-full py-2"><b>Mã NL</b></label></td>
                                        <td> <label for="name" class="w-full py-2"><b>Tên nguyên liệu <span
                                        class="text-red-500">*</span></b></label></td>
                                        <td> <label for="name" class="w-full py-2"><b>Đơn vị tính</b></label></td>
                                        <td> <label for="name" class="w-full py-2"><b>Số lượng <span
                                        class="text-red-500">*</span></b></label></td>
                                        <td> <label for="name" class="w-full py-2"><b>Hành động</b></label></td>

                                    </tr>
                                    <tr>
                                    <td> 
                                    <input name="ingredientIds[]" type="text" id="u-ma-0" class="w-20 form-control bg-gray-100" readonly></td>
                                        <td>
                                    <select name="ingredient[]" id="u-cateIngredient-0" data-row-id="u-0" class="w-full form-control"
                                        >
                                        <?php
                                        $ctrl = new cIngredients;

                                        if ($ctrl->cGetAllIngredient() != 0) {
                                            $result = $ctrl->cGetAllIngredient();

                                            while ($row = $result->fetch_assoc()) {
                    
                                                echo "<option value='".$row["unitOfcalculaton"]."' data-id='".$row["ingredientID"]."'>".$row["ingredientName"]."</option>";
                                           

                                            }
                                        }
                                        ?>
                                    </select>
                                    </td>
                                    <div id="u-ingredientOptions" style="display: none;">
                                    <?php
                                        $ctrl = new cIngredients;

                                        if ($ctrl->cGetAllIngredient() != 0) {
                                            $result = $ctrl->cGetAllIngredient();

                                            while ($row = $result->fetch_assoc()) {
                    
                                                echo "<option value='".$row["unitOfcalculaton"]."' data-id='".$row["ingredientID"]."'>".$row["ingredientName"]."</option>";
                                           

                                            }
                                        }
                                        ?>
                                    </div>
                                        <td> 
                                    <input type="text" id="u-unit-0" class="w-full form-control bg-gray-100" readonly></td>
                                        <td>
                                    <input type="number" class="w-full form-control" name="quantity[]" required></td>
                                    <td>
                                        <a href="javascript:void(0);" class="deleteRowBtn"><i class="fa-solid fa-circle-minus text-danger text-xl text-center w-full"></i></a>
                                    </td>
                                    </tr>

                                    
                                </table>
                                <a href="javascript:void(0);" id="u-addRowBtn" class="btn btn-secondary mt-2">Thêm Hàng<i class="fa-solid fa-plus"></i></a>
                            </tr>

                            <tr>
                                <td>
                                    <label for="description" class="w-full py-2"><b>Mô tả <span
                                                class="text-red-500">*</span></b></label>
                                    <textarea class="w-full form-control" name="description" rows="4" cols="50" placeholder="Nhập quy mô tả..." required></textarea>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="prepare" class="w-full py-2"><b>Quy trình chế biến <span
                                                class="text-red-500">*</span></b></label>
                                    <textarea class="w-full form-control" name="prepare" rows="4" cols="50" placeholder="Nhập quy trình chế biến..." required></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image" class="w-full py-2"><b>Hình ảnh <span
                                                class="text-red-500">*</span></b></label>
                                    <input type="file" class="w-full form-control" name="image">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="if (confirm('Thông tin chưa được lưu. Bạn có chắc chắn thoát?') === false) { var modalupdate = new bootstrap.Modal(document.querySelector('.modalupdate')); modalupdate.show();}">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="btnsuamon">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>