<?php
class cMessage
{
  public function successMessage($text)
  {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
              let text = " . json_encode($text) . ";
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: 'success',
                    title: text + ' thành công'
                  });
                });
        </script>";
  }

  public function errorMessage($text)
  {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
              let text = " . json_encode($text) . ";
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: 'warning',
                    title: text + ' thất bại'
                  });
                });
        </script>";
  }
}
