
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
	<?php echo validation_errors(); ?>
    <div class=fix-navbar>
	<div class=shadowbox><h3>Meeting and Creative Space</h3></div> 
        <a alt="Menara" href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" width = "110" height = "60"></a>
		<div class=logged-in>
		<?php if ($this->session->userdata("name") === 'Alpha' ):?>
				  <a href="<?php echo base_url('home'); ?>" class=h8>Admin</a><br>
				<a href="<?php echo base_url('login/logout'); ?>"class=h8>Logout</a>
		<?php elseif ($this->session->userdata("name") != Null ):?>
				  <a href="<?php echo base_url('home'); ?>" class=h8><?php echo $this->session->userdata("name"); ?></a><br>
				<a href="<?php echo base_url('login/logout'); ?>"class=h8>Logout</a>
		<?php else:?> 
				<a href="<?php echo base_url('login'); ?>"class=h7>Login</a>	
		<?php endif; ?>	
		</div>
		
		<div class=fix-menu>
			<nav class="navbar-expand-lg navbar-light">
		  	<button class=" table navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
            </button>
     
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="text-center navbar-nav mr-auto">
			<?php if ($this->session->userdata("name") === Null):?>
				<li class="nav-item">
					<a href="<?php echo base_url('home'); ?>">Home</a>
				</li>
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
					<a href="<?php echo base_url('login'); ?>" >Login</a>
				</li>
			<?php elseif ($this->session->userdata("name") === 'Alpha'):?>
				<li class="nav-item">
					<a href="<?php echo base_url('home'); ?>">Home</a>
				</li>
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
					<a href="<?php echo base_url('news/add/painan'); ?>">Add Menu Space</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('news/add/news'); ?>">Add News</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
				</li>
			<?php else: ?>
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
					<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
				</li>
			<?php endif; ?>
			</ul>
			</div>
			</nav>
		</div>
	</div>

	<?php $this->load->view("header_slider");
		  // $this->load->view('side_post');
	?>

	<?php if ($this->session->userdata("name") === Null):
		$name = " ";
	else:
		$name = $this->session->userdata("name");
	endif; 
	
	
	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Hello Kupi Batigo, I am $name interested in asking for more details");

	?>

	<div class=h10> 
		<a href="https://kopibatigo.id/home">IDN</a><br>
		<a href="<?php echo $whatsappLink; ?>" target=_blank class="fa fa-whatsapp"></a><br>
		<a href="#" class="fa fa-instagram"></a><br>
		<a href="#" class="fa fa-facebook"></a><br>
	</div>

	<!-- notification if add or edit news success-->
    <?php if ($this->session->tempdata('add_success')): ?>
    <p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('add_success'); ?></p>
    <?php elseif ($this->session->tempdata('edit_success')): ?>
    <p id="addeditSuccessMessage" style="color: green;"><?php echo $this->session->tempdata('edit_success'); ?></p>
    <?php endif; ?>

   
         <div class=row>
            <div class=table-responsive>
				<?php if ($this->session->userdata("name") === 'Alpha'):?>

                <table class=admin-table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($painan)): ?>
                        <?php foreach ($painan as $painan_list): ?>
                        <tr>
                            <td>
                               <a href="<?php echo site_url('painan/view/' . $painan_list['slug']); ?>"><?php echo $painan_list['title']; ?></a>
                            </td>
                            <td><?php echo character_limiter($painan_list['text'],30); ?></td>
                            <td>
                                <a href="<?php echo site_url('news/edit/painan/' . $painan_list['id']); ?>">Edit</a><p>
                                <a href="<?php echo site_url('news/delete/painan/' . $painan_list['id']); ?>" onclick="return confirm('Are you sure you want to delete this news?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="4">No news available.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php else: ?>

                <table class="news-table">
                    <tbody>					  
                        <?php if (is_array($painan)): ?>
                        <tr>
							 <?php foreach ($painan as $index => $painan_list): ?>
								<td>
									<div class="newsbox">
										 <div class="md-title"><a href="<?php echo site_url('painan/view/' . $painan_list['slug']); ?>" title="<?php echo $painan_list['title']; ?>"><?php echo $painan_list['title']; ?></a></div><br>
										 <a href="<?php echo site_url('painan/view/' . $painan_list['slug']); ?>" data-toggle="tooltip" title="<?php echo $painan_list['title']; ?>"><img src= "<?php echo base_url($painan_list['cover']);?>" height="280" width="280" class=news-imgthumb ></a>
										 <div class="sm-title"><?php echo character_limiter($painan_list['text'], 5); ?></div>
									</div>
								</td>
								<?php if ($index % 2 != 0): ?>
									</tr><tr>
								<?php endif; ?>
							<?php endforeach; ?>
						</tr>
                        <?php else: ?>
                        <tr>
                            <td colspan="4">No news available.</td>
                        </tr>
                        <?php endif; ?>
					  
                    </tbody>
                </table>
				<?php endif; ?>
            </div>
        </div>
    
	<br>
    <?php echo $this->pagination->create_links(); 
	?>
	<br>
	<br>

<button onclick="topFunction()" id="myBtn" title="Go to top">Ûp</button>

    <script>
        $(document).ready(function() {
            // When the user scrolls down 20px from the top of the document, show the button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 20) {
                    $('#myBtn').fadeIn();
                } else {
                    $('#myBtn').fadeOut();
                }
            });

            // When the user clicks on the button, scroll to the top of the document
            $('#myBtn').click(function() {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });
        });

	// for expand and collapse below navbar
	 shiftBelowSlide();

    </script>




	
