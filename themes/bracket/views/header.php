<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket Plus">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracketplus">
    <meta property="og:title" content="Bracket Plus">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>
        <?= isset($template['title']) ? $template['title'] : ''; ?>
        <?= isset($idt->nm_perusahaan) ? ' | ' . $idt->nm_perusahaan : 'not-set'; ?>
    </title>

    <!-- vendor css -->
    <link href="<?= base_url(); ?>themes/bracket/assets/lib/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">
    <link href="<?= base_url(); ?>themes/bracket/assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>themes/bracket/assets/lib/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">
    <link href="<?= base_url(); ?>themes/bracket/assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>themes/bracket/assets/lib/highlightjs/styles/github.css" rel="stylesheet">
    <link href="<?= base_url(); ?>themes/bracket/assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>themes/bracket/assets/lib/datatables.net-dt/css/jquery.dataTables.min.css"
        rel="stylesheet">
    <link
        href="<?= base_url(); ?>themes/bracket/assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css"
        rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>themes/bracket/assets/css/bracket.css">
    <link rel="stylesheet" href="<?= base_url(); ?>themes/bracket/assets/css/bracket.oreo.css">
    <script src="<?= base_url(); ?>themes/bracket/assets/lib/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    var baseurl = "<?= base_url(); ?>";
    var siteurl = "<?= site_url(); ?>";
    var base_url = "<?= site_url(); ?>";
    var thisController = '<?= $this->uri->segment(1); ?>' + '/';
    var thisFunction = '<?= $this->uri->segment(2); ?>' + '/';
    </script>
</head>

<body>
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href=""><span>[</span>CRJ <i>App</i><span>]</span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
        <label class="sidebar-label pd-x-10 mg-t-20">Navigation</label>
        <?= $this->menu_generator->build_menus(); ?>
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->


    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
        <div class="br-header-left">
            <div class="navicon-left hidden-md-down border-0"><a id="btnLeftMenu" href=""><i
                        class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i
                        class="icon ion-navicon-round"></i></a></div>
            <div class="input-group hidden-xs-down wd-170 transition border-0">
                <h4 class="text-white mb-0"><?= isset($template['title']) ? $template['title'] : ''; ?></h4>
            </div><!-- input-group -->
        </div><!-- br-header-left -->
        <div class="br-header-right">
            <nav class="nav">
                <div class="dropdown">
                    <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                        <i class="icon ion-ios-email-outline tx-24"></i>
                        <!-- start: if statement -->
                        <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
                        <!-- end: if statement -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-header">
                        <div class="dropdown-menu-label">
                            <label>Messages</label>
                            <a href="">+ Add New Message</a>
                        </div><!-- d-flex -->

                        <div class="media-list">
                            <!-- loop starts here -->
                            <a href="" class="media-list-link">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <div>
                                            <p>Donna Seay</p>
                                            <span>2 minutes ago</span>
                                        </div><!-- d-flex -->
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet
                                            mornings of spring.</p>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <!-- loop ends here -->
                            <a href="" class="media-list-link read">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <div>
                                            <p>Samantha Francis</p>
                                            <span>3 hours ago</span>
                                        </div><!-- d-flex -->
                                        <p>My entire soul, like these sweet mornings of spring.</p>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <a href="" class="media-list-link read">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <div>
                                            <p>Robert Walker</p>
                                            <span>5 hours ago</span>
                                        </div><!-- d-flex -->
                                        <p>I should be incapable of drawing a single stroke at the present moment...</p>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <a href="" class="media-list-link read">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <div>
                                            <p>Larry Smith</p>
                                            <span>Yesterday</span>
                                        </div><!-- d-flex -->
                                        <p>When, while the lovely valley teems with vapour around me, and the meridian
                                            sun strikes...</p>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <div class="dropdown-footer">
                                <a href=""><i class="fa fa-angle-down"></i> Show All Messages</a>
                            </div>
                        </div><!-- media-list -->
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
                <div class="dropdown">
                    <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                        <i class="icon ion-ios-bell-outline tx-24"></i>
                        <!-- start: if statement -->
                        <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
                        <!-- end: if statement -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-header">
                        <div class="dropdown-menu-label">
                            <label>Notifications</label>
                            <a href="">Mark All as Read</a>
                        </div><!-- d-flex -->

                        <div class="media-list">
                            <!-- loop starts here -->
                            <a href="" class="media-list-link read">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <p class="noti-text"><strong>Suzzeth Bungaos</strong> tagged you and 18 others
                                            in a post.</p>
                                        <span>October 03, 2017 8:45am</span>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <!-- loop ends here -->
                            <a href="" class="media-list-link read">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <p class="noti-text"><strong>Mellisa Brown</strong> appreciated your work
                                            <strong>The Social Network</strong>
                                        </p>
                                        <span>October 02, 2017 12:44am</span>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <a href="" class="media-list-link read">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <p class="noti-text">20+ new items added are for sale in your <strong>Sale
                                                Group</strong></p>
                                        <span>October 01, 2017 10:20pm</span>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <a href="" class="media-list-link read">
                                <div class="media">
                                    <img src="https://via.placeholder.com/500" alt="">
                                    <div class="media-body">
                                        <p class="noti-text"><strong>Julius Erving</strong> wants to connect with you on
                                            your conversation with <strong>Ronnie Mara</strong></p>
                                        <span>October 01, 2017 6:08pm</span>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <div class="dropdown-footer">
                                <a href=""><i class="fa fa-angle-down"></i> Show All Notifications</a>
                            </div>
                        </div><!-- media-list -->
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
                <div class="dropdown">
                    <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                        <span class="logged-name hidden-md-down">Katherine</span>
                        <img src="https://via.placeholder.com/500" class="wd-32 rounded-circle" alt="">
                        <span class="square-10 bg-success"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-header wd-250">
                        <div class="tx-center">
                            <a href=""><img src="https://via.placeholder.com/500" class="wd-80 rounded-circle"
                                    alt=""></a>
                            <h6 class="logged-fullname">Katherine P. Lumaad</h6>
                            <p>youremail@domain.com</p>
                        </div>

                        <ul class="list-unstyled user-profile-nav">
                            <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                            <li><a href="<?= base_url('logout') ; ?>"><i class="icon ion-power"></i> Sign Out</a></li>
                        </ul>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
            </nav>

        </div><!-- br-header-right -->
    </div><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->


    <div class="br-mainpanel mg-b-50">
        <!-- <div class="br-pageheader">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="index.html">Bracket</a>
                <span class="breadcrumb-item active">Blank Page</span>
            </nav>
        </div> -->
        <!-- br-pageheader -->
        <!-- <div class="br-pagetitle">
            <i class="icon icon ion-ios-book-outline"></i>
            <div>
                <h4>Blank Page (Default Layout)</h4>
                <p class="mg-b-0">Introducing Bracket Plus admin template, the most handsome admin template of all time.
                </p>
            </div>
        </div> -->
        <!-- d-flex -->

        <!-- <div class="br-pagebody"> -->
        <!-- start you own content here -->