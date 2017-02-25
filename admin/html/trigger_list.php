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
                            <li class="active">
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
                                <h1>Trigger List <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">Trigger List</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-card margin-b-30 ">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">Below is a list of the triggers</h4>
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                </div>
                                <?php if($msg){?>
                                    <div class="alert alert-success">
                                        <?php echo $msg;?>
                                    </div>
                                <?php }?>
                                <div class="panel-body">
                                        <table id="data_table" class="table table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <th>Distance(mile)</th>
                                                <th>Role</th>
                                                <th>Time of day</th>
                                                <th>Role</th>
                                                <th>Delay(min)</th>
                                            </tr>
                                            <?php for($i=0;$i<$row;$i++){?>
                                            <tr id="row<?php echo $alltrigger[$i]['triggerid'];?>">
                                                <td id="name_row<?php echo $alltrigger[$i]['triggerid'];?>" name="name_row<?php echo $alltrigger[$i]['triggerid'];?>"><?php echo $alltrigger[$i]['name'];?></td>
                                                <td id="distance<?php echo $alltrigger[$i]['triggerid'];?>" name="distance<?php echo $alltrigger[$i]['triggerid'];?>"><?php echo $alltrigger[$i]['distance'];?></td>
                                                <td id="frole<?php echo $alltrigger[$i]['triggerid'];?>" name="frole<?php echo $alltrigger[$i]['triggerid'];?>"><?php echo $alltrigger[$i]['frole'];?></td>
                                                <td id="timeofday<?php echo $i+1;?>" name="timeofday<?php echo $i+1;?>">
                                                <?php
                                                    if($alltrigger[$i]['timeofday'] !== ""){
                                                        $times = explode(",", $alltrigger[$i]['timeofday']);
                                                        $j = 1;
                                                        foreach ($times as $time) { 
                                                            $id = $i + 1;
                                                            ?>
                                                            <label id="time<?php echo $id.$j?>" name="time<?php echo $id.$j?>"><?php echo $time?></label><br>
                                                    <?php $j = $j + 1;} ?>
                                                <?php }?>
                                                </td>
                                                <td id="lrole<?php echo $alltrigger[$i]['triggerid'];?>"><?php echo $alltrigger[$i]['lrole'];?></td>
                                                <td id="delay<?php echo $alltrigger[$i]['triggerid'];?>"><?php echo $alltrigger[$i]['delay'];?></td>
                                                <td>
                                                <a id="edit_button<?php echo $alltrigger[$i]['triggerid'];?>" class="btn btn-link" onclick="edit_row('<?php echo $alltrigger[$i]['triggerid'];?>')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a id="save_button<?php echo $alltrigger[$i]['triggerid'];?>" class="btn btn-link" onclick="save_row('<?php echo $alltrigger[$i]['triggerid'];?>')" style="display:none"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                                                <a class="btn btn-link" onclick="delete_row('<?php echo $alltrigger[$i]['triggerid'];?>')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            <tr>
                                                <td><input type="text" id="new_name"></td>
                                                <td><input type="text" id="new_distance"></td>
                                                <td id="new_ftrole">
                                                    <select id="newfrole">
                                                        <option value="and">AND</option>
                                                        <option value="or">OR</option>
                                                    </select>
                                                </td>
                                                <td id="timeofday100" name="timeofday100">
                                                    <input type="time" id="time1001" name="time1001"><a id="minus1001" class="btn btn-link" onclick="add_time(100)"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                </td>
                                                <td id="new_ltrole">
                                                    <select id="newlrole">
                                                        <option value="and">AND</option>
                                                        <option value="or">OR</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" id="new_delay"></td>
                                                <td><a class="btn btn-link" onclick="add_row()"><i class="fa fa-plus" aria-hidden="true"></i> add trigger</a></td>
                                            </tr>
                                        </table>
                                        <a class="btn btn-primary btn-3d" id="savechange" name="savechange" onclick="saveChanges()">Save changes</a>
                                </div>
                            </div>
                        </div><!--end .col-->
                    </div>
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
        <script src="js/bootstrap-datetimepicker.js"></script>
        <script src="js/sweet-alert/sweetalert.min.js"></script>
        <script src="js/data-tables/table_script.js"></script>
        <script>
        $(document).ready(function() {
            document.getElementById('savechange').style.pointerEvents = 'none';
        });
        </script>