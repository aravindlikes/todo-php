<?php
    // From URL to get webpage contents.
    include_once 'common.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dore jQuery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="css/vendor/jquery.contextMenu.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="css/vendor/select2.min.css" />
    <link rel="stylesheet" href="css/vendor/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/component-custom-switch.min.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>

<body id="app-container" class="menu-sub-hidden show-spinner right-menu">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a class="navbar-logo" href="Dashboard.Default.html">
                <span class="logo d-none d-xs-block"></span>
                <span class="logo-mobile d-block d-xs-none"></span>
            </a>
        </div>
        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                        data-toggle="tooltip" data-placement="left" title="Dark Mode">
                        <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>
            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span>
                        <img alt="Profile Picture" src="https://ui-avatars.com/api/?name=John&length=1" id="profile_pic" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item sign-out" href="#">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li class="active">
                        <a href="todo-list.html">
                            <i class="simple-icon-check"></i> To-Do List
                        </a>
                    </li>
                    <li>
                        <a href="https://dore-jquery-docs.coloredstrategies.com" target="_blank">
                            <i class="iconsminds-library"></i> Docs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <main>
        <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>Todo</h1>
                        <div class="top-right-button-container">
                            <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1"
                                data-toggle="modal" data-backdrop="static" data-target="#exampleModal">ADD NEW</button>
                            <div class="modal fade modal-right" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="error-holder alert alert-danger alert-dismissible" role="alert">
                                                <span class="error-msg"></span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="new_todo_data">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" placeholder="" name="todo_title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Details</label>
                                                    <textarea class="form-control" rows="2" name="todo_desc"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Due Date</label>
                                                    <div class="input-group date">
                                                        <input type="date" class="form-control" name="due_date">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1" name="todo_status">
                                                        <label class="custom-control-label"
                                                            for="customCheck1">Completed</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary add-todo">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator mb-5"></div>
                    <div class="overdue-todo-list">
                        <div class="list disable-text-selection" data-check-all="checkAll">
                            <div class="card d-flex flex-row mb-3">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                        <p class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0">
                                            <i class="simple-icon-refresh heading-icon"></i>
                                            <span class="align-middle d-inline-block">Book train tickets</span>
                                        </p>
                                        <p class="mb-0 text-muted text-small w-15 w-xs-100">Personal</p>
                                        <p class="mb-0 text-muted text-small w-15 w-xs-100">11.08.2018</p>
                                        <div class="w-15 w-xs-100">
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>
                                        </div>
                                    </div>
                                    <label class="custom-control custom-checkbox mb-0 align-self-center mr-4 mb-1">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-menu">
            <div class="p-4 h-100">
                <div class="scroll">
                    <p class="text-muted text-small">Status</p>
                    <ul class="list-unstyled mb-5">
                        <li class="active">
                            <a href="#">
                                <i class="simple-icon-refresh"></i>
                                Pending Tasks
                                <span class="float-right">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="simple-icon-check"></i>
                                Completed Tasks
                                <span class="float-right">24</span>
                            </a>
                        </li>
                    </ul>

                    <p class="text-muted text-small">Categories</p>
                    <ul class="list-unstyled mb-5">
                        <li>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="category1">
                                <label class="custom-control-label" for="category1">Flexbox</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="category2">
                                <label class="custom-control-label" for="category2">Sass</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" id="category3">
                                <label class="custom-control-label" for="category3">React</label>
                            </div>
                        </li>
                    </ul>




                    <p class="text-muted text-small">Labels</p>
                    <div>
                        <p class="d-sm-inline-block mb-1">
                            <a href="#">
                                <span class="badge badge-pill badge-outline-primary mb-1">NEW FRAMEWORK</span>
                            </a>
                        </p>

                        <p class="d-sm-inline-block mb-1">
                            <a href="#">
                                <span class="badge badge-pill badge-outline-theme-3 mb-1">EDUCATION</span>
                            </a>
                        </p>
                        <p class="d-sm-inline-block  mb-1">
                            <a href="#">
                                <span class="badge badge-pill badge-outline-secondary mb-1">PERSONAL</span>
                            </a>
                        </p>
                    </div>

                </div>
            </div>
            <a class="app-menu-button d-inline-block d-xl-none" href="#">
                <i class="simple-icon-options"></i>
            </a>
        </div>
    </main>

    <footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                    </div>
                    <div class="col-sm-6 d-none d-sm-block">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/vendor/perfect-scrollbar.min.js"></script>
    <script src="js/vendor/select2.full.js"></script>
    <script src="js/vendor/mousetrap.min.js"></script>
    <script src="js/vendor/jquery.contextMenu.min.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        function enable_complete_check(){
            $(".complete-check").on("click",function(){
                // var clicked_item = $(this);
                // setTimeout(function(clicked_item){
                //     var completed_check = false;
                //     try {
                //         if($(clicked_item).val()==="on"){
                //             completed_check = true;
                //         }
                //     }
                //     catch(err) {
                //         completed_check = false;
                //     }
                // },0,clicked_item);
                $(this).parentsUntil("todo-holder");
            });
        }
        $(".error-holder").hide();
        $.ajax({
            url: "<?php echo $login_check_api; ?>",
            success: function(result){
                if( result['error']){

                    window.location.href = "<?php echo $login_page; ?>";
                }else{
                    var username=result['username'];
                    var ui_avatar_link = "https://ui-avatars.com/api/?length=1&name="+username;
                    $("#profile_pic").attr("src", ui_avatar_link);
                }
            }
        });
        $.ajax({
            url: "<?php echo $get_all_todo_api; ?>",
            success: function(result){
                if(result.length){
                    var todo_list_content="";
                    for (var i = 0; i < result.length; i++) {
                        todo_list_content = todo_list_content+'<div class="list disable-text-selection" data-check-all="checkAll"><div class="todo-holder card d-flex flex-row mb-3"><div class="d-flex flex-grow-1 min-width-zero"><div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center"><p class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0"><i class="simple-icon-refresh heading-icon"></i><span class="align-middle d-inline-block">'+result[i].todo_name+'</span></p><p class="mb-0 text-muted text-small w-15 w-xs-100">'+result[i].todo_desc+'</p><p class="mb-0 text-muted text-small w-15 w-xs-100">'+result[i].due_date+'</p><div class="w-15 w-xs-100"><span class="badge badge-pill badge-danger ">Over Due</span></div></div><label class="custom-control custom-checkbox mb-0 align-self-center mr-4 mb-1"><input type="checkbox" class="custom-control-input complete-check" data-todo-id="'+result[i].todo_id+'"><span class="custom-control-label">&nbsp;</span></label></div></div></div>';
                    }
                    $(".overdue-todo-list").html(todo_list_content);
                    enable_complete_check();
                }else{
                }
            }
        });
        $(".sign-out").on("click",function(){
            $.ajax({
                url: "<?php echo $logout_link_api; ?>",
                success: function(result){
                    if( ! result['error']){
                        window.location.href = "<?php echo $login_page; ?>";
                    }
                }
            });
        });
        $(".add-todo").on("click", function(){
            var form_data = $("#new_todo_data").serialize();
            $.ajax({
                url: "<?php echo $add_todo_api; ?>",
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
    </script>
</body>

</html>
