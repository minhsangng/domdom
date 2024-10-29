$(document).ready(function () {
  // TRÍ TÂM
  // đổi đơn vị tính
  let rowId = 0;
  $("#ma-" + rowId).val($(`#cateIngredient-${rowId}`).find("option:selected").data("id"));
  $(`#unit-${rowId}`).val($(`#cateIngredient-${rowId}`).val());
  $(document).on("change", `#cateIngredient-${rowId}`, function () {
    var rowId = $(this).attr("data-row-id");
    var ingredientId = $(this).find("option:selected").data("id");
    var selectedValue = $(`#cateIngredient-${rowId}`).val();
    $("#ma-" + rowId).val(ingredientId);
    $(`#unit-${rowId}`).val(selectedValue);
  });

  // thêm hàng cho tablebutton
  $("#addRowBtn").click(function () {
    rowId++;
    var options = $("#ingredientOptions").html();
    var table = $("#tableIngredient");

    var newRow = `
    <tr>
    <td></td>
                                        <td></td>
                                        <td></td>
    <td><span id="error-quantity-${rowId}" class="text-red-500 error-message"></span></td></tr>
             <tr>
                <td> 
                <input name="ingredientIds[]" type="text" id="ma-${rowId}" class="clsNLThem w-20 form-control bg-gray-100" readonly></td>
                    
                    <td>
                <select class="clsIngreName" name="ingredient[]" id="cateIngredient-${rowId}" data-row-id="${rowId}" class="w-full form-control"
                    >
                    ${options}
                </select>
                </td>
                    <td> 
                <input type="text" id="unit-${rowId}" class="clsDVT w-full form-control bg-gray-100" readonly></td>
                    <td>
                <input type="number" class="w-full form-control quantityIngre" id="quantityIngre-${rowId}" name="quantity[]" required></td>
                <td>
                    <a href="javascript:void(0);" class="deleteRowBtn"><i class="fa-solid fa-circle-minus text-danger text-xl text-center w-full"></i></a>
                </td>
                </tr>`;

    table.append(newRow);
    $("#ma-" + rowId).val($(`#cateIngredient-${rowId}`).find("option:selected").data("id"));
    $(`#unit-${rowId}`).val($(`#cateIngredient-${rowId}`).val());
    $(`#cateIngredient-${rowId}`).change(function () {
      var rowId = $(this).attr("data-row-id");
      var ingredientId = $(this).find("option:selected").data("id");
      var selectedValue = $(`#cateIngredient-${rowId}`).val();
      $("#ma-" + rowId).val(ingredientId);
      $(`#unit-${rowId}`).val(selectedValue);
    });

    updateQuantityInputs();

  });

  // đổi đơn vị tính
  let u_rowId = 0;
  $(document).on("change", 'select[name="u-ingredient[]"]', function () {
    var u_rowId = $(this).attr("data-row-id");
    var ingredientId = $(this).find("option:selected").data("id");
    var selectedValue = $(`#u-cateIngredient-${u_rowId}`).val();
    $("#u-ma-" + u_rowId).val(ingredientId);
    $(`#u-unit-${u_rowId}`).val(selectedValue);
    console.log(selectedValue);
    console.log(ingredientId);
  });

  // thêm hàng cho tablebutton
  $("#u-addRowBtn").click(function () {
    u_rowId++;
    var options = $("#u-ingredientOptions").html();
    var table = $("#u-tableIngredient");

    var newRow = `
    <tr>
    <td></td>
                                        <td></td>
                                        <td></td>
    <td><span id="u-error-quantity-${u_rowId}" class="text-red-500 error-message"></span></td></tr>
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
            </tr>`;
    table.append(newRow);

    $(`#u-cateIngredient-${u_rowId}`).change(function () {
      var u_rowId = $(this).attr("data-row-id");
      //  var ingredientId = $(this).find('option:selected').data('id');
      var selectedValue = $(this).val();
      //  $('#u-ma-' + u_rowId).val(ingredientId);
      $(`#u-unit-${u_rowId}`).val(selectedValue);
    });
  });

  // xóa hàng cho tablebutton
  $(document).on("click", ".deleteRowBtn", function () {
    $(this).closest("tr").prev("tr").remove();
    $(this).closest("tr").remove();
    // $(".error-message").each(function (index) {
    //   $(this).attr("id", "error-quantity-" + index);
    // });
    // $(".clsNLThem").each(function (index) {
    //   $(this).attr("id", "cateIngredient-" + index);
    // });
    // $(".clsDVT").each(function (index) {
    //   $(this).attr("id", "unit-" + index);
    // });
    // $(".clsIngreName").each(function (index) {
    //   $(this).attr("id", "cateIngredient-" + index);
    //   $(this).attr("data-row-id", index);

    // });


  });

  // Cập nhật tổng tiền
  function updateTotal() {
    let total = 0;
    const quantities = $(".quantity-input");
    quantities.each(function () {
      const price = parseFloat($(this).data("unit-price"));
      const qty = parseInt($(this).val()) || 0;
      total += price * qty;
    });
    updatedTotal = parseFloat(total);
    $("#tongTienCheck").val(total.toLocaleString("vi-VN") + "đ");
    $("#tongTienCheck").attr("value", total);
  }
  $(".quantity-input").on("change", function () {
    updateTotal();
    console.log($("#tongTienCheck").val());
  });

  // Ngăn nhập số nhỏ hơn 1 khi gõ từ bàn phím
  $(".quantity-input").on("keypress", function (e) {
    const char = String.fromCharCode(e.which);
    if (!/^[1-9]$/.test(char)) {
      e.preventDefault();
    }
  });
  // lưu thông tin theo dõi đơn hàng
  let currentTotal = parseFloat($("#currentTotal").val());
  let updatedTotal;
  if (updatedTotal === undefined) {
    updatedTotal = currentTotal;
  }

  $(".quantity-input").on("input", function () {
    if ($(this).val() < 1) {
      $(this).val(1);
    }
  });

  $("#btnLuuThongTin").on("click", function () {
    if (updatedTotal > currentTotal) {
      $(".thanhtoanthem").html(
        `Bạn cần thanh toán thêm ${(updatedTotal - currentTotal).toLocaleString(
          "vi-VN"
        )}đ`
      );
      if ($("#statusOrder0").val() == 0) {
        $("#followDetailModal").modal("hide");
        $("#checkoutModal1").modal("show");
        $("#btnThanhToan1").on("click", function () {
          $("#infoOrder").submit();
        });
      } else if ($("#statusOrder1").val() == 1) {
        $("#infoOrder").submit();
        $("#followDetailModal").modal("show");
      }
    } else if (updatedTotal < currentTotal) {
      if ($("#statusOrder0").val() == 0) {
        setTimeout(function () {
          $("#infoOrder").submit();
        }, 3000);
        alert(
          `Chúng tôi sẽ hoàn trả số tiền dư ${Math.abs(
            updatedTotal - currentTotal
          ).toLocaleString("vi-VN")}đ vào tài khoản của bạn trong vòng 24 giờ.`
        );
      } else if ($("#statusOrder1").val() == 1) {
        $("#infoOrder").submit();
        $("#followDetailModal").modal("show");
      }
    } else {
      $("#infoOrder").submit();
    }
  });

  // Nhập nguyên liệu khô
  $(".btnNhapNLKho").on("click", function () {
    console.log("1");
    var row = $(this).closest("tr");
    row.find('input[type="number"]:first').attr("name", "Ingre[]");
    row.find('input[type="number"]:last').attr("name", "TotalQuantity[]");
    $(this).css("background-color", "green");
    $(this).html("✔");
    $(this).removeClass("btn-danger").addClass("btn-success");
  });

  // REGEX
  // regex UC chuyen nguyen lieu tu cua hang thua sang cua hang thieu
  function ktStore() {
    let storeThua = $("#txtStoreThua").val()
    let storeThieu = $("#txtStoreThieu").val()
    if (storeThua === "") {
      $("#errStore").html("Cửa hàng không được rỗng")
      return false
    } else if (storeThieu === "") {
      $("#errStore").html("Cửa hàng không được rỗng")
      return false
    } else if (storeThieu === storeThua) {
      $("#errStore").html("Cửa hàng thiếu phải khác cửa hàng thừa")
      return false
    } else {
      $("#errStore").html("*")
      return true
    }
  }

  function ktQuantityInStock() {
    let quantityInStock = $("#txtQuantityInStock").val()
    let quantityThua = $("#txtStoreThua").find(":selected").data("quantity")
    if (quantityInStock === "") {
      $("#errQuantityInStock").html("Số lượng không được rỗng")
      return false
    } else if (Number(quantityInStock) > quantityThua) {
      $("#errQuantityInStock").html("Số lượng chuyển không được lớn hơn số lượng tồn cửa hàng thừa")
      return false
    } else if (Number(quantityInStock) < 1) {
      $("#errQuantityInStock").html("Số lượng chuyển không được nhỏ hơn 1")
      return false
    } else {
      $("#errQuantityInStock").html("*")
      return true
    }
  }

  $("#txtStoreThua").blur(function () {
    ktStore()
  })

  $("#txtStoreThieu").blur(function () {
    ktStore()
  })

  $("#txtQuantityInStock").blur(function () {
    ktQuantityInStock()
  })

  $("#form-SLT").on("submit", function (event) {
    let isValid = false;
    if (ktStore() && ktQuantityInStock()) {
      isValid = true;
    }
    if (!isValid) {
      event.preventDefault();
      alert("Thông tin không hợp lệ")
    }
  });

  // regex UC Thêm nguyên liệu
  function ktDishName() {
    let dishName = $("#iDishName").val()
    if (dishName.length === 0) {
      $("#ierrDishName").html("Tên món ăn không được rỗng")
      return false
    } else {
      $("#ierrDishName").html("*")
      return true
    }
  }

  function ktDishPrice() {
    let dishPrice = $("#iDishPrice").val()
    if (dishPrice === "") {
      $("#ierrDishPrice").html("Giá bán không được rỗng")
      return false
    } else if (Number(dishPrice) < 0) {
      $("#ierrDishPrice").html("Giá bán không được nhỏ hơn 0")
      return false
    } else {
      $("#ierrDishPrice").html("*")
      return true
    }
  }

  function ktQuantity(index) {
    let quantity = $("#quantityIngre-"+ index).val();
    let errorElement = $("#error-quantity-" + index);
    if (quantity === "") {
      errorElement.html("Số lượng không được rỗng" + index);
      return false;
    } else if (Number(quantity) < 0) {
      errorElement.html("Số lượng phải lớn hơn 0");
      return false;
    } else {
      errorElement.html("");
      return true;
    }
  }

  function ktDishDescription() {
    let dishName = $("#iDishDescription").val()
    if (dishName.length === 0) {
      $("#ierrDishDescription").html("Mô tả không được rỗng")
      return false
    } else {
      $("#ierrDishDescription").html("*")
      return true
    }
  }

  function ktDishProcess() {
    let dishName = $("#iDishProcess").val()
    if (dishName.length === 0) {
      $("#ierrDishProcess").html("Mô tả không được rỗng")
      return false
    } else {
      $("#ierrDishProcess").html("*")
      return true
    }
  }

  $("#iDishName").blur(function () {
    ktDishName()
  })

  $("#iDishDescription").blur(function () {
    ktDishDescription()
  })

  $("#iDishProcess").blur(function () {
    ktDishProcess()
  })

  $("#iDishPrice").blur(function () {
    ktDishPrice()
  })

  function updateQuantityInputs() {
    for (let i = 0; i <= rowId; i++) {
      $("#quantityIngre-"+ i).blur(function () {
        ktQuantity(i);
      });
    }
  }
  updateQuantityInputs();

  $("#form-themmonan").on("submit", function (event) {
    let isValid = false;
    if (ktDishName() && ktDishDescription() && ktDishProcess() && ktDishPrice() ) {
      isValid = true;
    }
    for (let i = 0; i <= rowId; i++) {
        if(ktQuantity(i))
          isValid = true;
      }
    if (!isValid) {
      event.preventDefault();
      alert("Thông tin không hợp lệ")
    }
  });


});
