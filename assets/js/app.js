/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
// require('../css/app.css');
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');


var accordion = document.getElementsByClassName("footer-accordion");
var i;

for (i = 0; i < accordion.length; i++) {
  accordion[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $(".sw-Wrapper").toggleClass("toggled");
  $(".sw-Wrapper_Inner").toggleClass("sw-Wrapper_MenuView");
  $('body').toggleClass("sw-Wrapper_MenuOpen");
});