<div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
      <div class="col-md-12">
            <?php if (session_has('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> <?php echo session_get('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_del('success');
            endif; ?>
        </div>
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo url('user/login')?>" method="post">
          <div class="form-group">
              <label>Email:<sup>*</sup></label>
              <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
              <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
          </div>    
          <div class="form-group">
              <label>Password:<sup>*</sup></label>
              <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
              <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
          </div>
          <div class="form-row">
            <div class="col">
              <input type="submit" class="btn btn-success btn-block" value="Login">
            </div>
            <div class="col">
              <a href="<?php echo url('user/register') ?>" class="btn btn-light btn-block">No account? Register</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>