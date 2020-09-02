<?php
require PRIVATE_PATH . '/views/inc/header.php';
?>
<div class="content-range">
    <!-- Create a user -->
    <div class="row d-flex justify-content-center">
        <?php echo flash('create_user_success'); ?>
        <?php echo flash('create_user_fail'); ?>
        <form action="<?php echo URL; ?>/users/adminCreate" method="post" class="border px-5 py-4 col-9">
            <h2>Create a user</h2>

            <div class="form-group row">
                <label for="username" class="col-sm-4 col-form-label">User Name</label>
                <div class="col-sm-8">
                    <input type="input" name="username"
                        class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                        placeholder="John Doe">
                    <span class="invalid-feedback"> <?php echo $data['name_err']; ?> </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="input" name="email"
                        class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                        id="reg-email" placeholder="Enter email">
                    <span class="invalid-feedback"> <?php echo $data['email_err']; ?> </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password"
                        class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                        id="reg-pass" placeholder="Password">
                    <span class="invalid-feedback"> <?php echo $data['password_err']; ?> </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="confirmPassword" class="col-sm-4 col-form-label">Confirm Password</label>
                <div class="col-sm-8">
                    <input type="password" name="confirm_password"
                        class="form-control <?php echo (!empty($data['passconfirm_err'])) ? 'is-invalid' : ''; ?>"
                        id="reg-confirmpass" placeholder="Confirm Password">
                    <span class="invalid-feedback">
                        <?php echo $data['passconfirm_err']; ?> </span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Role</label>
                <div class="col-sm-8">
                    <select class="form-control" name="role">
                        <option value="default">default</option>
                        <option value="owner">owner</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <input type="submit" name="create" value="CREATE NEW USER" class="btn btn-outline-primary" />
            </div>
        </form>
    </div>
    <hr />





</div>

</div>
<?php
require PRIVATE_PATH . '/views/inc/footer.php';
?>