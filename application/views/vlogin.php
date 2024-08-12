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
		<div class=shadowbox><h3>Login Page</h3></div> 
		<a alt="Menara" href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" width = "110" height = "60"></a>
		<div class=logged-in>
			<a href="<?php echo base_url('register/add'); ?>"class=h7>Register</a>	
		</div>

		  <div class=fix-menu>
			<nav class="navbar-expand-lg navbar-light">
		  	<button class=" table navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
            </button>
     
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="text-center navbar-nav mr-auto">
					<li class="nav-item">
						<a href="<?php echo base_url('home'); ?>">Home</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('padang'); ?>">Cafe</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('taluak'); ?>" >Tour</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('painan'); ?>" >Creative Space</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('register/add'); ?>">Register</a>
					</li>
				</ul>
			</div>
			</nav>
		</div>
	</div>
	

 
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
    <br><br>
	<?php $this->load->view('welcome_login');?>
	<!-- notification if login error -->
    <?php if ($this->session->tempdata('error_login')): ?>
		<p id="addeditSuccessMessage" style="color: red;"><?php echo $this->session->tempdata('error_login'); ?></p>
    <?php endif; 

	if ($this->session->tempdata('email_sent')): ?>
		<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('email_sent'); ?></p>
    <?php elseif ($this->session->tempdata('email_failed')): ?>
		<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('email_failed'); ?></p>
    <?php endif; ?>
	<br><br>

<script>

	// for expand and collapse below navbar
	shiftBelowLTable();

</script>
