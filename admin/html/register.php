            <div class="row">
                <div class="account-col text-center">
                    <h1>Chimeapp-Admin</h1>
                    <h3>Create New account</h3>
                    <form class="m-t" role="form" action="register.php" method="post">
                        <div class="form-group">
                            <div class="error"><?php echo $msg; ?></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" required="" id="username" name="username">
                        </div>
                         <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" required="" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Passowrd" required="" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Repeat Passowrd" required="" id="repass" name="repass">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block ">Signup</button>
                        <a href="#"><small></small></a>
                <p class=" text-center"><small>Already have an account?</small></p>
                <a class="btn  btn-default btn-block" href="index.php">Log into account</a>
                <p>Chimeapp Admin &copy; 2017</p>
                    </form>
                </div>
            </div>
