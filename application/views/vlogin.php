	<!-- script for temporary notification -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script>
		$(document).ready(function() {
			// Delay in milliseconds (e.g., 8000 ms = 8 seconds)
			var delay = 8000;

			// Hide the message after the delay
			setTimeout(function() {
				$('#addeditSuccessMessage').fadeOut(5000, function() {
                $(this).remove();
				});
			}, delay);
		});
	</script>
</head>

<body class="bg-body">
    <div class=fix-navbar>
		<div class=shadowbox><h5>Login Page</h5></div> 
		<a alt="Home href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" width = "128" height = "55"></a>
      

		  <div class=fix-menu>
			<nav class="navbar-expand-lg navbar-light">
		  	<button class=" table navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
            </button>
     
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="text-center navbar-nav mr-auto">
					<li class="nav-item">
						<a href="<?php echo base_url(''); ?>" >Menara</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('taluak'); ?>" >Taluak Buo</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('painan'); ?>" >Painan</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('register/add'); ?>">Register</a>
					</li>
				</div>
			</nav>
		</div>
	</div>
	

    <!-- notification if login error -->
    <?php if ($this->session->tempdata('error_login')): ?>
		<p id="addeditSuccessMessage" style="color: red;"><?php echo $this->session->tempdata('error_login'); ?></p>
    <?php endif; 

		if ($this->session->tempdata('email_sent')): ?>
    <p style="color: green;"><?php echo $this->session->tempdata('email_sent'); ?></p>
    <?php elseif ($this->session->tempdata('email_failed')): ?>
    <p style="color: green;"><?php echo $this->session->tempdata('email_failed'); ?></p>
    <?php endif; ?>


    <form action="<?php echo base_url('login/actionlogin'); ?>" method="post">

        <table class=login-table>

            <tr>

                <td>Username</td>

                <td><input type="text" name="username"></td>

            </tr>

            <tr>

                <td>Password</td>

                <td><input type="password" name="password"></td>

            </tr>

            <tr>

                <td></td>

                <td><input type="submit" value="Login"></td>

            </tr>



        </table>

    </form>
    <br>

<script>

	// for expand and collapse below navbar
	shiftBelowLTable();

</script>
