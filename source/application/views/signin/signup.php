
<form style="background-color: #86c2de !important;; " class="user-form signUp-form text-center form-active form-open" method="post" action="<?= base_url('signin/signup') ?>">
    <h1 class="form-heading">Sign Up</h1>

    <div class="form-group">
        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Full Name" required>
        <i class="fa fa-user input-icon"></i>
    </div>
    <?php echo form_error('fullname', '<span class="form-error">', '</span>'); ?>
    <div class="form-group">
        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
        <i class="fa fa-user input-icon"></i>
    </div>
    <?php echo form_error('username', '<span class="form-error">', '</span>'); ?>
    <div class="form-group">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        <i class="fa fa-key input-icon"></i>
    </div>
    <?php echo form_error('password', '<span class="form-error">', '</span>'); ?>
    <div class="form-group">
        <input type="password" name="confirm_pwd" class="form-control" id="confirm_pwd" placeholder="Confirm Password" required>
        <i class="fa fa-key input-icon"></i>
    </div>
    <?php echo form_error('confirm_pwd', '<span class="form-error">', '</span>'); ?>
    <div class="form-group">
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
        <i class="fa fa-envelope input-icon"></i>
    </div>
    <?php echo form_error('email', '<span class="form-error">', '</span>'); ?>
    <button type="submit" value="login" class="btn btn-block btn-login text-uppercase">
        Sign Up
    </button>
    <p class="forgot-password">
        Forgot your password? <a href="#">Click here</a>
    </p>
    <p class="no-account">
        You have an account allready? <a id="login-frm-button" href="<?= base_url('signin/index') ?>">Login</a>
    </p>
</form>