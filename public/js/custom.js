// :: Menu Active Code
$('#menuIcon').on('click', function () {
	$('body').toggleClass('menu-open');
});
$('.closeIcon').on('click', function () {
	$('body').removeClass('menu-open');
});
// :: PreventDefault a Click
$("a[href='#']").on('click', function ($) {
	$.preventDefault();
});

//Function for checker snack bar
function checkerSnackbar() {
	// Get the snackbar DIV
	var x = document.getElementById("checker");

	// Add the "show" class to DIV
	x.className = "show";

	// After 3 seconds, remove the show class from DIV
	setTimeout(function () {
		x.className = x.className.replace("show", "");
	}, 3000);
}

//Function for snack bar
function loveSnackbar() {
	// Get the snackbar DIV
	var x = document.getElementById("loveSnackbar");

	// Add the "show" class to DIV
	x.className = "show";

	// After 3 seconds, remove the show class from DIV
	setTimeout(function () {
		x.className = x.className.replace("show", "");
	}, 3000);
}

//Function for snack bar
function unloveSnackbar() {
	// Get the snackbar DIV
	var x = document.getElementById("unloveSnackbar");

	// Add the "show" class to DIV
	x.className = "show";

	// After 3 seconds, remove the show class from DIV
	setTimeout(function () {
		x.className = x.className.replace("show", "");
	}, 3000);
}

// Jquery to make entire rows clickable 
jQuery(document).ready(function ($) {
	$(".clickable-row").click(function () {
		window.location = $(this).data("href");
	});
});
//place class="clickable" on intended clickable row and data-ref="Play_Video.php?vsong_id=$vsong_id"

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function genreFunction() {
	document.getElementById("genreDropdown").classList.toggle("show");
}

//functions to ensure poll parameters are input in the correct order
function inputPara2() {
	document.getElementById("para-2").innerHTML =
		"<input type='text' name='poll_2' class='form-control' placeholder='Parameter 2' oninput='inputPara3()'>";
}

function inputPara3() {
	document.getElementById("para-3").innerHTML =
		"<input type='text' name='poll_3' class='form-control' placeholder='Parameter 3' oninput='inputPara4()'>"
}

function inputPara4() {
	document.getElementById("para-4").innerHTML =
		"<input type='text' name='poll_4' class='form-control' placeholder='Parameter 4' oninput='inputPara5()'>";
}

function inputPara5() {
	document.getElementById("para-5").innerHTML =
		"<input type='text' name='poll_5' class='form-control' placeholder='Parameter 5'>"
}

//script to prevent entry of white spaces
function AvoidSpace(event) {
	var k = event ? event.which : window.event.keyCode;
	if (k == 32) return false;
}

//Function to copy text
function copyText() {
	var copyText = document.getElementById("myInput");
	copyText.select();
	copyText.setSelectionRange(0, 99999);
	document.execCommand("copy");
}

//Register service worker
if ('serviceWorker' in navigator) {
	navigator.serviceWorker.register('/sw.js')
		.then((reg) => console.log('Service worker registered', reg))
		.catch((err) => console.log('Service worker not registered', err));
}