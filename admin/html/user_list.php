                            <li>
                                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard </span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="dashboard.php">Dashboard </a></li>
                                </ul>
                            </li>
                            <li class="active">
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
                                <h1>User List <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">User List</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-card ">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"> User list</h4>
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                </div>
                                <?php if($msg && $_GET['msg'] == 7){?>
                                    <div class="alert alert-success">
                                        <?php echo $msg." ".getERRORS("11");?>
                                    </div>
                                <?php } else if($msg && $_GET['msg'] == 8){?>
                                    <div class="alert alert-danger">
                                        <?php echo $msg;?>
                                    </div>
                                <?php }?>
                                <div class="panel-body">
                                    <!--<a href="" id="export" class="btn btn-link">
                                        <p class="text-right">
                                        export to csv </p>
                                    </a>-->
                                    <div id="dvData">
                                        <table id="basic-datatables" class="table table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Passcode</th>
                                                    <th>Created Date</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Passcode</th>
                                                    <th>Created Date</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php for($i=0;$i<$row;$i++){?>
                                                <tr>
                                                    <td><?php echo $alluser[$i]['firstname']." ".$alluser[$i]['lastname'];?></td>
                                                    <td><?php echo $alluser[$i]['phone'];?></td>
                                                    <td><?php echo $alluser[$i]['email'];?></td>
                                                    <td><?php echo $alluser[$i]['passcode'];?></td>
                                                    <td><?php echo $alluser[$i]['created_date'];?></td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <a href="createUser.php" class="btn btn-primary btn-3d">Create a new user</a>
                            </div><!-- End .panel -->  
                        </div><!--end .col-->
                    </div><!--end .row-->
                </div> 
            </div>
        </section>
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/metisMenu.min.js"></script>
        <script src="js/jquery.nanoscroller.min.js"></script>
        <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/jquery-jvectormap-world-mill-en.js"></script>
        <script src="js/data-tables/jquery.dataTables.js"></script>
        <script src="js/data-tables/dataTables.tableTools.js"></script>
        <script src="js/data-tables/dataTables.bootstrap.js"></script>
        <script src="js/data-tables/dataTables.responsive.js"></script>
        <script src="js/waves.min.js"></script>
        <!--        <script src="js/jquery.nanoscroller.min.js"></script>-->
        <script type="text/javascript" src="js/custom.js"></script>
        <script src="js/data-tables/tables-data.js"></script>
        <!--<script type='text/javascript' src='https://code.jquery.com/jquery-2.1.0.min.js'></script>
        <script src="js/data-tables/export-table.js"></script>
        <script type="text/javascript">
            jQuery.noConflict();
        </script>
        <script>
          // This must be a hyperlink
          $("#export").on('click', function(event) {
            // CSV
            var args = [$('#dvData>table'), 'userlist.csv'];

            exportTableToCSV.apply(this, args);

            // If CSV, don't do event.preventDefault() or return false
            // We actually need this to be a typical hyperlink
          });
        </script>-->
    </body>
</html>