(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/css/app.scss":
/*!*****************************!*\
  !*** ./assets/css/app.scss ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/js/admin.js":
/*!****************************!*\
  !*** ./assets/js/admin.js ***!
  \****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var bloodhound_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bloodhound-js */ "./node_modules/bloodhound-js/index.js");
/* harmony import */ var bloodhound_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(bloodhound_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var bootstrap_tagsinput__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! bootstrap-tagsinput */ "./node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.js");
/* harmony import */ var bootstrap_tagsinput__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(bootstrap_tagsinput__WEBPACK_IMPORTED_MODULE_1__);


$(function () {
  // Bootstrap-tagsinput initialization
  // http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/
  var $input = $('input[data-toggle="tagsinput"]');

  if ($input.length) {
    var source = new bloodhound_js__WEBPACK_IMPORTED_MODULE_0___default.a({
      local: $input.data('tags'),
      queryTokenizer: bloodhound_js__WEBPACK_IMPORTED_MODULE_0___default.a.tokenizers.whitespace,
      datumTokenizer: bloodhound_js__WEBPACK_IMPORTED_MODULE_0___default.a.tokenizers.whitespace
    });
    source.initialize();
    $input.tagsinput({
      trimValue: true,
      focusClass: 'focus',
      typeaheadjs: {
        name: 'tags',
        source: source.ttAdapter()
      }
    });
  }
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(global) {/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../css/app.scss */ "./assets/css/app.scss");
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_css_app_scss__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _sb_admin__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sb-admin */ "./assets/js/sb-admin.js");
/* harmony import */ var _sb_admin__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_sb_admin__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _flowForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./flowForm */ "./assets/js/flowForm.js");
/* harmony import */ var _flowForm__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_flowForm__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _admin__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./admin */ "./assets/js/admin.js");
/* harmony import */ var _sp_menu__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./sp-menu */ "./assets/js/sp-menu.js");
/* harmony import */ var _sp_menu__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_sp_menu__WEBPACK_IMPORTED_MODULE_4__);
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you require will output into a single css file (app.css in this case)
 // Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

global.$ = global.jQuery = $;

__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");

console.log('Hello Webpack Encore');
$(document).ready(function () {
  $('[data-toggle="popover"]').popover();
});




/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./assets/js/flowForm.js":
/*!*******************************!*\
  !*** ./assets/js/flowForm.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($, jQuery) {var $collectionHolder; // setup an "add a flow" link

var $addFlowButton = $('<button type="button" class="add_flow_link btn btn-light btn-sm">Add a Flow</button>');
var $newLinkLi = $('<div></div>').append($addFlowButton);
jQuery(document).ready(function () {
  // Get the ul that holds the collection of flows
  $collectionHolder = $('div#my_event_myEventFlows');
  $collectionHolder.find('div.flow-list').each(function () {
    addFlowFormDeleteLink($(this));
  }); // add the "add a tasks" anchor and li to the tasks ul

  $collectionHolder.append($newLinkLi); // count the current form inputs we have (e.g. 2), use that as the new
  // index when inserting a new item (e.g. 2)

  $collectionHolder.data('index', $collectionHolder.find(':input').length);
  $addFlowButton.on('click', function (e) {
    // add a new flow form (see next code block)
    addFlowForm($collectionHolder, $newLinkLi);
  });
});

function addFlowForm($collectionHolder, $newLinkLi) {
  // Get the data-prototype explained earlier
  var prototype = $collectionHolder.data('prototype'); // get the new index

  var index = $collectionHolder.data('index'); // Replace '$$name$$' in the prototype's HTML to
  // instead be a number based on how many items we have

  var newForm = prototype.replace(/__name__/g, index); // increase the index with one for the next item

  $collectionHolder.data('index', index + 1); // Display the form in the page in an li, before the "Add a flow" link li

  var $newFormLi = $('<div class="flow-list"></div>').append(newForm); // also add a remove button, just for this example

  $newFormLi.append('<a href="#" class="remove-flow">x</a>');
  $newLinkLi.before($newFormLi); // handle the removal, just for this example

  $('.remove-flow').click(function (e) {
    e.preventDefault();
    $(this).parent().remove();
    return false;
  });
}

function addFlowFormDeleteLink($flowFormLi) {
  var $removeFormButton = $('<button type="button btn btn-light btn-sm">Delete this flow</button>');
  $flowFormLi.append($removeFormButton);
  $removeFormButton.on('click', function (e) {
    // remove the li for the flow form
    $FlowFormLi.remove();
  });
}
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"), __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/sb-admin.js":
/*!*******************************!*\
  !*** ./assets/js/sb-admin.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict"; // Start of use strict
  // Toggle the side navigation

  $("#sidebarToggle").on('click', function (e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
  }); // Prevent the content wrapper from scrolling when the fixed side navigation hovered over

  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  }); // Scroll to top button appear

  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();

    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  }); // Smooth scrolling using jQuery easing

  $(document).on('click', 'a.scroll-to-top', function (event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });
})(jQuery); // End of use strict
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/sp-menu.js":
/*!******************************!*\
  !*** ./assets/js/sp-menu.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(function () {
  $('.sw-Nav_OpenBtn').on('click', function () {
    $('html').toggleClass('menu-opend');
    $(this).toggleClass('open');
    $('.sw-Nav_Side').toggleClass('open-side');
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 2:
/*!***********************!*\
  !*** vertx (ignored) ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ })

},[["./assets/js/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9hZG1pbi5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9mbG93Rm9ybS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvc2ItYWRtaW4uanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3NwLW1lbnUuanMiLCJ3ZWJwYWNrOi8vL3ZlcnR4IChpZ25vcmVkKSJdLCJuYW1lcyI6WyIkIiwiJGlucHV0IiwibGVuZ3RoIiwic291cmNlIiwiQmxvb2Rob3VuZCIsImxvY2FsIiwiZGF0YSIsInF1ZXJ5VG9rZW5pemVyIiwidG9rZW5pemVycyIsIndoaXRlc3BhY2UiLCJkYXR1bVRva2VuaXplciIsImluaXRpYWxpemUiLCJ0YWdzaW5wdXQiLCJ0cmltVmFsdWUiLCJmb2N1c0NsYXNzIiwidHlwZWFoZWFkanMiLCJuYW1lIiwidHRBZGFwdGVyIiwicmVxdWlyZSIsImdsb2JhbCIsImpRdWVyeSIsImNvbnNvbGUiLCJsb2ciLCJkb2N1bWVudCIsInJlYWR5IiwicG9wb3ZlciIsIiRjb2xsZWN0aW9uSG9sZGVyIiwiJGFkZEZsb3dCdXR0b24iLCIkbmV3TGlua0xpIiwiYXBwZW5kIiwiZmluZCIsImVhY2giLCJhZGRGbG93Rm9ybURlbGV0ZUxpbmsiLCJvbiIsImUiLCJhZGRGbG93Rm9ybSIsInByb3RvdHlwZSIsImluZGV4IiwibmV3Rm9ybSIsInJlcGxhY2UiLCIkbmV3Rm9ybUxpIiwiYmVmb3JlIiwiY2xpY2siLCJwcmV2ZW50RGVmYXVsdCIsInBhcmVudCIsInJlbW92ZSIsIiRmbG93Rm9ybUxpIiwiJHJlbW92ZUZvcm1CdXR0b24iLCIkRmxvd0Zvcm1MaSIsInRvZ2dsZUNsYXNzIiwid2luZG93Iiwid2lkdGgiLCJlMCIsIm9yaWdpbmFsRXZlbnQiLCJkZWx0YSIsIndoZWVsRGVsdGEiLCJkZXRhaWwiLCJzY3JvbGxUb3AiLCJzY3JvbGxEaXN0YW5jZSIsImZhZGVJbiIsImZhZGVPdXQiLCJldmVudCIsIiRhbmNob3IiLCJzdG9wIiwiYW5pbWF0ZSIsImF0dHIiLCJvZmZzZXQiLCJ0b3AiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7OztBQUFBLHVDOzs7Ozs7Ozs7Ozs7QUNBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFDQTtBQUVBQSxDQUFDLENBQUMsWUFBVztBQUNUO0FBQ0E7QUFDQSxNQUFJQyxNQUFNLEdBQUdELENBQUMsQ0FBQyxnQ0FBRCxDQUFkOztBQUNBLE1BQUlDLE1BQU0sQ0FBQ0MsTUFBWCxFQUFtQjtBQUNmLFFBQUlDLE1BQU0sR0FBRyxJQUFJQyxvREFBSixDQUFlO0FBQ3hCQyxXQUFLLEVBQUVKLE1BQU0sQ0FBQ0ssSUFBUCxDQUFZLE1BQVosQ0FEaUI7QUFFeEJDLG9CQUFjLEVBQUVILG9EQUFVLENBQUNJLFVBQVgsQ0FBc0JDLFVBRmQ7QUFHeEJDLG9CQUFjLEVBQUVOLG9EQUFVLENBQUNJLFVBQVgsQ0FBc0JDO0FBSGQsS0FBZixDQUFiO0FBS0FOLFVBQU0sQ0FBQ1EsVUFBUDtBQUVBVixVQUFNLENBQUNXLFNBQVAsQ0FBaUI7QUFDYkMsZUFBUyxFQUFFLElBREU7QUFFYkMsZ0JBQVUsRUFBRSxPQUZDO0FBR2JDLGlCQUFXLEVBQUU7QUFDVEMsWUFBSSxFQUFFLE1BREc7QUFFVGIsY0FBTSxFQUFFQSxNQUFNLENBQUNjLFNBQVA7QUFGQztBQUhBLEtBQWpCO0FBUUg7QUFDSixDQXJCQSxDQUFELEM7Ozs7Ozs7Ozs7Ozs7QUNIQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBOzs7Ozs7QUFPQTtDQUdBO0FBQ0E7QUFFQTs7QUFDQSxJQUFNakIsQ0FBQyxHQUFHa0IsbUJBQU8sQ0FBQyxvREFBRCxDQUFqQjs7QUFDQUMsTUFBTSxDQUFDbkIsQ0FBUCxHQUFXbUIsTUFBTSxDQUFDQyxNQUFQLEdBQWdCcEIsQ0FBM0I7O0FBRUFrQixt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QUNEO0FBQ0YsR0FQRCxFQXJCVyxDQThCWDs7QUFDQTVELEdBQUMsQ0FBQ3VCLFFBQUQsQ0FBRCxDQUFZVSxFQUFaLENBQWUsT0FBZixFQUF3QixpQkFBeEIsRUFBMkMsVUFBUzRCLEtBQVQsRUFBZ0I7QUFDekQsUUFBSUMsT0FBTyxHQUFHOUQsQ0FBQyxDQUFDLElBQUQsQ0FBZjtBQUNBQSxLQUFDLENBQUMsWUFBRCxDQUFELENBQWdCK0QsSUFBaEIsR0FBdUJDLE9BQXZCLENBQStCO0FBQzdCUCxlQUFTLEVBQUd6RCxDQUFDLENBQUM4RCxPQUFPLENBQUNHLElBQVIsQ0FBYSxNQUFiLENBQUQsQ0FBRCxDQUF3QkMsTUFBeEIsR0FBaUNDO0FBRGhCLEtBQS9CLEVBRUcsSUFGSCxFQUVTLGVBRlQ7QUFHQU4sU0FBSyxDQUFDbEIsY0FBTjtBQUNELEdBTkQ7QUFRRCxDQXZDRCxFQXVDR3ZCLE1BdkNILEUsQ0F1Q1ksb0I7Ozs7Ozs7Ozs7OztBQ3ZDWnBCLDBDQUFDLENBQUMsWUFBVztBQUNUQSxHQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQmlDLEVBQXJCLENBQXdCLE9BQXhCLEVBQWlDLFlBQVk7QUFDekNqQyxLQUFDLENBQUMsTUFBRCxDQUFELENBQVVpRCxXQUFWLENBQXNCLFlBQXRCO0FBQ0FqRCxLQUFDLENBQUMsSUFBRCxDQUFELENBQVFpRCxXQUFSLENBQW9CLE1BQXBCO0FBQ0FqRCxLQUFDLENBQUMsY0FBRCxDQUFELENBQWtCaUQsV0FBbEIsQ0FBOEIsV0FBOUI7QUFDSCxHQUpEO0FBS0gsQ0FOQSxDQUFELEM7Ozs7Ozs7Ozs7OztBQ0FBLGUiLCJmaWxlIjoiYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIiwiaW1wb3J0IEJsb29kaG91bmQgZnJvbSBcImJsb29kaG91bmQtanNcIjtcbmltcG9ydCBcImJvb3RzdHJhcC10YWdzaW5wdXRcIjtcblxuJChmdW5jdGlvbigpIHtcbiAgICAvLyBCb290c3RyYXAtdGFnc2lucHV0IGluaXRpYWxpemF0aW9uXG4gICAgLy8gaHR0cDovL2Jvb3RzdHJhcC10YWdzaW5wdXQuZ2l0aHViLmlvL2Jvb3RzdHJhcC10YWdzaW5wdXQvZXhhbXBsZXMvXG4gICAgdmFyICRpbnB1dCA9ICQoJ2lucHV0W2RhdGEtdG9nZ2xlPVwidGFnc2lucHV0XCJdJyk7XG4gICAgaWYgKCRpbnB1dC5sZW5ndGgpIHtcbiAgICAgICAgdmFyIHNvdXJjZSA9IG5ldyBCbG9vZGhvdW5kKHtcbiAgICAgICAgICAgIGxvY2FsOiAkaW5wdXQuZGF0YSgndGFncycpLFxuICAgICAgICAgICAgcXVlcnlUb2tlbml6ZXI6IEJsb29kaG91bmQudG9rZW5pemVycy53aGl0ZXNwYWNlLFxuICAgICAgICAgICAgZGF0dW1Ub2tlbml6ZXI6IEJsb29kaG91bmQudG9rZW5pemVycy53aGl0ZXNwYWNlXG4gICAgICAgIH0pO1xuICAgICAgICBzb3VyY2UuaW5pdGlhbGl6ZSgpO1xuXG4gICAgICAgICRpbnB1dC50YWdzaW5wdXQoe1xuICAgICAgICAgICAgdHJpbVZhbHVlOiB0cnVlLFxuICAgICAgICAgICAgZm9jdXNDbGFzczogJ2ZvY3VzJyxcbiAgICAgICAgICAgIHR5cGVhaGVhZGpzOiB7XG4gICAgICAgICAgICAgICAgbmFtZTogJ3RhZ3MnLFxuICAgICAgICAgICAgICAgIHNvdXJjZTogc291cmNlLnR0QWRhcHRlcigpXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cbn0pO1xuIiwiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IHJlcXVpcmUgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4uL2Nzcy9hcHAuc2Nzcyc7XG5cbi8vIE5lZWQgalF1ZXJ5PyBJbnN0YWxsIGl0IHdpdGggXCJ5YXJuIGFkZCBqcXVlcnlcIiwgdGhlbiB1bmNvbW1lbnQgdG8gcmVxdWlyZSBpdC5cbi8vIGNvbnN0ICQgPSByZXF1aXJlKCdqcXVlcnknKTtcblxuLy8gY29uc29sZS5sb2coJ0hlbGxvIFdlYnBhY2sgRW5jb3JlISBFZGl0IG1lIGluIGFzc2V0cy9qcy9hcHAuanMnKTtcbmNvbnN0ICQgPSByZXF1aXJlKCdqcXVlcnknKTtcbmdsb2JhbC4kID0gZ2xvYmFsLmpRdWVyeSA9ICQ7XG5cbnJlcXVpcmUoJ2Jvb3RzdHJhcCcpO1xuXG5jb25zb2xlLmxvZygnSGVsbG8gV2VicGFjayBFbmNvcmUnKTtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgJCgnW2RhdGEtdG9nZ2xlPVwicG9wb3ZlclwiXScpLnBvcG92ZXIoKTtcbn0pO1xuXG5pbXBvcnQgJy4vc2ItYWRtaW4nO1xuaW1wb3J0ICcuL2Zsb3dGb3JtJztcbmltcG9ydCAnLi9hZG1pbic7XG5pbXBvcnQgJy4vc3AtbWVudSc7IiwidmFyICRjb2xsZWN0aW9uSG9sZGVyO1xuXG4vLyBzZXR1cCBhbiBcImFkZCBhIGZsb3dcIiBsaW5rXG52YXIgJGFkZEZsb3dCdXR0b24gPSAkKCc8YnV0dG9uIHR5cGU9XCJidXR0b25cIiBjbGFzcz1cImFkZF9mbG93X2xpbmsgYnRuIGJ0bi1saWdodCBidG4tc21cIj5BZGQgYSBGbG93PC9idXR0b24+Jyk7XG52YXIgJG5ld0xpbmtMaSA9ICQoJzxkaXY+PC9kaXY+JykuYXBwZW5kKCRhZGRGbG93QnV0dG9uKTtcblxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICAvLyBHZXQgdGhlIHVsIHRoYXQgaG9sZHMgdGhlIGNvbGxlY3Rpb24gb2YgZmxvd3NcbiAgICAkY29sbGVjdGlvbkhvbGRlciA9ICQoJ2RpdiNteV9ldmVudF9teUV2ZW50Rmxvd3MnKTtcblxuICAgICRjb2xsZWN0aW9uSG9sZGVyLmZpbmQoJ2Rpdi5mbG93LWxpc3QnKS5lYWNoKGZ1bmN0aW9uKCkge1xuICAgICAgICBhZGRGbG93Rm9ybURlbGV0ZUxpbmsoJCh0aGlzKSk7XG4gICAgfSk7XG4gICAgLy8gYWRkIHRoZSBcImFkZCBhIHRhc2tzXCIgYW5jaG9yIGFuZCBsaSB0byB0aGUgdGFza3MgdWxcbiAgICAkY29sbGVjdGlvbkhvbGRlci5hcHBlbmQoJG5ld0xpbmtMaSk7XG5cbiAgICAvLyBjb3VudCB0aGUgY3VycmVudCBmb3JtIGlucHV0cyB3ZSBoYXZlIChlLmcuIDIpLCB1c2UgdGhhdCBhcyB0aGUgbmV3XG4gICAgLy8gaW5kZXggd2hlbiBpbnNlcnRpbmcgYSBuZXcgaXRlbSAoZS5nLiAyKVxuICAgICRjb2xsZWN0aW9uSG9sZGVyLmRhdGEoJ2luZGV4JywgJGNvbGxlY3Rpb25Ib2xkZXIuZmluZCgnOmlucHV0JykubGVuZ3RoKTtcblxuICAgICRhZGRGbG93QnV0dG9uLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgLy8gYWRkIGEgbmV3IGZsb3cgZm9ybSAoc2VlIG5leHQgY29kZSBibG9jaylcbiAgICAgICAgYWRkRmxvd0Zvcm0oJGNvbGxlY3Rpb25Ib2xkZXIsICRuZXdMaW5rTGkpO1xuICAgIH0pO1xufSk7XG5cbmZ1bmN0aW9uIGFkZEZsb3dGb3JtKCRjb2xsZWN0aW9uSG9sZGVyLCAkbmV3TGlua0xpKSB7XG4gICAgLy8gR2V0IHRoZSBkYXRhLXByb3RvdHlwZSBleHBsYWluZWQgZWFybGllclxuICAgIHZhciBwcm90b3R5cGUgPSAkY29sbGVjdGlvbkhvbGRlci5kYXRhKCdwcm90b3R5cGUnKTtcbiAgICBcbiAgICAvLyBnZXQgdGhlIG5ldyBpbmRleFxuICAgIHZhciBpbmRleCA9ICRjb2xsZWN0aW9uSG9sZGVyLmRhdGEoJ2luZGV4Jyk7XG4gICAgXG4gICAgLy8gUmVwbGFjZSAnJCRuYW1lJCQnIGluIHRoZSBwcm90b3R5cGUncyBIVE1MIHRvXG4gICAgLy8gaW5zdGVhZCBiZSBhIG51bWJlciBiYXNlZCBvbiBob3cgbWFueSBpdGVtcyB3ZSBoYXZlXG4gICAgdmFyIG5ld0Zvcm0gPSBwcm90b3R5cGUucmVwbGFjZSgvX19uYW1lX18vZywgaW5kZXgpO1xuICAgIFxuICAgIC8vIGluY3JlYXNlIHRoZSBpbmRleCB3aXRoIG9uZSBmb3IgdGhlIG5leHQgaXRlbVxuICAgICRjb2xsZWN0aW9uSG9sZGVyLmRhdGEoJ2luZGV4JywgaW5kZXggKyAxKTtcbiAgICBcbiAgICAvLyBEaXNwbGF5IHRoZSBmb3JtIGluIHRoZSBwYWdlIGluIGFuIGxpLCBiZWZvcmUgdGhlIFwiQWRkIGEgZmxvd1wiIGxpbmsgbGlcbiAgICB2YXIgJG5ld0Zvcm1MaSA9ICQoJzxkaXYgY2xhc3M9XCJmbG93LWxpc3RcIj48L2Rpdj4nKS5hcHBlbmQobmV3Rm9ybSk7XG4gICAgXG4gICAgLy8gYWxzbyBhZGQgYSByZW1vdmUgYnV0dG9uLCBqdXN0IGZvciB0aGlzIGV4YW1wbGVcbiAgICAkbmV3Rm9ybUxpLmFwcGVuZCgnPGEgaHJlZj1cIiNcIiBjbGFzcz1cInJlbW92ZS1mbG93XCI+eDwvYT4nKTtcbiAgICBcbiAgICAkbmV3TGlua0xpLmJlZm9yZSgkbmV3Rm9ybUxpKTtcbiAgICBcbiAgICAvLyBoYW5kbGUgdGhlIHJlbW92YWwsIGp1c3QgZm9yIHRoaXMgZXhhbXBsZVxuICAgICQoJy5yZW1vdmUtZmxvdycpLmNsaWNrKGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5yZW1vdmUoKTtcbiAgICAgICAgXG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9KTtcbn1cblxuZnVuY3Rpb24gYWRkRmxvd0Zvcm1EZWxldGVMaW5rKCRmbG93Rm9ybUxpKSB7XG4gICAgdmFyICRyZW1vdmVGb3JtQnV0dG9uID0gJCgnPGJ1dHRvbiB0eXBlPVwiYnV0dG9uIGJ0biBidG4tbGlnaHQgYnRuLXNtXCI+RGVsZXRlIHRoaXMgZmxvdzwvYnV0dG9uPicpO1xuICAgICRmbG93Rm9ybUxpLmFwcGVuZCgkcmVtb3ZlRm9ybUJ1dHRvbik7XG5cbiAgICAkcmVtb3ZlRm9ybUJ1dHRvbi5vbignY2xpY2snLCBmdW5jdGlvbihlKSB7XG4gICAgICAgIC8vIHJlbW92ZSB0aGUgbGkgZm9yIHRoZSBmbG93IGZvcm1cbiAgICAgICAgJEZsb3dGb3JtTGkucmVtb3ZlKCk7XG4gICAgfSk7XG59IiwiKGZ1bmN0aW9uKCQpIHtcbiAgXCJ1c2Ugc3RyaWN0XCI7IC8vIFN0YXJ0IG9mIHVzZSBzdHJpY3RcblxuICAvLyBUb2dnbGUgdGhlIHNpZGUgbmF2aWdhdGlvblxuICAkKFwiI3NpZGViYXJUb2dnbGVcIikub24oJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAkKFwiYm9keVwiKS50b2dnbGVDbGFzcyhcInNpZGViYXItdG9nZ2xlZFwiKTtcbiAgICAkKFwiLnNpZGViYXJcIikudG9nZ2xlQ2xhc3MoXCJ0b2dnbGVkXCIpO1xuICB9KTtcblxuICAvLyBQcmV2ZW50IHRoZSBjb250ZW50IHdyYXBwZXIgZnJvbSBzY3JvbGxpbmcgd2hlbiB0aGUgZml4ZWQgc2lkZSBuYXZpZ2F0aW9uIGhvdmVyZWQgb3ZlclxuICAkKCdib2R5LmZpeGVkLW5hdiAuc2lkZWJhcicpLm9uKCdtb3VzZXdoZWVsIERPTU1vdXNlU2Nyb2xsIHdoZWVsJywgZnVuY3Rpb24oZSkge1xuICAgIGlmICgkKHdpbmRvdykud2lkdGgoKSA+IDc2OCkge1xuICAgICAgdmFyIGUwID0gZS5vcmlnaW5hbEV2ZW50LFxuICAgICAgICBkZWx0YSA9IGUwLndoZWVsRGVsdGEgfHwgLWUwLmRldGFpbDtcbiAgICAgIHRoaXMuc2Nyb2xsVG9wICs9IChkZWx0YSA8IDAgPyAxIDogLTEpICogMzA7XG4gICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgfVxuICB9KTtcblxuICAvLyBTY3JvbGwgdG8gdG9wIGJ1dHRvbiBhcHBlYXJcbiAgJChkb2N1bWVudCkub24oJ3Njcm9sbCcsIGZ1bmN0aW9uKCkge1xuICAgIHZhciBzY3JvbGxEaXN0YW5jZSA9ICQodGhpcykuc2Nyb2xsVG9wKCk7XG4gICAgaWYgKHNjcm9sbERpc3RhbmNlID4gMTAwKSB7XG4gICAgICAkKCcuc2Nyb2xsLXRvLXRvcCcpLmZhZGVJbigpO1xuICAgIH0gZWxzZSB7XG4gICAgICAkKCcuc2Nyb2xsLXRvLXRvcCcpLmZhZGVPdXQoKTtcbiAgICB9XG4gIH0pO1xuXG4gIC8vIFNtb290aCBzY3JvbGxpbmcgdXNpbmcgalF1ZXJ5IGVhc2luZ1xuICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnYS5zY3JvbGwtdG8tdG9wJywgZnVuY3Rpb24oZXZlbnQpIHtcbiAgICB2YXIgJGFuY2hvciA9ICQodGhpcyk7XG4gICAgJCgnaHRtbCwgYm9keScpLnN0b3AoKS5hbmltYXRlKHtcbiAgICAgIHNjcm9sbFRvcDogKCQoJGFuY2hvci5hdHRyKCdocmVmJykpLm9mZnNldCgpLnRvcClcbiAgICB9LCAxMDAwLCAnZWFzZUluT3V0RXhwbycpO1xuICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gIH0pO1xuXG59KShqUXVlcnkpOyAvLyBFbmQgb2YgdXNlIHN0cmljdFxuIiwiJChmdW5jdGlvbigpIHtcbiAgICAkKCcuc3ctTmF2X09wZW5CdG4nKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJ2h0bWwnKS50b2dnbGVDbGFzcygnbWVudS1vcGVuZCcpO1xuICAgICAgICAkKHRoaXMpLnRvZ2dsZUNsYXNzKCdvcGVuJyk7XG4gICAgICAgICQoJy5zdy1OYXZfU2lkZScpLnRvZ2dsZUNsYXNzKCdvcGVuLXNpZGUnKTtcbiAgICB9KTtcbn0pOyIsIi8qIChpZ25vcmVkKSAqLyJdLCJzb3VyY2VSb290IjoiIn0=