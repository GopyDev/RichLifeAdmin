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
                            <li class="active">
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
                                <h1>Event edit<small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">Event edit</li>
                                </ol>
                            </div>
                            <input type="hidden" name="locationid" id="locationid" value="<?php echo $event[0]['latitude']; ?>">
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-card margin-b-30">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"> Please enter the event information below</h4>
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
                                        <div class="form-group"><label class="col-lg-2 control-label">Event category</label>
                                            <div class="col-lg-10">
                                                <div class="btn-group">
                                                    <select class="selectpicker form-control" id="category" name="category" onchange="javascript:changeCategory(this.value);">
                                                        <option value="regular" <?php if($event[0]['category'] === "regular") echo "selected"?>>Regular</option>
                                                        <option value="trending"<?php if($event[0]['category'] === "trending") echo "selected"?>>Trending</option>
                                                        <option value="offer" <?php if($event[0]['category'] === "offer") echo "selected"?>>Offer</option>
                                                        <option value="alert" <?php if($event[0]['category'] === "alert") echo "selected"?>>Alert</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="evtname"><label class="col-lg-2 control-label">Event Name</label>
                                            <div class="col-lg-10"><input type="text" placeholder="Event Name" id="name" name="name" class="form-control" value="<?php  echo $event[0]['name']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="form-group" id="evttitle"><label class="col-lg-2 control-label">Event Sub Title</label>
                                            <div class="col-lg-10"><input type="text" placeholder="Event Sub Title" id="subtitle" name="subtitle" class="form-control" value="<?php  echo $event[0]['title']; ?>"> 
                                            </div>
                                        </div>
                                        <?php if($event[0]['category'] === "regular" || $event[0]['category'] === "trending") {?>
                                        <div class="form-group" id="evttext"><label class="col-lg-2 control-label">Event Sub Text</label>
                                            <div class="col-lg-10"><textarea type="text" placeholder="Event Sub Text" id="subtext" name="subtext" class="form-control"><?php  echo $event[0]['subtext']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group" id="payment"><label class="col-lg-2 control-label">Payment</label>
                                            <div class="col-lg-10"><input type="checkbox" value="1" name="pay" <?php echo ($event[0]['payment']==1 ? 'checked' : '');?>></div>
                                        </div>
                                        <div class="form-group" id="reservation"><label class="col-lg-2 control-label">Reservation</label>
                                            <div class="col-lg-10"><input type="checkbox" value="1" name="reserve" <?php echo ($event[0]['reservation']==1 ? 'checked' : '');?>></div>
                                        </div>
                                        <?php }?>
                                        <?php if($event[0]['category'] !== "alert") {?>
                                        <div class="form-group" id="evtimage"><label class="col-lg-2 control-label">Event Image</label>
                                            <div class="col-lg-10">
                                                <span class="btn btn-success fileinput-button"><i class="fa fa-fw fa-plus"></i>
                                                <span>Add Image</span>
                                                    <input type="file" name="evtpicture[]" id="evtpicture">
                                                </span>
                                            </div>
                                        </div>
                                        <?php }?>
                                        <?php if($event[0]['picture']!=""){ ?>
                                        <div class="form-group" id="evtimgcontent"><label class="col-lg-2 control-label"></label>
                                            <div class="col-lg-10"><img src="<?php echo '../'.$event[0]['picture']; ?>" alt="Picture" class="img-circle" width="80" height="80" id="evtimg" name="evtimg"></div>
                                            <input type="hidden" name="picurl" id="picurl" value="<?php echo $event[0]['picture']; ?>" >
                                        </div>
                                        <?php }?>
                                        <?php if($event[0]['category'] === "regular" || $event[0]['category'] === "trending") {?>
                                        <div class="form-group" id="evticoncontent"><label class="col-lg-2 control-label">Event Icon</label>
                                            <div class="col-lg-10">
                                                <?php if($event[0]['icon']!=""){ ?>
                                                <img src="<?php echo '../'.$event[0]['icon']; ?>" alt="Icon" class="img-circle" width="35" height="35" id="evticon" name="evticon">
                                                <input type="hidden" name="iconurl" id="iconurl" value="<?php echo $event[0]['icon']; ?>" >
                                                <?php }?>
                                                <span class="btn btn-success fileinput-button"><i class="fa fa-fw fa-plus"></i>
                                                <span>Add icon...</span>
                                                    <input type="file" name="icon[]" id="icon">
                                                </span>
                                            </div>
                                        </div>
                                        <?php }?>
                                        <?php if($event[0]['category'] !== "alert") {?>
                                        <div class="form-group" id="evtlocation"><label class="col-lg-2 control-label">Location</label>
                                            <input type="hidden" id="latitude" name="latitude" value="<?php  echo $event[0]['latitude']; ?>">
                                            <input type="hidden" id="longitude" name="longitude" value="<?php  echo $event[0]['longitude']; ?>">
                                            <div class="col-lg-10"><input type="text" placeholder="Position" id="position" name="position" disabled class="form-control" value="<?php  echo "(".$event[0]['latitude'].",".$event[0]['longitude'].")"; ?>">
                                            </div>
                                        </div>
                                        <?php }?>
                                        <?php if($event[0]['category'] !== "alert") {?>
                                        <div class="form-group" id="evtmap">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div id="location_map" style="margin-top:20px; width: 600px; height: 400px;">
                                                    <img src="" width="16" height="16" id="place-icon">
                                                    <span id="place-name"  class="title"></span><br>
                                                    <span id="place-address"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="evtaddress"><label class="col-lg-2 control-label">Address</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Address" class="form-control" id="address" name="address" value="<?php  echo $event[0]['location']; ?>">
                                            </div>
                                        </div>
                                        <?php }?>
                                        <?php if($event[0]['category'] === "regular" || $event[0]['category'] === "trending") {?>
                                        <div class="form-group" id="evtdate"><label class="col-lg-2 control-label">Date and Time</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="Set date and time" class="form-control" id="datetime" name="datetime" value="<?php  echo $event[0]['datetime']; ?>">
                                            </div>
                                        </div>
                                        <?php }?>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-sm btn-primary" type="submit">Update Event</button>
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
        $('#evtpicture').change( function(event) {
            $('#evtimg').fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });
        $('#icon').change( function(event) {
            $('#evticon').fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });
        function changeCategory(str){
            if(str == "regular" || str == "trending"){
                var evttext = document.getElementById("evttext");
                evttext.style.display = 'block';
                var evtimage = document.getElementById("evtimage");
                evtimage.style.display = 'block';
                var evtimgcontent = document.getElementById("evtimgcontent");
                evtimgcontent.style.display = 'block';
                var evtlocation = document.getElementById("evtlocation");
                evtlocation.style.display = 'block';
                var evticoncontent = document.getElementById("evticoncontent");
                evticoncontent.style.display = 'block';
                var evtdate = document.getElementById("evtdate");
                evtdate.style.display = 'block';
                var evtmap = document.getElementById("evtmap");
                evtmap.style.display = 'block';
                var evtaddress = document.getElementById("evtaddress");
                evtaddress.style.display = 'block';
                var payment = document.getElementById("payment");
                payment.style.display = 'block';
                var reservation = document.getElementById("reservation");
                reservation.style.display = 'block';
            }
            else if(str == "offer"){
                var evttext = document.getElementById("evttext");
                evttext.style.display = 'none';
                var evtdate = document.getElementById("evtdate");
                evtdate.style.display = 'none';
                var evticoncontent = document.getElementById("evticoncontent");
                evticoncontent.style.display = 'none';
                var payment = document.getElementById("payment");
                payment.style.display = 'none';
                var reservation = document.getElementById("reservation");
                reservation.style.display = 'none';
            } else if(str == "alert"){
                var evttext = document.getElementById("evttext");
                evttext.style.display = 'none';
                var evtimage = document.getElementById("evtimage");
                evtimage.style.display = 'none';
                var evtimgcontent = document.getElementById("evtimgcontent");
                evtimgcontent.style.display = 'none';
                var evtlocation = document.getElementById("evtlocation");
                evtlocation.style.display = 'none';
                var evticoncontent = document.getElementById("evticoncontent");
                evticoncontent.style.display = 'none';
                var evtdate = document.getElementById("evtdate");
                evtdate.style.display = 'none';
                var evtmap = document.getElementById("evtmap");
                evtmap.style.display = 'none';
                var evtaddress = document.getElementById("evtaddress");
                evtaddress.style.display = 'none';
                var payment = document.getElementById("payment");
                payment.style.display = 'none';
                var reservation = document.getElementById("reservation");
                reservation.style.display = 'none';
            }
        }
        </script>