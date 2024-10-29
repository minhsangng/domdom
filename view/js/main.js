
$(document).ready(function () {
    // TRÍ TÂM
    // đổi đơn vị tính 
    let rowId = 0;
    $(document).on('change', 'select[name="ingredient[]"]', function () {
        var rowId = $(this).attr('data-row-id');
        var ingredientId = $(this).find('option:selected').data('id');
        var selectedValue = $(`#cateIngredient-${rowId}`).val();
        $('#ma-' + rowId).val(ingredientId);
        $(`#unit-${rowId}`).val(selectedValue);

    });

    // thêm hàng cho tablebutton
    $('#addRowBtn').click(function () {
        rowId++;
        var options = $('#ingredientOptions').html();
        var table = $('#tableIngredient');

        var newRow = `
             <tr>
                                    <td> 
                                    <input name="ingredientIds[]" type="text" id="ma-${rowId}" class="w-20 form-control bg-gray-100" readonly></td>
                                        
                                        <td>
                                    <select name="ingredient[]" id="cateIngredient-${rowId}" data-row-id="${rowId}" class="w-full form-control"
                                        >
                                        ${options}
                                    </select>
                                    </td>
                                        <td> 
                                    <input type="text" id="unit-${rowId}" class="w-full form-control bg-gray-100" readonly></td>
                                        <td>
                                    <input type="number" class="w-full form-control" name="quantity[]" required></td>
                                    <td>
                                        <a href="javascript:void(0);" class="deleteRowBtn"><i class="fa-solid fa-circle-minus text-danger text-xl text-center w-full"></i></a>
                                    </td>
                                    </tr>

                                
        `;
        table.append(newRow);

        $(`#cateIngredient-${rowId}`).change(function () {
            var rowId = $(this).attr('data-row-id');
            var selectedValue = $(this).val();
            $(`#unit-${rowId}`).val(selectedValue);
        });
    });

    // đổi đơn vị tính 
    let u_rowId = 0;
    $(document).on('change', 'select[name="u-ingredient[]"]', function () {
        var u_rowId = $(this).attr('data-row-id');
        var ingredientId = $(this).find('option:selected').data('id');
        var selectedValue = $(`#u-cateIngredient-${u_rowId}`).val();
        $('#u-ma-' + u_rowId).val(ingredientId);
        $(`#u-unit-${u_rowId}`).val(selectedValue);
        console.log(selectedValue);
        console.log(ingredientId);

    });

    // thêm hàng cho tablebutton
    $('#u-addRowBtn').click(function () {
        u_rowId++;
        var options = $('#u-ingredientOptions').html();
        var table = $('#u-tableIngredient');

        var newRow = `
              <tr>
                                     <td> 
                                     <input name="u-ingredientIds[]" type="text" id="u-ma-${u_rowId}" class="w-20 form-control bg-gray-100" readonly></td>
                                         
                                         <td>
                                     <select name="u-ingredient[]" id="u-cateIngredient-${u_rowId}" data-row-id="${u_rowId}" class="w-full form-control"
                                         >
                                         ${options}
                                     </select>
                                     </td>
                                         <td> 
                                     <input type="text" id="u-unit-${u_rowId}" class="w-full form-control bg-gray-100" readonly></td>
                                         <td>
                                     <input type="number" class="w-full form-control" name="u-quantity[]" required></td>
                                     <td>
                                         <a href="javascript:void(0);" class="deleteRowBtn"><i class="fa-solid fa-circle-minus text-danger text-xl text-center w-full"></i></a>
                                     </td>
                                     </tr>
 
                                 
         `;
        table.append(newRow);

        $(`#u-cateIngredient-${u_rowId}`).change(function () {
            var u_rowId = $(this).attr('data-row-id');
            //  var ingredientId = $(this).find('option:selected').data('id');
            var selectedValue = $(this).val();
            //  $('#u-ma-' + u_rowId).val(ingredientId);
            $(`#u-unit-${u_rowId}`).val(selectedValue);
        });
    });

    // xóa hàng cho tablebutton
    $(document).on('click', '.deleteRowBtn', function () {
        $(this).closest('tr').remove();
    });


    // Cập nhật tổng tiền
    function updateTotal() {
        let total = 0;
        const quantities = $(".quantity-input");
        quantities.each(function () {
            const price = parseFloat($(this).data('unit-price'));
            const qty = parseInt($(this).val()) || 0;
            total += price * qty;
        });
        updatedTotal = parseFloat(total);
        $("#tongTienCheck").val(total.toLocaleString('vi-VN') + 'đ');
        $("#tongTienCheck").attr("value", total);
    }
    $(".quantity-input").on("change", function () {
        updateTotal();
        console.log( $("#tongTienCheck").val())

    });

    // Ngăn nhập số nhỏ hơn 1 khi gõ từ bàn phím
    $('.quantity-input').on('keypress', function (e) {
        const char = String.fromCharCode(e.which);
        if (!/^[1-9]$/.test(char)) {
            e.preventDefault();
        }
    });
    // lưu thông tin theo dõi đơn hàng
    let currentTotal = parseFloat($('#currentTotal').val());
    let updatedTotal;
    if (updatedTotal === undefined) {
        updatedTotal = currentTotal;
    }

    $('.quantity-input').on('input', function () {
        if ($(this).val() < 1) {
            $(this).val(1);
        }

    });



    $("#btnLuuThongTin").on('click', function () {
        console.log(updatedTotal, currentTotal)
        if (updatedTotal > currentTotal) {
            $(".thanhtoanthem").html(`Bạn cần thanh toán thêm ${(updatedTotal - currentTotal).toLocaleString('vi-VN')}đ`)
            if($("#statusOrder0").val() == 0) {
                $('#followDetailModal').modal("hide");
                $('#checkoutModal1').modal('show');
                $("#btnThanhToan1").on('click', function () {
                    $("#infoOrder").submit();
                })
            }else if($("#statusOrder1").val() == 1) {
                $("#infoOrder").submit();
                $('#followDetailModal').modal("show");
            }

        } else if (updatedTotal < currentTotal) {
            if($("#statusOrder0").val() == 0) {
                setTimeout(function () {
                    $("#infoOrder").submit();
                }, 3000);
                alert(`Chúng tôi sẽ hoàn trả số tiền dư ${Math.abs(updatedTotal - currentTotal).toLocaleString('vi-VN')}đ vào tài khoản của bạn trong vòng 24 giờ.`);
            }else if($("#statusOrder1").val() == 1) {
                $("#infoOrder").submit();
                $('#followDetailModal').modal("show");
            }

        }else {
            $("#infoOrder").submit();
        }
       
    });

})