	
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
<body class=bg-body>
    <div class=fix-navbar>
		<div class=shadowbox><h3>User List</h3></div>
        <a alt="Menara" href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" width = "128" height = "55"></a>
		<div class=logged-in>
				  <a href="<?php echo base_url('home'); ?>" class=h8>Admin</a><br>
				<a href="<?php echo base_url('login/logout'); ?>"class=h8>Logout</a>
		</div>
	
		
		<div class=fix-menu>
			<?php echo validation_errors(); ?>

			<nav class="navbar-expand-lg navbar-light">
		  	<button class=" table navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
            </button>


			 <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="text-center navbar-nav mr-auto">
			<?php if ($this->session->userdata("name") === 'Alpha'):?>
				<li class="nav-item">
					<a href="<?php echo base_url('padang'); ?>" >Cafe</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('taluak'); ?>" >Tour</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('painan'); ?>" >Creative Space</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('register'); ?>">User Dashboard</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('register/add'); ?>">Add User</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('news/add/news'); ?>">Add News</a>
				</li>
			<?php else: 
				redirect(base_url(''));	
			endif; ?>
			</ul>
			</div>
			</nav>
		</div>
	</div>


		<!-- notification if add or edit user success-->
		<?php if ($this->session->tempdata('add_success')): ?>
			<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('add_success'); ?></p>
		<?php elseif ($this->session->tempdata('edit_success')): ?>
			<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('edit_success'); ?></p>
		<?php endif; ?>

		<?php if ($this->session->tempdata('email_sent')): ?>
			<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('email_sent'); ?></p>
		<?php elseif ($this->session->tempdata('email_failed')): ?>
			<p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('email_failed'); ?></p>
		<?php endif; ?>
    

	
    <table class=user-table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a href="<?php echo site_url('register/edit/' . $user['id']); ?>">Edit</a>
                        <a href="<?php echo site_url('register/delete/' . $user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <?php echo $this->pagination->create_links(); ?>
    <br>

	<script>
		// for expand and collapse below navbar
		shiftBelowUTable();
	</script>
	
