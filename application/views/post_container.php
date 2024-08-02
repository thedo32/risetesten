	<?php if ($this->session->userdata("name") === Null):
		$name = " ";
	else:
		$name = $this->session->userdata("name");
	endif; 
	
	
	$whatsappLink = "https://wa.me/62811663504?text=" . urlencode("Hello Kupi Batigo, I am $name interested in asking for more details");

	?>




<div class=post-container-1>
		<p><p><br><div class=h9>Contact Person:</div>
</div>
<div class=post-container-2>
		<div class=sidepostboxsmall> <a href="<?php echo $whatsappLink; ?>" target=_blank>
			<img src="/storage/app/public/images/logo/walogo.png" alt="Cover Image">
		</a></div><br><br>
</div>
<div class=post-container-3>
	<iframe width="620" height="240" src="https://www.youtube.com/embed/mB-BYM-Rl9w?si=cgVjgHwlnjSv3lxR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
<div class=post-container-4>
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d498.6407428353693!2d100.38496897942254!3d-1.0674286968005176!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4a57a23103a87%3A0x7034718ca6f2dd15!2sDesa%20Wisata%20Teluk%20Buo!5e0!3m2!1sen!2sid!4v1718351009418!5m2!1sen!2sid" width="640" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
