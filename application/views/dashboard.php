<?php require_once 'inc/header.php'; ?>
<title>Dashboard</title>
</head>
<body class="page-boxed page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo">
<div class="page-header navbar navbar-fixed-top">
    <?php require_once 'inc/nav.php'; ?>
    <div class="clearfix">
    </div>
    <div class="container-flud">
        <div class="page-container">
            <?php require_once 'inc/sidebar.php'; ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <h3 class="page-title">Dashboard</h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        14 / 20
                                    </div>
                                    <div class="desc">
                                        Total Rent Collection
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light red-soft" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-trophy"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $activeMembers;?> / 25
                                    </div>
                                    <div class="desc">
                                        Total Active Members
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light green-soft" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $activeMess;?> / 15
                                    </div>
                                    <div class="desc">
                                        Total Active Mess
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light purple-soft" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        29 / 30
                                    </div>
                                    <div class="desc">
                                        Total Mess Collections
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>
</body>
</html>