// JavaScript
/**
 * WordPress uses jQuery with compatibility mode. This requires using 
 * the 'jQuery' selector instead of the more standard '$'
 * the following self-referencing function allows for jquery 
 * to function using the standard selector again.
 */
(function($) {

	
	// MatchHeight courses on front-page
	$(function() {
    $('.front-panel').matchHeight();
	});
	
})( jQuery );

// Scroll Reveal
// https://github.com/jlmakes/scrollreveal/blob/master/README.md
window.sr = ScrollReveal();
sr.reveal('.front-panel');
