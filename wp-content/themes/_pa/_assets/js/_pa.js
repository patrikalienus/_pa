/**
 * When document is loaded...
 * 
 * This file is JUST for loading components from components.js.
 */
$(document).ready(function() {
	/**
	 * Navigation Menu Slider
	 */
	$('#nav-expander').on('click', function(e) {
		e.preventDefault();
		$('body').toggleClass('nav-expanded');
	});
	$('#nav-close').on('click', function(e) {
		e.preventDefault();
		$('body').removeClass('nav-expanded');
	});

	// Initialize navgoco with default options
	$(".main-menu").navgoco({
		caret: '<span class="caret"></span>',
		accordion: false,
		openClass: 'open',
		save: true,
		cookie: {
			name: 'navgoco',
			expires: false,
			path: '/'
		},
		slide: {
			duration: 300,
			easing: 'swing'
		}
	});
});
