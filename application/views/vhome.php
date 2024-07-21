
        
</head>

<body class="bg-body">
	<div class=fix-navbar>
		<div class=shadowbox><h3>Selamat Datang Di Kupi Batigo</h3></div>
		<a alt="Menara" href="<?php echo base_url('');?>"><img src="/storage/app/public/images/logo/logo.png" width = "128" height = "55"></a>
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
		  	<button class=" table navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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

	<div class=h10> 
		<a href="https://kopibatigo.id/">IDN</a><br>
		<a href="#" class="fa fa-instagram"></a><br>
		<a href="#" class="fa fa-facebook"></a><br>
	</div>

	
	
		<?php if ($this->session->userdata("name") === 'Alpha' ):?>
		<div class = home-table>
			<h6>Hello <a href="<?php echo base_url('home'); ?>">Admin</a></h6>
			<?php $this->load->view('welcome_message');?>
		</div>
		<?php elseif ($this->session->userdata("name") != Null ):?>
		<div class = home-table>
			<h6>Hello <a href="<?php echo base_url('home'); ?>"><?php echo $this->session->userdata("name"); ?></a></h6>
			<?php $this->load->view('welcome_message');?>
		</div>
		<?php else:?>
			<h6>&nbsp;&nbsp;  Please <a href="<?php echo base_url('login'); ?>">Login</a></h6>
			<?php $this->load->view('welcome_guest');?>
		<?php endif; ?>
	</div>
	
	<?php 
		$this->load->view('image_slider');
	?>
	
	<br>
	<div class=slideshow-container-art>  
	  <div class=articlebox>		
		<center><h6>About Desa Wisata Teluk Buo:</h6></center>
		Located in Kelurahan Teluk Kabung Tengah, Kecamatan Bungus Teluk Kabung, Kota Padang, Province of West Sumatra, Indonesia.<br>
		<strong>Desa Wisata Teluk Buo made it to the top 100 of the Anugerah Desa Wisata Indonesia (ADWI) in 2024.</strong><br>
		The combination of white sand and green mangrove forests is so perfect, making it an attractive destination for tourists.<br>
		This charming marine tourism area is hidden behind the rock cliffs of Teluk Buo.<br>
		The diversity of mangrove forests makes it a refreshing Mangrove Ecotourism destination.<br>
		<strong>The types of mangroves in this location are:</strong><br>
		Rhizophora apiculata, Sonneratia alba, Avicennia corniculatum, Bruguiera gymnorhiza, and Xylocarpus granatum.<br>
		Desa Wisata Teluk Buo also has interesting fishing activities to watch.<br>
		<strong>Main attractions:</strong><br>
		A beautiful bay and white sandy beaches, Mangrove Ecotourism, Fishing activities, Swimming, snorkeling, and fishing, as well as Local culinary specialties.<br>
		<strong>How to get there:</strong><br>
		Desa Wisata Teluk Buo is located about 30 kilometers from the center of Padang City, accessible by public transportation or by renting a car.<br>
		<strong>Accommodation:</strong><br>
		There are several homestays and guest houses available in Desa Wisata Teluk Buo, including Homestay and Camping Ground Kupibatigo Taluak Buo.<br>
		<strong>Tips:</strong><br>
		Bring sunscreen, mosquito repellent lotion, and a hat. Don't forget to respect the local culture and environment.
	  </div>
    </div>

	<?php 
		$this->load->view('post_container');
	?>


	<button onclick="topFunction()" id="myBtn" title="Go to top">Ûp</button>

    <script>
		// for go to top button
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
