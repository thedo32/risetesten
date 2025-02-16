<!-- Place the first <script> tag in your HTML's <head> -->
<script type="text/javascript" src="https://cdn.tiny.cloud/1/bmlmb5p14dr85225jial6a2am0m0m3vihfyzrbkwbe9n2mnf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


</head>  
<body class="bg-body">

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>
	
    <div class=fix-navbar>
		<div class=shadowbox><h3>Add News</h3></div>
        <a alt="Menara" href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" class=image-logo></a>
		
		<div class=fix-menu>
		<nav class="navbar-expand-lg navbar-light">
		  	<button class=" table navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
            </button>
     
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="text-center navbar-nav mr-auto">


			<?php if ($this->session->userdata("name") === 'Alpha'):?>
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
					<a href="<?php echo base_url('register'); ?>">User Dashboard</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('register/add'); ?>">Add User</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('news/add/news'); ?>">Add News</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
				</li>
			<?php else: ?>
				redirect(base_url(''));	
			<?php endif; ?>
			</ul>
			</div>
			</nav>
		</div>
	</div>

 
<form action="<?php echo base_url(uri_string()); ?>" method="post" enctype="multipart/form-data">
    <table class="login-table">
        <tr>
            <td>Title</td>
            <td><input type="text" size="50" name="title" value="<?php echo set_value('title'); ?>"></td>
        </tr>
        <tr>
            <td>Text</td>
            <td><textarea name="text"><?php echo set_value('text'); ?></textarea></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="cover"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Add News"></td>
        </tr>
    </table>
</form>

<?php echo validation_errors(); ?>
<br><br>
