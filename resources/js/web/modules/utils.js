var Utils = (function() {
	
	var selectors = {
    html:  'html',
    body:  'body',
    touch: '[data-touch]',
    badge: '.js-btn-badge',
  };

  var classes = {
    active: 'is-active',
    touched: 'is-touched',
  };

  var _initialize = function() {
    _bind();
  };

  var _bind = function() {

    $(selectors.touch).on('touchstart', function(e) {
      $(this).addClass(classes.touched);
    });

    $(selectors.touch).on('touchend', function(e) {
      $(this).removeClass(classes.touched);
    });

    $(selectors.body).on('click', selectors.badge, function(){
      let form = document.querySelector(".landing-participate");
      form.scrollIntoView({block: "start", behavior: "smooth"});
    });
  };
  
  return {
    init:  _initialize,
  };
	
})();

// Initialize
$(function() {
  Utils.init();
});