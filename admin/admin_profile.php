<?php
$admin_drop_menu = "menu-open";
$admin_menu = "active";
$admin_profile_menu = "active";
$breadcrumb_name = "Admin Profile";
@include "layout_header.php";

include "../database.php";
$id = $_SESSION['userid'];
$profile = "select * from admin_user where id = $id";
$profile_query = mysqli_query($con, $profile);

$profile_result = mysqli_fetch_assoc($profile_query);

?>

<div class="card card-primary card-outline col-md-6">
    <div class="card-body box-profile">
        <form class="form-horizontal">
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control text-center" disabled id="inputName"
                        value="<?php echo $profile_result['name']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control text-center" disabled id="inputEmail"
                        value="<?php echo $profile_result['email']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName2" class="col-sm-3 col-form-label">Account ID</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control text-center" disabled id="inputName2"
                        value="<?php echo $profile_result['idNumber']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class=" col-sm-10">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="Update_from" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control " id="inputName"
                                value="<?php echo $profile_result['name']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control " id="inputEmail"
                                value="<?php echo $profile_result['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-4 col-form-label">Account ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="idNumber" class="form-control " id="inputName2"
                                value="<?php echo $profile_result['idNumber']; ?>">
                            <input type="hidden" class="form-control " id="inputName2" name="id"
                                value="<?php echo $profile_result['id']; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- /.row (main row) -->


<?php
@include "layout_footer.php";
@include "layout_javascript.php";
    ?>

<script>

    $("#Update_from").submit((e) => {
        e.preventDefault();

        var form = $("#Update_from").serialize();
        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: form,
            success: function (res) {

                if (res == 'Error') {
                    toastr["error"]("Having Probleam")

                }
                if (res == 'Success') {
                    toastr["success"]("Updated");
                    setTimeout(function () {
                        window.location = 'admin_profile.php';
                    }, 2000);
                }



            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })
    })

</script>

</body>

</html>