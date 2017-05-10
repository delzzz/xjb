<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>数据统计-首页</title>
    <!-- Bootstrap -->
    <link href="/Public/Admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- Custom Theme Style -->
    <link href="/Public/Admin/build/css/custom.min.css" rel="stylesheet">
    
    <style>
        .box_sm:hover, .box_lg:hover {
            background:  url("/Public/Admin/images/cishoo/bk-icon.png") no-repeat center;
            background-size: 100% 100%;
            height: 277px;
            margin-top: -5px;
            padding-bottom: 5px;
            /*border-bottom: 5px solid #cc0000;*/
        }
    </style>

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <!--left-->
        <div class="col-md-3 wsh_left left_col">
            <div class="left_col scroll-view">
                <div class="text-center logo_bg" style="">
                    <img style="" src="/Public/Admin/images/cishoologo.png">
                </div>
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <!--<h3>General</h3>-->
                        <ul class="nav side-menu">
                            <li>
                                <a href="../index/index.html">
                                    <div class="left_icon1"
                                         style="background: url('/Public/Admin/images/cishoo/sidebar-icon-1.png') no-repeat center 100%;"></div>
                                    平台首页 <span class="fa fa-chevron-down"></span></a>
                            </li>
                            <li><a href="../data_statistics/data_index.html">
                                <div class="left_icon2"
                                     style="background: url('../../images/cishoo/sidebar-icon-2.png') no-repeat center 100%;"></div>
                                数据统计 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="">新增统计</a></li>
                                    <li><a href="">沉默用户</a></li>
                                    <li><a href="">基本数据</a></li>

                                </ul>
                            </li>
                            <li><a href="../userbasicfile/basicfile.html">
                                <div class="left_icon3"
                                     style="background: url('/Public/Admin/images/cishoo/sidebar-icon-3.png') no-repeat center 100%;"></div>
                                老人基础档案 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="">老人基础档案</a></li>
                                    <li><a href="">老人健康档案</a></li>
                                </ul>
                            </li>
                            <li><a href="../warning/warning_history.html">
                                <div class="left_icon4"
                                     style="background: url('/Public/Admin/images/cishoo/sidebar-icon-4.png') no-repeat center 100%;"></div>
                                设备报警 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="">历史报警查询</a></li>
                                </ul>
                            </li>
                            <li><a href="../health/health_list.html">
                                <div class="left_icon5"
                                     style="background: url('/Public/Admin/images/cishoo/sidebar-icon-5.png') no-repeat center 100%;"></div>
                                健康管理 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="">用药提醒</a></li>
                                    <li><a href="">健康监控</a></li>

                                </ul>
                            </li>
                            <li><a href="../usermanage/user_manage.html">
                                <div class="left_icon6"
                                     style="background: url('/Public/Admin/images/cishoo/sidebar-icon-6.png') no-repeat center 100%;"></div>
                                通知管理<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="">消息推送</a></li>
                                    <li><a href="">代理通知</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="menu_section">
                        <!--<h3>代理商管理</h3>-->
                        <ul class="nav side-menu">
                            <li><a href="../agent/agent_index.html">
                                <div class="left_icon7"
                                     style="background: url('/Public/Admin/images/cishoo/sidebar-icon-7.png') no-repeat center 100%;"></div>
                                代理商/机构管理<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="../agent/agent.html">添加代理商</a></li>
                                    <li><a href="../agent/agent2.html">添加机构平台</a></li>
                                    <li><a href="../agent/agent_index.html">医疗机构详情</a></li>
                                </ul>
                            </li>

                            <li><a href="../usermanage/user_manage.html">
                                <div class="left_icon8"
                                     style="background: url('/Public/Admin/images/cishoo/sidebar-icon-8.png') no-repeat center 100%;"></div>
                                账号管理<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="../usermanage/user_manage.html">当前账号管理</a></li>
                                    <li><a href="../usermanage/user_list.html">坐席管理</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="../../login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>
        <!--top-->
        <div class="top_nav wsh_top">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="../../javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="/Public/Admin/images/img.jpg" alt="">John Doe
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="../../javascript:;"> Profile</a></li>
                                <li>
                                    <a href="../../javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li><a href="../../javascript:;">Help</a></li>
                                <li><a href="../../login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="../../javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="/Public/Admin/images/img.jpg" alt="Profile Image"/></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="/Public/Admin/images/img.jpg" alt="Profile Image"/></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="/Public/Admin/images/img.jpg" alt="Profile Image"/></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="/Public/Admin/images/img.jpg" alt="Profile Image"/></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--page content-->
        
    <div class="right_col" role="main">
        <div class="box_nav" style="">
            <div class="row top_tiles">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_sm text-center bg_1">
                        <img src="/Public/Admin/images/cishoo/bk-icon-1.png">
                        <div>数据统计</div>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_sm text-center bg_2">
                        <img src="/Public/Admin/images/cishoo/bk-icon-2.png">
                        <div>老人基础档案</div>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_sm text-center bg_3">
                        <img src="/Public/Admin/images/cishoo/bk-icon-3.png">
                        <div>设备报警</div>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_sm text-center bg_4">
                        <img src="/Public/Admin/images/cishoo/bk-icon-4.png">
                        <div>健康管理</div>
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="box_lg text-center bg_5">
                        <img src="/Public/Admin/images/cishoo/bk-icon-5.png">
                        <div>通知管理</div>
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="box_lg text-center bg_6">
                        <img src="/Public/Admin/images/cishoo/bk-icon-6.png">
                        <div>账号管理</div>
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="box_lg text-center bg_7">
                        <img src="/Public/Admin/images/cishoo/bk-icon-7.png">
                        <div>代理商/机构管理</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
<script src="/Public/Admin/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/Public/Admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<!-- bootstrap-daterangepicker -->
<script src="/Public/Admin/vendors/moment/min/moment.min.js"></script>
<script src="/Public/Admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Custom Theme Scripts -->
<script src="/Public/Admin/vendors/raphael/raphael.min.js"></script>
<script src="/Public/Admin/vendors/morris.js/morris.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="/Public/Admin/build/js/custom.min.js"></script>
</body>
</html>