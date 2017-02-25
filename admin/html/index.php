            <div class="row">
                <div class="account-col text-center">
                    <h1>Chimeapp-Admin</h1>
                    <h3>Log into your account</h3>
                    <form class="m-t" role="form" action="index.php" method="post">
						<div class="form-group">
							<div class="error"><?php echo $msg; ?></div>
						</div>
                         <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" required="" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Passowrd" required="" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <a href="forgotpassword.php"><small>Forgot password?</small></a>
                <p class="text-center"><small>Do not have an account?</small></p>
                <a class="btn  btn-default btn-block" href="register.php">Create an account</a>
                <p>Chimeapp Admin &copy; 2017</p>
                    </form>
                </div>
            </div>
<script>
/*
var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  var crd = pos.coords;

  alert('Your current position is:');
  alert(`Latitude : ${crd.latitude}`);
  alert(`Longitude: ${crd.longitude}`);
  alert(`More or less ${crd.accuracy} meters.`);
};

function error(err) {
  console.warn(`ERROR(${err.code}): ${err.message}`);
};

function onClick(){
	navigator.geolocation.getCurrentPosition(success, error, options);
}*/
</script>