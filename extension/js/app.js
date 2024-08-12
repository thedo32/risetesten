// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		mybutton.style.display = "block";
	} else {
		mybutton.style.display = "none";
	}
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}


//function for header slider
function showSlides() {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("dot");
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}
	slideIndex++;
	if (slideIndex > slides.length) { slideIndex = 1 }
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace("active", "");
	}
	slides[slideIndex - 1].style.display = "block";
	setTimeout(showSlides, 6000); // Change image every 6 seconds
}


//function for pop_up_slider
function showSlidesPop() {
	for (var i = 0; i < slidesPop.length; i++) {
		slidesPop[i].style.display = "none";
	}
	slidePopIndex++;
	if (slidePopIndex > slidesPop.length) { slidePopIndex = 1 }
	fadeInOut(slidesPop[slidePopIndex - 1]);
	setTimeout(showSlidesPop, 10000); // Change image every 10 seconds
}

function currentSlidePop(n) {
	slidePopIndex = n;
	showSlidePop(slidePopIndex);
}

function showSlidePop(n) {
	if (n > slidesPop.length) { slidePopIndex = 1 }
	if (n < 1) { slidePopIndex = slidesPop.length }
	for (var i = 0; i < slidesPop.length; i++) {
		slidesPop[i].style.display = "none";
	}
	fadeInOut(slidesPop[slidePopIndex - 1]);
}

function plusSlidesPop(n) {
	showSlidePop(slidePopIndex += n);
}




//function for image_slider
function showSlidesImg() {
	for (var i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}
	slideImgIndex++;
	if (slideImgIndex > slides.length) { slideImgIndex = 1 }
	fadeInOut(slides[slideImgIndex - 1]);
	setTimeout(showSlidesImg, 13000); // Change image every 13 seconds
}

function currentSlide(n) {
	slideImgIndex = n;
	showSlideImg(slideImgIndex);
}

function showSlideImg(n) {
	if (n > slides.length) { slideImgIndex = 1 }
	if (n < 1) { slideImgIndex = slides.length }
	for (var i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}
	fadeInOut(slides[slideImgIndex - 1]);
}

function plusSlides(n) {
	showSlideImg(slideImgIndex += n);
}

function fadeInOut(element) {
	var opacity = 0;
	var interval = 10; // Interval for smoother transition
	var duration = 1000; // 1 seconds fade in/out

	element.style.opacity = opacity;
	element.style.display = "block";
	var fadeInOutTimer = setInterval(function () {
		if (opacity >= 1) {
			clearInterval(fadeInOutTimer);
			setTimeout(function () {
				fadeOut(element);
			}, 15000); // Hold the image for 15 seconds before fading out
		}
		element.style.opacity = opacity;
		opacity += interval / duration;
	}, interval);
}


// for expand and collapse below navbar slide
function shiftBelowSlide() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var slideShow = document.querySelector('.slideshow-container');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				slideShow.style.marginTop = '110px';
				fixMenu.style.fontSize = '1em';
			} else {
				slideShow.style.marginTop = 230 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '1.9em';
			}
		});
	});
}


// for expand and collapse below navbar table
function shiftBelowRTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var readTable = document.querySelector('.read-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				readTable.style.marginTop = '150px';
				fixMenu.style.fontSize = '1em';
			} else {
				readTable.style.marginTop = 240 + Navbar.offsetHeight + 'px' // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '1.9em';
			}
		});
	});
}

function shiftBelowRgTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var regTable = document.querySelector('.reg-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				regTable.style.marginTop = '180px';
				fixMenu.style.fontSize = '1em';
			} else {
				regTable.style.marginTop = 240 + Navbar.offsetHeight + 'px' // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '1.9em';
			}
		});
	});
}


function shiftBelowLTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var loginTable = document.querySelector('.login-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				loginTable.style.marginTop = '150px';
				fixMenu.style.fontSize = '1em';
			} else {
				loginTable.style.marginTop = 300 + Navbar.offsetHeight + 'px' // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '1.9em';
			}
		});
	});
}

function shiftBelowHTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var homeTable = document.querySelector('.home-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				homeTable.style.marginTop = '150px';
				fixMenu.style.fontSize = 1 + 'em';
			} else {
				homeTable.style.marginTop = 240 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '1.9em';
			}
		});
	});
}

function shiftBelowUTable() {
	document.addEventListener("DOMContentLoaded", function () {
		var navbarToggler = document.querySelector('.navbar-toggler');
		var userTable = document.querySelector('.user-table');
		var Navbar = document.querySelector('.fix-navbar');
		var fixMenu = document.querySelector('.fix-menu');

		navbarToggler.addEventListener('click', function () {
			if (document.querySelector('.navbar-collapse').classList.contains('show')) {
				userTable.style.marginTop = '150px';
				fixMenu.style.fontSize = 1 + 'em';
			} else {
				userTable.style.marginTop = 260 + Navbar.offsetHeight + 'px'; // Adjust this value based on the height of the navbar when expanded
				fixMenu.style.fontSize = '1.9em';
			}
		});
	});
}


// for pop up image
document.addEventListener('DOMContentLoaded', function () {
	var popup = document.getElementById('popup');
	var closeButton = document.getElementById('close-button');

	closeButton.onclick = function () {
		popup.style.display = 'none';
	}

	window.onclick = function (event) {
		if (event.target == popup) {
			popup.style.display = 'none';
		}
	}
});
