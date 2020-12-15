<?php
    // From URL to get webpage contents.
    include_once 'common.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>

<body class="background show-spinner no-footer">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-8 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class=" text-white h2">Every day’s to-do list.</p>

                            <p class="white mb-0">
                                Please use your credentials to login.
                                <br>If you are not a member, please
                                <a href="register.html" class="white">register</a>.
                            </p>
                        </div>
                        <div class="form-side">
                            <a href="index.php">
                                <span class="logo-single"></span>
                            </a>
                            <h6 class="mb-4">Login</h6>
                            <div class="error-holder alert alert-danger alert-dismissible" role="alert">
                                <span class="error-msg"></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="login-form">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="usermail" />
                                    <span>E-mail</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="" name="password" />
                                    <span>Password</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        $.ajax({
            url: "<?php echo $login_check_api; ?>",
            success: function(result){
                if( ! result['error']){
                    window.location.href = "<?php echo $to_do_page; ?>";
                }
            }
        });
        $(document).ready(function(){
            $(".error-holder").hide()
            $("#login-form").on('submit',function(event){
                $(".error-holder").hide();
                event.preventDefault();
                var form_data = $("#login-form").serialize();
                $.ajax({
                    url: "<?php echo $login_link_api; ?>",
                    data: form_data,
                    success: function(result){
                        if(result['error']){
                            $(".error-holder").show();
                            $(".error-msg").html(result['error_msg']);
                        }else{
                            window.location.href = "<?php echo $to_do_page; ?>";
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
