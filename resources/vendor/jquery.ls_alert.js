window.site = jQuery.extend(true, window.site ? window.site : {}, {
  message: {
    remove: function() {
      $.removebar();
    },
    custom: function(message, params) {
      if(!message)
        return;
      
      var params = $.extend({
        position: 'top',
        removebutton: false,
        color: '#666',
        message: message,
        time: 5000
      }, params || {});
      
      jQuery(document).ready(function($) {
        $.bar(params);
      });
    },
    addToCart: function() {
      site.message.custom('Your selection has been added to the cart!', {time: 3000});
    }
  }
});

jQuery(document).ready(function($) {
	$('#loading').css({'right': '-' + ($('#loading').width() + 5) + 'px'}).show();
});

Phpr.showLoadingIndicator = function() {
	jQuery('#loading').animate({'right': '+=' + (jQuery('#loading').width() - 5) + 'px'}, 300);
};

Phpr.hideLoadingIndicator = function() {
	jQuery('#loading').animate({'right': '-=' + (jQuery('#loading').width() + 5) + 'px'}, 300);
};

Phpr.response.popupError = function() {
  site.message.custom(this.html.replace('@AJAX-ERROR@', ''), {background_color: '#393536', color: '#cc7c7c', time: 10000});
};