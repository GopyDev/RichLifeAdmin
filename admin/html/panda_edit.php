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
                            <li>
                                <a href="#"><i class="fa fa-venus"></i> <span class="nav-label">Venues</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="venue_list.php">Venues List</a></li>
                                </ul>
                            </li>
                            <li class="active">
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
                                <h1>Park or Amenity edit<small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">Park or Amenity edit</li>
                                </ol>
                            </div>
                            <input type="hidden" name="locationid" id="locationid" value="<?php echo $allpa[0]['latitude']; ?>">
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-card margin-b-30">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"> Please enter the details information below</h4>
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
                                        <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                                            <div class="col-lg-10"><input type="text" placeholder="Title" id="subtitle" name="subtitle" class="form-control" value="<?php  echo $allpa[0]['title']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Sub Text</label>
                                            <div class="col-lg-10"><textarea type="text" placeholder="Sub Text" id="subtext" name="subtext" class="form-control"><?php  echo $allpa[0]['text']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Picture</label>
                                            <div class="col-lg-10">
                                                <span class="btn btn-success fileinput-button"><i class="fa fa-fw fa-plus"></i>
                                                <span>Add Picture</span>
                                                    <input type="file" name="picture[]" id="picture">
                                                </span>
                                            </div>
                                        </div>
                                        <?php if($allpa[0]['picture']!=""){ ?>
                                        <div class="form-group"><label class="col-lg-2 control-label"></label>
                                            <div class="col-lg-10"><img src="<?php echo '../'.$allpa[0]['picture']; ?>" alt="Picture" class="img-circle" width="80" height="80" id="evtimg" name="evtimg"></div>
                                            <input type="hidden" name="picurl" id="picurl" value="<?php echo $allpa[0]['picture']; ?>" >
                                        </div>
                                        <?php }?>
                                        <div class="form-group"><label class="col-lg-2 control-label">Location</label>
                                            <input type="hidden" id="latitude" name="latitude" value="<?php  echo $allpa[0]['latitude']; ?>">
                                            <input type="hidden" id="longitude" name="longitude" value="<?php  echo $allpa[0]['longitude']; ?>">
                                            <div class="col-lg-10"><input type="text" placeholder="Position" id="position" name="position" disabled class="form-control" value="<?php  echo "(".$allpa[0]['latitude'].",".$allpa[0]['longitude'].")"; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div id="location_map" style="margin-top:20px; width: 600px; height: 400px;">
                                                    <img src="" width="16" height="16" id="place-icon">
                                                    <span id="place-name"  class="title"></span><br>
                                                    <span id="place-address"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Address</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Address" class="form-control" id="address" name="address" value="<?php  echo $allpa[0]['location']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Date and Time</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Set date and time" class="form-control" id="datetime" name="datetime" value="<?php  echo $allpa[0]['datetime']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
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
        <script src="js/summernote/initmap.js"></script>
        <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBumNE0JnVkEq_0mvdrTZr1rKjGtGbTO-g&libraries=places&callback=initMap">
        </script>
        <script src="js/bootstrap-datetimepicker.js"></script>
        <script>
        $('#datetime').datetimepicker();
        $('#picture').change( function(event) {
            $('#evtimg').fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });
        </script>