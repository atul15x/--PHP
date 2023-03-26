<?php
session_start();

include "database.php";

if ( isset( $_POST['lbtn'] ) ) {

    $lid = $_POST['lid'];

    $password = $_POST['lpassword'];

    $status = $_POST['status'];

    if ( $status == 'admin' )

    {
        $checkmail = "select * from admin_user where idNumber='$lid' ";

        $cheackmailquery = mysqli_query( $con, $checkmail );

        $result = mysqli_num_rows( $cheackmailquery );

        if ( $result ) {

            $bdarry = mysqli_fetch_assoc( $cheackmailquery );
            $bdpass = $bdarry['password'];
            //                       	$pass_decode = password_verify( $password, $bdpass );

            if ( $bdpass == $password ) {
                $_SESSION['userid'] = $bdarry['id'];
                $_SESSION['username'] = $bdarry['name'];
                $_SESSION['useremail'] = $bdarry['email'];
                $_SESSION['useridNumber'] = $bdarry['idNumber'];

                ?>
                <script type = "text/javascript">alert( "Login Successful" )</script>
                <?php
                header( "refresh:1;url=admin/admin_dashboard.php" );
            } else {
                ?>
                <script type = "text/javascript">alert( "Password is Worng" )</script>
                <?php
                header( "refresh:1;url=index.php" );
            }
        } else {
            ?>
            <script type = "text/javascript">alert( "Email is invalid" )</script>
            <?php
        }

    }

}

?>