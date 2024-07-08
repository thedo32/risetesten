   
	
</head>

<body class="bg-body">
	<div class=fix-navbar>
		<a alt="News Page" href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" width = "128" height = "55"></a>
		<div class=fix-menu>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->userdata("name") === Null):?>
				<a href="<?php echo base_url(''); ?>">Home</a>
				<a href="<?php echo base_url('taluak'); ?>">Taluak Buo</a>
				<a href="<?php echo base_url('wisata'); ?>">Desa Wisata</a>
				<a href="<?php echo base_url('login'); ?>">Login</a>
			<?php elseif ($this->session->userdata("name") === 'Alpha'):?>
				<a href="<?php echo base_url(''); ?>">Home</a>
				<a href="<?php echo base_url('taluak'); ?>">Taluak Buo</a>
				<a href="<?php echo base_url('wisata'); ?>">Desa Wisata</a>
				<a href="<?php echo base_url('home'); ?>">Dashboard</a>
				<a href="<?php echo base_url('register/add'); ?>">Add User</a>
				<a href="<?php echo base_url('news/add'); ?>">Add News</a>
				<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
			<?php else: ?>
				<a href="<?php echo base_url(''); ?>">Home</a>
				<a href="<?php echo base_url('taluak'); ?>">Taluak Buo</a>
				<a href="<?php echo base_url('wisata'); ?>">Desa Wisata</a>
				<a href="<?php echo base_url('home'); ?>">Dashboard</a>
				<a href="<?php echo base_url('news/add'); ?>">Add News</a>
				<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
			<?php endif; ?>
		</div>
	</div>

    <div class=shadowbox><h4>Desa Wista Taluak Buo</h4></div> 

	<div class=container>
        <div class=row>
            <div class=table-responsive>
				<table class=table>
					<tbody>
					<tr>
						<td><div class="card-title"><h5><?php echo set_value('title', $news->title); ?></h5></div></td>
					</tr>
					<tr>
						<td><div class="d-flex my-2"><?php echo htmlspecialchars_decode(set_value('text', $news->text)); ?></div></td>
					</tr>
				</tbody>		
			</table>
		</div>
	</div>
</div>


