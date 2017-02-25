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
                                <h1>Create User <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">Create User</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-card margin-b-30">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"> Create a new user</h4>
                                    <div class="panel-actions">
                                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                            <div class="col-lg-10"><input type="email" placeholder="Email" class="form-control" name="email" id="email" required> 
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-2 control-label">Passcode</label>
                                            <div class="col-lg-10">
                                                <div class="input-group"><input type="text" placeholder="Passcode" class="form-control" id="passcode" id="passcode" name="passcode"> <span class="input-group-btn"> <button type="button" class="btn btn-primary" id="codegen" onclick="javascript:Generatecode();" required>Generate
                                                </button> </span></div>
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
        <script src="js/sweet-alert/sweetalert.min.js"></script>
        <script type="text/javascript">
            function randomString(length, chars) {
                var result = '';
                for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
                return result;
            }

            function Generatecode(){
                // do something when button is clicked
                var rString = randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                document.getElementById("passcode").value = rString;
            }
        </script>
