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

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>themes/bracket/assets/css/bracket.css">
    <link rel="stylesheet" href="<?= base_url(); ?>themes/bracket/assets/css/bracket.oreo.css">
    <script src="<?= base_url(); ?>themes/bracket/assets/lib/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    var baseurl = "<?= base_url(); ?>";
    var siteurl = "<?= site_url(); ?>";
    var thisController = '<?= $this->uri->segment(1); ?>' + '/';
    var thisFunction = '<?= $this->uri->segment(2); ?>' + '/';
    </script>
</head>

<body>
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href=""><span>[</span>CRJ <i>App</i><span>]</span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
        <label class="sidebar-label pd-x-10 mg-t-20">Navigation</label>
        <ul class="br-sideleft-menu">
            <li class="br-menu-item">
                <a href="index.html" class="br-menu-link">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                    <span class="menu-item-label">Dashboard</span>
                </a><!-- br-menu-link -->
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="mailbox.html" class="br-menu-link">
                    <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                    <span class="menu-item-label">Mailbox</span>
                </a><!-- br-menu-link -->
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                    <span class="menu-item-label">Cards &amp; Widgets</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="card-dashboard.html" class="sub-link">Dashboard</a></li>
                    <li class="sub-item"><a href="card-social.html" class="sub-link">Blog &amp; Social Media</a></li>
                    <li class="sub-item"><a href="card-listing.html" class="sub-link">Shop &amp; Listing</a></li>
                </ul>
            </li>
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                    <span class="menu-item-label">UI Elements</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="accordion.html" class="sub-link">Accordion</a></li>
                    <li class="sub-item"><a href="alerts.html" class="sub-link">Alerts</a></li>
                    <li class="sub-item"><a href="buttons.html" class="sub-link">Buttons</a></li>
                    <li class="sub-item"><a href="cards.html" class="sub-link">Cards</a></li>
                    <li class="sub-item"><a href="carousel.html" class="sub-link">Carousel</a></li>
                    <li class="sub-item"><a href="dropdowns.html" class="sub-link">Dropdowns</a></li>
                    <li class="sub-item"><a href="icons.html" class="sub-link">Icons</a></li>
                    <li class="sub-item"><a href="images.html" class="sub-link">Images</a></li>
                    <li class="sub-item"><a href="list.html" class="sub-link">Lists</a></li>
                    <li class="sub-item"><a href="modal.html" class="sub-link">Modal</a></li>
                    <li class="sub-item"><a href="media.html" class="sub-link">Media Object</a></li>
                    <li class="sub-item"><a href="pagination.html" class="sub-link">Pagination</a></li>
                    <li class="sub-item"><a href="popups.html" class="sub-link">Tooltip &amp; Popover</a></li>
                    <li class="sub-item"><a href="progress.html" class="sub-link">Progress</a></li>
                    <li class="sub-item"><a href="spinners.html" class="sub-link">Spinners</a></li>
                    <li class="sub-item"><a href="typography.html" class="sub-link">Typography</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon ion-ios-redo-outline tx-24"></i>
                    <span class="menu-item-label">Navigation</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="navigation.html" class="sub-link">Basic Nav</a></li>
                    <li class="sub-item"><a href="navigation-layouts.html" class="sub-link">Nav Layouts</a></li>
                    <li class="sub-item"><a href="navigation-effects.html" class="sub-link">Nav Effects</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                    <span class="menu-item-label">Charts</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="chart-morris.html" class="sub-link">Morris Charts</a></li>
                    <li class="sub-item"><a href="chart-flot.html" class="sub-link">Flot Charts</a></li>
                    <li class="sub-item"><a href="chart-chartjs.html" class="sub-link">Chart JS</a></li>
                    <li class="sub-item"><a href="chart-echarts.html" class="sub-link">ECharts</a></li>
                    <li class="sub-item"><a href="chart-rickshaw.html" class="sub-link">Rickshaw</a></li>
                    <li class="sub-item"><a href="chart-chartist.html" class="sub-link">Chartist</a></li>
                    <li class="sub-item"><a href="chart-sparkline.html" class="sub-link">Sparkline</a></li>
                    <li class="sub-item"><a href="chart-peity.html" class="sub-link">Peity</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                    <span class="menu-item-label">Forms</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="form-elements.html" class="sub-link">Form Elements</a></li>
                    <li class="sub-item"><a href="form-layouts.html" class="sub-link">Form Layouts</a></li>
                    <li class="sub-item"><a href="form-validation.html" class="sub-link">Form Validation</a></li>
                    <li class="sub-item"><a href="form-wizards.html" class="sub-link">Form Wizards</a></li>
                    <li class="sub-item"><a href="form-editor-code.html" class="sub-link">Code Editor</a></li>
                    <li class="sub-item"><a href="form-editor-text.html" class="sub-link">Text Editor</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                    <span class="menu-item-label">Tables</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub nav flex-column">
                    <li class="sub-item"><a href="table-basic.html" class="sub-link">Basic Table</a></li>
                    <li class="sub-item"><a href="table-datatable.html" class="sub-link">Data Table</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon ion-ios-navigate-outline tx-24"></i>
                    <span class="menu-item-label">Maps</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="map-google.html" class="sub-link">Google Maps</a></li>
                    <li class="sub-item"><a href="map-leaflet.html" class="sub-link">Leaflet Maps</a></li>
                    <li class="sub-item"><a href="map-vector.html" class="sub-link">Vector Maps</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon ion-ios-color-filter-outline tx-24"></i>
                    <span class="menu-item-label">Skins</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="skin-select2.html" class="sub-link">Select2</a></li>
                    <li class="sub-item"><a href="skin-rangeslider.html" class="sub-link">Ion RangeSlider</a></li>
                    <li class="sub-item"><a href="skin-input-form.html" class="sub-link">Textbox Form</a></li>
                    <li class="sub-item"><a href="skin-file-browser.html" class="sub-link">File Browser</a></li>
                    <li class="sub-item"><a href="skin-datepicker.html" class="sub-link">Datepicker</a></li>
                    <li class="sub-item"><a href="skin-template.html" class="sub-link">Template</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
                    <span class="menu-item-label">Utilities</span>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub">
                    <li class="sub-item"><a href="background.html" class="sub-link">Background</a></li>
                    <li class="sub-item"><a href="border.html" class="sub-link">Border</a></li>
                    <li class="sub-item"><a href="height.html" class="sub-link">Height</a></li>
                    <li class="sub-item"><a href="margin.html" class="sub-link">Margin</a></li>
                    <li class="sub-item"><a href="padding.html" class="sub-link">Padding</a></li>
                    <li class="sub-item"><a href="position.html" class="sub-link">Position</a></li>
                    <li class="sub-item"><a href="typography-util.html" class="sub-link">Typography</a></li>
                    <li class="sub-item"><a href="width.html" class="sub-link">Width</a></li>
                </ul>
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="pages.html" class="br-menu-link">
                    <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                    <span class="menu-item-label">Apps &amp; Pages</span>
                </a><!-- br-menu-link -->
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="layouts.html" class="br-menu-link">
                    <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
                    <span class="menu-item-label">Layouts</span>
                </a><!-- br-menu-link -->
            </li><!-- br-menu-item -->
            <li class="br-menu-item">
                <a href="sitemap.html" class="br-menu-link">
                    <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
                    <span class="menu-item-label">Sitemap</span>
                </a><!-- br-menu-link -->
            </li><!-- br-menu-item -->
        </ul><!-- br-sideleft-menu -->
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->
    <!-- <?= $this->menu_generator->build_menus(); ?> -->

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
                        <!-- <hr>
                        <div class="tx-center">
                            <span class="profile-earning-label">Earnings After Taxes</span>
                            <h3 class="profile-earning-amount">$13,230 <i
                                    class="icon ion-ios-arrow-thin-up tx-success"></i></h3>
                            <span class="profile-earning-text">Based on list price.</span>
                        </div>
                        <hr> -->
                        <ul class="list-unstyled user-profile-nav">
                            <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                            <!--  <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
                            <li><a href=""><i class="icon ion-ios-download"></i> Downloads</a></li>
                            <li><a href=""><i class="icon ion-ios-star"></i> Favorites</a></li>
                            <li><a href=""><i class="icon ion-ios-folder"></i> Collections</a></li> -->
                            <li><a href="<?= base_url('logout') ; ?>"><i class="icon ion-power"></i> Sign Out</a></li>
                        </ul>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
            </nav>
            <!-- <div class="navicon-right">
                <a id="btnRightMenu" href="" class="pos-relative">
                    <i class="icon ion-ios-chatboxes-outline"></i>

                    <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>

                </a>
            </div> -->
            <!-- navicon-right -->
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
        <div class="br-pagetitle">
            <i class="icon icon ion-ios-book-outline"></i>
            <div>
                <h4>Blank Page (Default Layout)</h4>
                <p class="mg-b-0">Introducing Bracket Plus admin template, the most handsome admin template of all time.
                </p>
            </div>
        </div><!-- d-flex -->

        <div class="br-pagebody">

            <div class="card">
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus dolore cupiditate minus
                        necessitatibus, pariatur ratione? Possimus libero sed suscipit ab!</p>
                </div>
            </div>
            <!-- start you own content here -->