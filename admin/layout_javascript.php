<!-- jQuery -->
<script src="./theme_file/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./theme_file/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="./theme_file/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./theme_file/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./theme_file/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./theme_file/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./theme_file/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./theme_file/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./theme_file/plugins/moment/moment.min.js"></script>
<script src="./theme_file/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./theme_file/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./theme_file/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./theme_file/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./theme_file/dist/js/adminlte.js"></script>
<script src="./theme_file/plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert2 -->
<script src="./theme_file/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>



<!-- DataTables  & Plugins -->
<script src="./theme_file/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./theme_file/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./theme_file/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./theme_file/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./theme_file/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./theme_file/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./theme_file/plugins/jszip/jszip.min.js"></script>
<script src="./theme_file/plugins/pdfmake/pdfmake.min.js"></script>
<script src="./theme_file/plugins/pdfmake/vfs_fonts.js"></script>
<script src="./theme_file/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./theme_file/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./theme_file/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>

    $( document ).ready(function() {
        setInterval(function () {getNotifyData()},1000);

    });

    function getNotifyData(){
        var notify = document.getElementById("notify");
        var notify_course = document.getElementById("notify_course");
        var notify_number = document.getElementById("notify_number");
        var notify_info = document.getElementById("notify_info");
        var notify_info_nums = document.getElementById("notify_info_nums");
        var getNotify = "getnewNoti";
        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: {getNotify:getNotify},
            success: function (res) {
                var data = $.parseJSON(res);


                if (data.status == "HaveNewNotification") {

                    notify_course.textContent = "  "+data.CourseNotify + " 新课程请求";
                    notify_info.textContent = "  "+data.info_notify + " 改变信息请求";

                    if (data.TotalNotifyNumber != 0)
                    {
                        notify.textContent = data.TotalNotifyNumber;
                    }else
                    {
                        notify.textContent = "";
                    }


                    if((data.CourseNotify > 0) )
                    {
                        notify_number.textContent = data.CourseNotify;

                    }
                    else
                    {
                        notify_number.textContent ="";
                    }

                    if( data.info_notify > 0)
                    {
                        notify_info_nums.textContent = data.info_notify;
                    }else
                    {
                        notify_info_nums.textContent = "";
                    }

                }




            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })
    }
</script>