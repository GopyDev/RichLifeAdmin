 
            <div class="row">
                <div class="account-col text-center">
                    <h2>Forgot Password</h2>
                    <form class="m-t" role="form" action="forgotpassword.php" method="post">
                        <div class="form-group">
                          <div class="error"><?php echo $msg; ?></div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
                            <input type="email" name="email" id="email" class="form-control" id="exampleInputAmount" placeholder="Email" required="required">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
