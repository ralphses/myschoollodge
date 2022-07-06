<?php 
    use src\utils\Application;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="<?php echo Application::$application->createToken()?>">

    <title>MySchoollodge - User Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/user/assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/user/assets/vendors/simple-datatables/style.css">


    <link rel="stylesheet" href="assets/user/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/user/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/user/assets/css/app.css">
    <link rel="stylesheet" href="assets/user/assets/css/custom.css">


    <link rel="shortcut icon" href="assets/user/assets/images/favicon.svg" type="image/x-icon">

    <style>
        input, textarea {
            height: 55px;
            border-color: black;
            height: 55px ;
        }

        select, .form-control {
            height: 55px !important;
        }
    </style>

</head>

<body>
    
    <div id="app">
        <div id="sidebar" class="active">
            
            <div class="sidebar-wrapper active">
            
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        
                        <div class="logo agent-profile">
                            <a href="/user"><img src="assets/user/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item  ">
                            <a href="/" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Home</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="/user" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/customer-requests" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>View Requests</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/user-add-lodge" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Post a lodge</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/view-lodges" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>View Lodges</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/logout" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
        <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{content}}

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="assets/user/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/user/assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/user/assets/js/extensions/sweetalert2.js"></script>
    <script src="assets/js/custom.js"></script>

    <script src="assets/user/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    

    <script src="assets/user/assets/js/main.js"></script>
    <script src="assets/user/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        if(table1) {
            let dataTable = new simpleDatatables.DataTable(table1);
        }
    </script>

</body>

</html>

<script>
  document.getElementById('newsletter').style.display = 'none';
</script>