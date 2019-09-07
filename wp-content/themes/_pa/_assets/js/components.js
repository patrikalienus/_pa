/**
 * 
 * Combining all javascript components using Codekit to decrease HTTP requests.
 * Why Codekit and not Gulp or WebPack? Because I like to maintain a simple life.
 * I don't give two dead rats about the 'bragging rights' that comes from 
 * using *gasp* the command line (queue impressed screams).
 * 
 * The day your beloved NPM throws an error, you morons will have no clue what 
 * to do and you'll come crying "my computer is broken". No it isn't, you're just
 * not knowledgeable enough to fix your problems. I am for the most post, but
 * I also value my time a lot higher than what using NPM would warrant.
 * 
 * I've compiled Linux kernels on 700 MHz processors before multi-core was even
 * a conceivable notion. I was scripting bash before .bashrc was a thing. I've
 * seen some shit.
 * 
 * And god damnit if I'm gonna let the terminal rule my life forever.
 * 
 */

//

// @codekit-append quiet "../node_modules/jquery-migrate/dist/jquery-migrate.min.js";
// @codekit-append quiet "../node_modules/bootstrap/dist/js/bootstrap.min.js";
// @codekit-append quiet "../node_modules/tooltip.js/dist/umd/tooltip.min.js";
// @codekit-append quiet "../_components/superembed.js";


/**
 * Currently disabled as not yet implemented.
 */
// codekit-append quiet "../node_modules/popper.js/dist/popper.min.js"; // This doesn't have to be included because tooltip.min.js does it for me.
// codekit-append quiet "../js/navgoco.js";
// codekit-append quiet "../_components/lazyload.js";
// codekit-append quiet "../_components/Cleave.js-master/dist/cleave.js";
// codekit-append quiet "../_components/jquery.shave.js";
// codekit-append quiet "../_components/fancybox/jquery.fancybox.js";
// codekit-append quiet "../_components/scrollreveal.js";
// codekit-append quiet "../_components/superembed.js";
