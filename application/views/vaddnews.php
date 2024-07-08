<script type="text/javascript" src="https://cdn.tiny.cloud/1/bmlmb5p14dr85225jial6a2am0m0m3vihfyzrbkwbe9n2mnf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
// tinymce loader
tinymce.init({
	selector: 'textarea',
	plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
	toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
	height: 350,
	tinycomments_mode: 'embedded',
	tinycomments_author: 'Author name',
	mergetags_list: [
		{ value: 'First.Name', title: 'First Name' },
		{ value: 'Email', title: 'Email' },
	],
	ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
});
</script>


</head>  
<body class="bg-body">
	<?php echo validation_errors(); ?>
    <div class=fix-navbar>
        <a alt="News Page" href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" width = "128" height = "55"></a>
		<div class=logged-in>
		<?php if ($this->session->userdata("name") === 'Alpha' ):?>
				You're Logged in' <a href="<?php echo base_url('home'); ?>" class=h7>Admin</a>
		<?php elseif ($this->session->userdata("name") != Null ):?>
				You're Logged in' <a href="<?php echo base_url('home'); ?>" class=h7><?php echo $this->session->userdata("name"); ?></a>
		<?php endif; ?>	
		</div>
		<div class=fix-menu>
			<?php if ($this->session->userdata("name") === Null):
				redirect(base_url(''));	
			elseif ($this->session->userdata("name") === 'Alpha'):?>
				<a href="<?php echo base_url(''); ?>">Home</a>
				<a href="<?php echo base_url('home'); ?>">Dashboard</a>
				<a href="<?php echo base_url('register/add'); ?>">Add User</a>
				<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
			<?php else: ?>
				<h6>You're Logged in' !,<a href="<?php echo base_url('home'); ?>"><?php echo $this->session->userdata("name") ?> </h6>
				<a href="<?php echo base_url(''); ?>">Home</a>
				<a href="<?php echo base_url('home'); ?>">Dashboard</a>
				<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
			<?php endif; ?>
		</div>
	</div>

	<div class=shadowboxmin><h1>Add News</h1></div>

    <form action="<?php echo base_url('news/add'); ?>" method="post">
        <table class=login-table>
            <tr>
                <td>Title</td>
                <td><input type="text" size="50"  name="title" value="<?php echo set_value('title'); ?>"></td>
            </tr>
            <tr>
                <td>Text</td>
                <td><textarea name="text" value="<?php echo set_value('text'); ?>"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Add News"></td>
            </tr>
        </table>
    </form>
