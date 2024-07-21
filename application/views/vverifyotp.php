<div class="container">
    <h2>Verify OTP</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('register/verify_otp'); ?>
        <div class="form-group">
            <label for="otp">OTP</label>
            <input type="text" class="form-control" name="otp" id="otp" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify</button>
    <?php echo form_close(); ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
</div>

