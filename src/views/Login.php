
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5 custom_box_login">
          <div class="card-body">
          	<?php if (isset($parameters) && isset($parameters['error'])): ?>
				<div class="alert alert-danger" role="alert">
				  <strong>Error!</strong> <?php echo $parameters['error']; ?>
				</div>
          	<?php endif;?>
            <h5 class="card-title text-center">Sign In</h5>
            <form autocomplete="off" class="form-signin" method="post" action="<?php echo URL_HOST; ?>login">
              <div class="form-label-group">
                <input autocomplete="false" type="email" id="UserLogin" name="userApp" class="form-control" placeholder="Email address" required autofocus>
                <label for="UserLogin">Email address</label>
              </div>

              <div class="form-label-group">
                <input autocomplete="false" type="password" id="PasswordLogin" name="passApp" class="form-control" placeholder="Password" required>
                <label for="PasswordLogin">Password</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>