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
/* harmony import */ var _myDetail__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./myDetail */ "./assets/js/myDetail.js");
/* harmony import */ var _myDetail__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_myDetail__WEBPACK_IMPORTED_MODULE_5__);
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

/***/ "./assets/js/myDetail.js":
/*!*******************************!*\
  !*** ./assets/js/myDetail.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(function () {
  $(".me-About_ContentShow").click(function () {
    var show_text = $(this).parent(".me-About_Content").find(".me-About_ContentText");
    var small_height = 200; //This is initial height.

    var original_height = show_text.css({
      height: "auto"
    }).height();

    if (show_text.hasClass("open")) {
      /*CLOSE*/
      show_text.height(original_height).animate({
        height: small_height
      }, 300);
      show_text.removeClass("open");
      $(this).text("+　続きを読む").removeClass("active");
    } else {
      /*OPEN*/
      show_text.height(small_height).animate({
        height: original_height
      }, 300, function () {
        show_text.height("auto");
      });
      show_text.addClass("open");
      $(this).text("-　閉じる").addClass("active");
    }
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9hZG1pbi5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9mbG93Rm9ybS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbXlEZXRhaWwuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3NiLWFkbWluLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9zcC1tZW51LmpzIiwid2VicGFjazovLy92ZXJ0eCAoaWdub3JlZCkiXSwibmFtZXMiOlsiJCIsIiRpbnB1dCIsImxlbmd0aCIsInNvdXJjZSIsIkJsb29kaG91bmQiLCJsb2NhbCIsImRhdGEiLCJxdWVyeVRva2VuaXplciIsInRva2VuaXplcnMiLCJ3aGl0ZXNwYWNlIiwiZGF0dW1Ub2tlbml6ZXIiLCJpbml0aWFsaXplIiwidGFnc2lucHV0IiwidHJpbVZhbHVlIiwiZm9jdXNDbGFzcyIsInR5cGVhaGVhZGpzIiwibmFtZSIsInR0QWRhcHRlciIsInJlcXVpcmUiLCJnbG9iYWwiLCJqUXVlcnkiLCJjb25zb2xlIiwibG9nIiwiZG9jdW1lbnQiLCJyZWFkeSIsInBvcG92ZXIiLCIkY29sbGVjdGlvbkhvbGRlciIsIiRhZGRGbG93QnV0dG9uIiwiJG5ld0xpbmtMaSIsImFwcGVuZCIsImZpbmQiLCJlYWNoIiwiYWRkRmxvd0Zvcm1EZWxldGVMaW5rIiwib24iLCJlIiwiYWRkRmxvd0Zvcm0iLCJwcm90b3R5cGUiLCJpbmRleCIsIm5ld0Zvcm0iLCJyZXBsYWNlIiwiJG5ld0Zvcm1MaSIsImJlZm9yZSIsImNsaWNrIiwicHJldmVudERlZmF1bHQiLCJwYXJlbnQiLCJyZW1vdmUiLCIkZmxvd0Zvcm1MaSIsIiRyZW1vdmVGb3JtQnV0dG9uIiwiJEZsb3dGb3JtTGkiLCJzaG93X3RleHQiLCJzbWFsbF9oZWlnaHQiLCJvcmlnaW5hbF9oZWlnaHQiLCJjc3MiLCJoZWlnaHQiLCJoYXNDbGFzcyIsImFuaW1hdGUiLCJyZW1vdmVDbGFzcyIsInRleHQiLCJhZGRDbGFzcyIsInRvZ2dsZUNsYXNzIiwid2luZG93Iiwid2lkdGgiLCJlMCIsIm9yaWdpbmFsRXZlbnQiLCJkZWx0YSIsIndoZWVsRGVsdGEiLCJkZXRhaWwiLCJzY3JvbGxUb3AiLCJzY3JvbGxEaXN0YW5jZSIsImZhZGVJbiIsImZhZGVPdXQiLCJldmVudCIsIiRhbmNob3IiLCJzdG9wIiwiYXR0ciIsIm9mZnNldCIsInRvcCJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7O0FBQUEsdUM7Ozs7Ozs7Ozs7OztBQ0FBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBRUFBLENBQUMsQ0FBQyxZQUFXO0FBQ1Q7QUFDQTtBQUNBLE1BQUlDLE1BQU0sR0FBR0QsQ0FBQyxDQUFDLGdDQUFELENBQWQ7O0FBQ0EsTUFBSUMsTUFBTSxDQUFDQyxNQUFYLEVBQW1CO0FBQ2YsUUFBSUMsTUFBTSxHQUFHLElBQUlDLG9EQUFKLENBQWU7QUFDeEJDLFdBQUssRUFBRUosTUFBTSxDQUFDSyxJQUFQLENBQVksTUFBWixDQURpQjtBQUV4QkMsb0JBQWMsRUFBRUgsb0RBQVUsQ0FBQ0ksVUFBWCxDQUFzQkMsVUFGZDtBQUd4QkMsb0JBQWMsRUFBRU4sb0RBQVUsQ0FBQ0ksVUFBWCxDQUFzQkM7QUFIZCxLQUFmLENBQWI7QUFLQU4sVUFBTSxDQUFDUSxVQUFQO0FBRUFWLFVBQU0sQ0FBQ1csU0FBUCxDQUFpQjtBQUNiQyxlQUFTLEVBQUUsSUFERTtBQUViQyxnQkFBVSxFQUFFLE9BRkM7QUFHYkMsaUJBQVcsRUFBRTtBQUNUQyxZQUFJLEVBQUUsTUFERztBQUVUYixjQUFNLEVBQUVBLE1BQU0sQ0FBQ2MsU0FBUDtBQUZDO0FBSEEsS0FBakI7QUFRSDtBQUNKLENBckJBLENBQUQsQzs7Ozs7Ozs7Ozs7OztBQ0hBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFB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cGx1Z2luIiwiaW1wb3J0IEJsb29kaG91bmQgZnJvbSBcImJsb29kaG91bmQtanNcIjtcbmltcG9ydCBcImJvb3RzdHJhcC10YWdzaW5wdXRcIjtcblxuJChmdW5jdGlvbigpIHtcbiAgICAvLyBCb290c3RyYXAtdGFnc2lucHV0IGluaXRpYWxpemF0aW9uXG4gICAgLy8gaHR0cDovL2Jvb3RzdHJhcC10YWdzaW5wdXQuZ2l0aHViLmlvL2Jvb3RzdHJhcC10YWdzaW5wdXQvZXhhbXBsZXMvXG4gICAgdmFyICRpbnB1dCA9ICQoJ2lucHV0W2RhdGEtdG9nZ2xlPVwidGFnc2lucHV0XCJdJyk7XG4gICAgaWYgKCRpbnB1dC5sZW5ndGgpIHtcbiAgICAgICAgdmFyIHNvdXJjZSA9IG5ldyBCbG9vZGhvdW5kKHtcbiAgICAgICAgICAgIGxvY2FsOiAkaW5wdXQuZGF0YSgndGFncycpLFxuICAgICAgICAgICAgcXVlcnlUb2tlbml6ZXI6IEJsb29kaG91bmQudG9rZW5pemVycy53aGl0ZXNwYWNlLFxuICAgICAgICAgICAgZGF0dW1Ub2tlbml6ZXI6IEJsb29kaG91bmQudG9rZW5pemVycy53aGl0ZXNwYWNlXG4gICAgICAgIH0pO1xuICAgICAgICBzb3VyY2UuaW5pdGlhbGl6ZSgpO1xuXG4gICAgICAgICRpbnB1dC50YWdzaW5wdXQoe1xuICAgICAgICAgICAgdHJpbVZhbHVlOiB0cnVlLFxuICAgICAgICAgICAgZm9jdXNDbGFzczogJ2ZvY3VzJyxcbiAgICAgICAgICAgIHR5cGVhaGVhZGpzOiB7XG4gICAgICAgICAgICAgICAgbmFtZTogJ3RhZ3MnLFxuICAgICAgICAgICAgICAgIHNvdXJjZTogc291cmNlLnR0QWRhcHRlcigpXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cbn0pO1xuIiwiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IHJlcXVpcmUgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4uL2Nzcy9hcHAuc2Nzcyc7XG5cbi8vIE5lZWQgalF1ZXJ5PyBJbnN0YWxsIGl0IHdpdGggXCJ5YXJuIGFkZCBqcXVlcnlcIiwgdGhlbiB1bmNvbW1lbnQgdG8gcmVxdWlyZSBpdC5cbi8vIGNvbnN0ICQgPSByZXF1aXJlKCdqcXVlcnknKTtcblxuLy8gY29uc29sZS5sb2coJ0hlbGxvIFdlYnBhY2sgRW5jb3JlISBFZGl0IG1lIGluIGFzc2V0cy9qcy9hcHAuanMnKTtcbmNvbnN0ICQgPSByZXF1aXJlKCdqcXVlcnknKTtcbmdsb2JhbC4kID0gZ2xvYmFsLmpRdWVyeSA9ICQ7XG5cbnJlcXVpcmUoJ2Jvb3RzdHJhcCcpO1xuXG5jb25zb2xlLmxvZygnSGVsbG8gV2VicGFjayBFbmNvcmUnKTtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgJCgnW2RhdGEtdG9nZ2xlPVwicG9wb3ZlclwiXScpLnBvcG92ZXIoKTtcbn0pO1xuXG5pbXBvcnQgJy4vc2ItYWRtaW4nO1xuaW1wb3J0ICcuL2Zsb3dGb3JtJztcbmltcG9ydCAnLi9hZG1pbic7XG5pbXBvcnQgJy4vc3AtbWVudSc7XG5pbXBvcnQgJy4vbXlEZXRhaWwnOyIsInZhciAkY29sbGVjdGlvbkhvbGRlcjtcblxuLy8gc2V0dXAgYW4gXCJhZGQgYSBmbG93XCIgbGlua1xudmFyICRhZGRGbG93QnV0dG9uID0gJCgnPGJ1dHRvbiB0eXBlPVwiYnV0dG9uXCIgY2xhc3M9XCJhZGRfZmxvd19saW5rIGJ0biBidG4tbGlnaHQgYnRuLXNtXCI+QWRkIGEgRmxvdzwvYnV0dG9uPicpO1xudmFyICRuZXdMaW5rTGkgPSAkKCc8ZGl2PjwvZGl2PicpLmFwcGVuZCgkYWRkRmxvd0J1dHRvbik7XG5cbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgLy8gR2V0IHRoZSB1bCB0aGF0IGhvbGRzIHRoZSBjb2xsZWN0aW9uIG9mIGZsb3dzXG4gICAgJGNvbGxlY3Rpb25Ib2xkZXIgPSAkKCdkaXYjbXlfZXZlbnRfbXlFdmVudEZsb3dzJyk7XG5cbiAgICAkY29sbGVjdGlvbkhvbGRlci5maW5kKCdkaXYuZmxvdy1saXN0JykuZWFjaChmdW5jdGlvbigpIHtcbiAgICAgICAgYWRkRmxvd0Zvcm1EZWxldGVMaW5rKCQodGhpcykpO1xuICAgIH0pO1xuICAgIC8vIGFkZCB0aGUgXCJhZGQgYSB0YXNrc1wiIGFuY2hvciBhbmQgbGkgdG8gdGhlIHRhc2tzIHVsXG4gICAgJGNvbGxlY3Rpb25Ib2xkZXIuYXBwZW5kKCRuZXdMaW5rTGkpO1xuXG4gICAgLy8gY291bnQgdGhlIGN1cnJlbnQgZm9ybSBpbnB1dHMgd2UgaGF2ZSAoZS5nLiAyKSwgdXNlIHRoYXQgYXMgdGhlIG5ld1xuICAgIC8vIGluZGV4IHdoZW4gaW5zZXJ0aW5nIGEgbmV3IGl0ZW0gKGUuZy4gMilcbiAgICAkY29sbGVjdGlvbkhvbGRlci5kYXRhKCdpbmRleCcsICRjb2xsZWN0aW9uSG9sZGVyLmZpbmQoJzppbnB1dCcpLmxlbmd0aCk7XG5cbiAgICAkYWRkRmxvd0J1dHRvbi5vbignY2xpY2snLCBmdW5jdGlvbihlKSB7XG4gICAgICAgIC8vIGFkZCBhIG5ldyBmbG93IGZvcm0gKHNlZSBuZXh0IGNvZGUgYmxvY2spXG4gICAgICAgIGFkZEZsb3dGb3JtKCRjb2xsZWN0aW9uSG9sZGVyLCAkbmV3TGlua0xpKTtcbiAgICB9KTtcbn0pO1xuXG5mdW5jdGlvbiBhZGRGbG93Rm9ybSgkY29sbGVjdGlvbkhvbGRlciwgJG5ld0xpbmtMaSkge1xuICAgIC8vIEdldCB0aGUgZGF0YS1wcm90b3R5cGUgZXhwbGFpbmVkIGVhcmxpZXJcbiAgICB2YXIgcHJvdG90eXBlID0gJGNvbGxlY3Rpb25Ib2xkZXIuZGF0YSgncHJvdG90eXBlJyk7XG4gICAgXG4gICAgLy8gZ2V0IHRoZSBuZXcgaW5kZXhcbiAgICB2YXIgaW5kZXggPSAkY29sbGVjdGlvbkhvbGRlci5kYXRhKCdpbmRleCcpO1xuICAgIFxuICAgIC8vIFJlcGxhY2UgJyQkbmFtZSQkJyBpbiB0aGUgcHJvdG90eXBlJ3MgSFRNTCB0b1xuICAgIC8vIGluc3RlYWQgYmUgYSBudW1iZXIgYmFzZWQgb24gaG93IG1hbnkgaXRlbXMgd2UgaGF2ZVxuICAgIHZhciBuZXdGb3JtID0gcHJvdG90eXBlLnJlcGxhY2UoL19fbmFtZV9fL2csIGluZGV4KTtcbiAgICBcbiAgICAvLyBpbmNyZWFzZSB0aGUgaW5kZXggd2l0aCBvbmUgZm9yIHRoZSBuZXh0IGl0ZW1cbiAgICAkY29sbGVjdGlvbkhvbGRlci5kYXRhKCdpbmRleCcsIGluZGV4ICsgMSk7XG4gICAgXG4gICAgLy8gRGlzcGxheSB0aGUgZm9ybSBpbiB0aGUgcGFnZSBpbiBhbiBsaSwgYmVmb3JlIHRoZSBcIkFkZCBhIGZsb3dcIiBsaW5rIGxpXG4gICAgdmFyICRuZXdGb3JtTGkgPSAkKCc8ZGl2IGNsYXNzPVwiZmxvdy1saXN0XCI+PC9kaXY+JykuYXBwZW5kKG5ld0Zvcm0pO1xuICAgIFxuICAgIC8vIGFsc28gYWRkIGEgcmVtb3ZlIGJ1dHRvbiwganVzdCBmb3IgdGhpcyBleGFtcGxlXG4gICAgJG5ld0Zvcm1MaS5hcHBlbmQoJzxhIGhyZWY9XCIjXCIgY2xhc3M9XCJyZW1vdmUtZmxvd1wiPng8L2E+Jyk7XG4gICAgXG4gICAgJG5ld0xpbmtMaS5iZWZvcmUoJG5ld0Zvcm1MaSk7XG4gICAgXG4gICAgLy8gaGFuZGxlIHRoZSByZW1vdmFsLCBqdXN0IGZvciB0aGlzIGV4YW1wbGVcbiAgICAkKCcucmVtb3ZlLWZsb3cnKS5jbGljayhmdW5jdGlvbihlKSB7XG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgXG4gICAgICAgICQodGhpcykucGFyZW50KCkucmVtb3ZlKCk7XG4gICAgICAgIFxuICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgfSk7XG59XG5cbmZ1bmN0aW9uIGFkZEZsb3dGb3JtRGVsZXRlTGluaygkZmxvd0Zvcm1MaSkge1xuICAgIHZhciAkcmVtb3ZlRm9ybUJ1dHRvbiA9ICQoJzxidXR0b24gdHlwZT1cImJ1dHRvbiBidG4gYnRuLWxpZ2h0IGJ0bi1zbVwiPkRlbGV0ZSB0aGlzIGZsb3c8L2J1dHRvbj4nKTtcbiAgICAkZmxvd0Zvcm1MaS5hcHBlbmQoJHJlbW92ZUZvcm1CdXR0b24pO1xuXG4gICAgJHJlbW92ZUZvcm1CdXR0b24ub24oJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuICAgICAgICAvLyByZW1vdmUgdGhlIGxpIGZvciB0aGUgZmxvdyBmb3JtXG4gICAgICAgICRGbG93Rm9ybUxpLnJlbW92ZSgpO1xuICAgIH0pO1xufSIsIiQoZnVuY3Rpb24oKSB7XG4gICAgJChcIi5tZS1BYm91dF9Db250ZW50U2hvd1wiKS5jbGljayhmdW5jdGlvbigpIHtcbiAgICAgIHZhciBzaG93X3RleHQgPSAkKHRoaXMpXG4gICAgICAgIC5wYXJlbnQoXCIubWUtQWJvdXRfQ29udGVudFwiKVxuICAgICAgICAuZmluZChcIi5tZS1BYm91dF9Db250ZW50VGV4dFwiKTtcbiAgICAgIHZhciBzbWFsbF9oZWlnaHQgPSAyMDA7IC8vVGhpcyBpcyBpbml0aWFsIGhlaWdodC5cbiAgICAgIHZhciBvcmlnaW5hbF9oZWlnaHQgPSBzaG93X3RleHQuY3NzKHsgaGVpZ2h0OiBcImF1dG9cIiB9KS5oZWlnaHQoKTtcbiAgXG4gICAgICBpZiAoc2hvd190ZXh0Lmhhc0NsYXNzKFwib3BlblwiKSkge1xuICAgICAgICAvKkNMT1NFKi9cbiAgICAgICAgc2hvd190ZXh0LmhlaWdodChvcmlnaW5hbF9oZWlnaHQpLmFuaW1hdGUoeyBoZWlnaHQ6IHNtYWxsX2hlaWdodCB9LCAzMDApO1xuICAgICAgICBzaG93X3RleHQucmVtb3ZlQ2xhc3MoXCJvcGVuXCIpO1xuICAgICAgICAkKHRoaXMpXG4gICAgICAgICAgLnRleHQoXCIr44CA57aa44GN44KS6Kqt44KAXCIpXG4gICAgICAgICAgLnJlbW92ZUNsYXNzKFwiYWN0aXZlXCIpO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgLypPUEVOKi9cbiAgICAgICAgc2hvd190ZXh0XG4gICAgICAgICAgLmhlaWdodChzbWFsbF9oZWlnaHQpXG4gICAgICAgICAgLmFuaW1hdGUoeyBoZWlnaHQ6IG9yaWdpbmFsX2hlaWdodCB9LCAzMDAsIGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgc2hvd190ZXh0LmhlaWdodChcImF1dG9cIik7XG4gICAgICAgICAgfSk7XG4gICAgICAgIHNob3dfdGV4dC5hZGRDbGFzcyhcIm9wZW5cIik7XG4gICAgICAgICQodGhpcylcbiAgICAgICAgICAudGV4dChcIi3jgIDplonjgZjjgotcIilcbiAgICAgICAgICAuYWRkQ2xhc3MoXCJhY3RpdmVcIik7XG4gICAgICB9XG4gICAgfSk7XG4gIH0pOyIsIihmdW5jdGlvbigkKSB7XG4gIFwidXNlIHN0cmljdFwiOyAvLyBTdGFydCBvZiB1c2Ugc3RyaWN0XG5cbiAgLy8gVG9nZ2xlIHRoZSBzaWRlIG5hdmlnYXRpb25cbiAgJChcIiNzaWRlYmFyVG9nZ2xlXCIpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgJChcImJvZHlcIikudG9nZ2xlQ2xhc3MoXCJzaWRlYmFyLXRvZ2dsZWRcIik7XG4gICAgJChcIi5zaWRlYmFyXCIpLnRvZ2dsZUNsYXNzKFwidG9nZ2xlZFwiKTtcbiAgfSk7XG5cbiAgLy8gUHJldmVudCB0aGUgY29udGVudCB3cmFwcGVyIGZyb20gc2Nyb2xsaW5nIHdoZW4gdGhlIGZpeGVkIHNpZGUgbmF2aWdhdGlvbiBob3ZlcmVkIG92ZXJcbiAgJCgnYm9keS5maXhlZC1uYXYgLnNpZGViYXInKS5vbignbW91c2V3aGVlbCBET01Nb3VzZVNjcm9sbCB3aGVlbCcsIGZ1bmN0aW9uKGUpIHtcbiAgICBpZiAoJCh3aW5kb3cpLndpZHRoKCkgPiA3NjgpIHtcbiAgICAgIHZhciBlMCA9IGUub3JpZ2luYWxFdmVudCxcbiAgICAgICAgZGVsdGEgPSBlMC53aGVlbERlbHRhIHx8IC1lMC5kZXRhaWw7XG4gICAgICB0aGlzLnNjcm9sbFRvcCArPSAoZGVsdGEgPCAwID8gMSA6IC0xKSAqIDMwO1xuICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIH1cbiAgfSk7XG5cbiAgLy8gU2Nyb2xsIHRvIHRvcCBidXR0b24gYXBwZWFyXG4gICQoZG9jdW1lbnQpLm9uKCdzY3JvbGwnLCBmdW5jdGlvbigpIHtcbiAgICB2YXIgc2Nyb2xsRGlzdGFuY2UgPSAkKHRoaXMpLnNjcm9sbFRvcCgpO1xuICAgIGlmIChzY3JvbGxEaXN0YW5jZSA+IDEwMCkge1xuICAgICAgJCgnLnNjcm9sbC10by10b3AnKS5mYWRlSW4oKTtcbiAgICB9IGVsc2Uge1xuICAgICAgJCgnLnNjcm9sbC10by10b3AnKS5mYWRlT3V0KCk7XG4gICAgfVxuICB9KTtcblxuICAvLyBTbW9vdGggc2Nyb2xsaW5nIHVzaW5nIGpRdWVyeSBlYXNpbmdcbiAgJChkb2N1bWVudCkub24oJ2NsaWNrJywgJ2Euc2Nyb2xsLXRvLXRvcCcsIGZ1bmN0aW9uKGV2ZW50KSB7XG4gICAgdmFyICRhbmNob3IgPSAkKHRoaXMpO1xuICAgICQoJ2h0bWwsIGJvZHknKS5zdG9wKCkuYW5pbWF0ZSh7XG4gICAgICBzY3JvbGxUb3A6ICgkKCRhbmNob3IuYXR0cignaHJlZicpKS5vZmZzZXQoKS50b3ApXG4gICAgfSwgMTAwMCwgJ2Vhc2VJbk91dEV4cG8nKTtcbiAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICB9KTtcblxufSkoalF1ZXJ5KTsgLy8gRW5kIG9mIHVzZSBzdHJpY3RcbiIsIiQoZnVuY3Rpb24oKSB7XG4gICAgJCgnLnN3LU5hdl9PcGVuQnRuJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAkKCdodG1sJykudG9nZ2xlQ2xhc3MoJ21lbnUtb3BlbmQnKTtcbiAgICAgICAgJCh0aGlzKS50b2dnbGVDbGFzcygnb3BlbicpO1xuICAgICAgICAkKCcuc3ctTmF2X1NpZGUnKS50b2dnbGVDbGFzcygnb3Blbi1zaWRlJyk7XG4gICAgfSk7XG59KTsiLCIvKiAoaWdub3JlZCkgKi8iXSwic291cmNlUm9vdCI6IiJ9