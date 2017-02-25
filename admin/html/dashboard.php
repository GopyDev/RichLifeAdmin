                            <li class="active">
                                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard </span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="dashboard.php">Dashboard </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="user_list.php">User list</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-filter"></i> <span class="nav-label">Trigger</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="trigger_list.php">Trigger List</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-map-marker"></i> <span class="nav-label">Events</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="event_list.php">Event List</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-venus"></i> <span class="nav-label">Venues</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="venue_list.php">Venues List</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tree"></i> <span class="nav-label">Parks and Amenities</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="panda_list.php">Parks and Amenities List</a></li>
                                </ul>
                            </li>
                       </ul>

                    </div>
                </div>
            </nav>
            <div id="wrapper">
                <div class="content-wrapper container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title">
                                <h1>Dashboard <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-sm-6 col-md-3 margin-b-30">
                            <div class="tile">
                                <div class="tile-title clearfix">
                                    Total events
                                </div><!--.tile-title-->
                                <div class="tile-body clearfix">
                                    <i class="fa fa-map-marker"></i>
                                    <h4 class="pull-right"><?php echo $totalEvents;?></h4>
                                </div><!--.tile-body-->
                                <div class="tile-footer">
                                    <a href="event_list.php">View Details...</a>
                                </div><!--.tile footer-->
                            </div><!-- .tile-->
                        </div><!--end .col-->
                        <div class="col-sm-6 col-md-3 margin-b-30">
                            <div class="tile">
                                <div class="tile-title clearfix">
                                    Users
                                </div><!--.tile-title-->
                                <div class="tile-body clearfix">
                                    <i class="fa fa-users"></i>
                                    <h4 class="pull-right"><?php echo $totalUsers;?></h4>
                                </div><!--.tile-body-->
                                <div class="tile-footer">
                                    <a href="user_list.php">View Details...</a>
                                </div><!--.tile footer-->
                            </div><!-- .tile-->
                        </div><!--end .col-->
                        <div class="col-sm-6 col-md-3 margin-b-30">
                            <div class="tile">
                                <div class="tile-title clearfix">
                                    Venues
                                </div><!--.tile-title-->
                                <div class="tile-body clearfix">
                                    <i class="fa fa-venus"></i>
                                    <h4 class="pull-right"><?php echo $totalVenues;?></h4>
                                </div><!--.tile-body-->
                                <div class="tile-footer">
                                    <a href="venue_list.php">View Details...</a>
                                </div><!--.tile footer-->
                            </div><!-- .tile-->
                        </div><!--end .col-->
                        <div class="col-sm-6 col-md-3 margin-b-30">
                            <div class="tile">
                                <div class="tile-title clearfix">
                                    Parks and Amenities
                                </div><!--.tile-title-->
                                <div class="tile-body clearfix">
                                    <i class="fa fa-tree"></i>
                                    <h4 class="pull-right"><?php echo $totalPA;?></h4>
                                </div><!--.tile-body-->
                                <div class="tile-footer">
                                    <a href="panda_list.php">View Details...</a>
                                </div><!--.tile footer-->
                            </div><!-- .tile-->
                        </div><!--end .col-->
                        <div class="col-md-6">
                            <div class="panel panel-card ">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"> Last event location</h4>
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="world-map" style="width: 100%; height: 280px"></div>
                                </div>
                            </div><!-- End .panel -->                       
                        </div><!--end .col-->
                    </div>
                </div> 
            </div>
        </section>
