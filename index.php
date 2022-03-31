<?php
$con = mysqli_connect("localhost", "root", "", "check-username");
$sql = "SELECT * FROM emp_details";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Check username availability using ajax php mysqli</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 center">
                <form action="" method="post">
                    <label for="username"><b>User Name</b></label>
                    <input type="text" name="username" placeholder="Username" id="username" required />
                    <p id="availability"></p>
                    <button type="submit" name="register" class="btn registerbtn shadow-none" id="register" disabled>Register</button>
                    <p id="msg"></p>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<script>
    $("#register").click(function(e) {
        e.preventDefault();
        var username = document.getElementById("username").value;
        if (username == "") {
            $("#msg").html("Please Enter Username");
            $("#msg").show();
            $("#msg").focus();
            $("#msg").delay(4000).fadeOut("slow");
            return false;
        }
    });

    $(document).ready(function() {
        $('#username').keyup(function() {
            var username = $(this).val();
            if (username == "") {
                $('#availability').html('');
            } else {
                $.ajax({
                    url: 'check_user.php',
                    method: "POST",
                    data: {
                        user_name: username
                    },
                    success: function(data) {
                        if (data != '0') {
                            $('#availability').html('<span class="text-danger">Username not available</span>');
                            $('#register').attr("disabled", true);
                        } else {
                            $('#availability').html('<span class="text-success">Username Available</span>');
                            $('#register').attr("disabled", false);
                        }
                    }
                })
            }
        });

    });
</script>