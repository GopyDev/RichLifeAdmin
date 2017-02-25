                            <li>
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
                            <li class="active">
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
                                <h1>Create Venue <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">Create Venue</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-card margin-b-30">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"> Please enter the venue information below</h4>
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                </div>
                                <?php if($msg){?>
                                    <div class="alert alert-danger">
                                        <?php echo $msg;?>
                                    </div>
                                <?php }?>
                                <div class="panel-body">
                                    <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                                        <div class="form-group"><label class="col-lg-2 control-label">Venue Title</label>
                                            <div class="col-lg-10"><input type="text" placeholder="Venue title" id="name" name="name" class="form-control" required> 
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Venue Description</label>
                                            <div class="col-lg-10"><textarea type="text" placeholder="Venue Description" id="subtext" name="subtext" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Open Date</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Set open date" class="form-control" id="fdate" name="fdate">
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Expire Date</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Set expire date" class="form-control" id="tdate" name="tdate">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-sm btn-primary" type="submit">Create</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap-datetimepicker.js"></script>
        <script>
        $('#fdate').datetimepicker();
        $('#tdate').datetimepicker();
        </script>