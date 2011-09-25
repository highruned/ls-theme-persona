(function($) {
  $.fn.menu = function(context) {
    context = $.extend({}, {
      on_click: function() {}
    }, context);
    
    return $(this).each(function() {
      var 
      div = $(this),
      ul = $('> ul', div),
      ulPadding = 0,
      divHeight = div.height(),
      lastLi = ul.find('> li:last-child');
      
      div.scrollTop(0);
      
      div.mousemove(function(e) {
        // as images are loaded ul width increases, so we recalculate it each time
        var ulHeight = lastLi[0].offsetTop + lastLi.outerHeight() + ulPadding;

        var top = (e.pageY - div.offset().top) * (ulHeight-divHeight) / divHeight;

        div.stop(true, true).animate({scrollTop: top}, {duration: 900, easing: 'linear'});
      });
      
      var li = $('<li><a href="javascript:;">Go Back</a></li>');
      
      $('a', li).click(function() {
        var a = $(this);
        var ul_2 = $(this).parents('ul:first', this);
        
        
        ul_2.hide(500, function() { ul_2.insertAfter(ul_2[0].menu_item); });
        ul.delay(500).show(500);
        
        return false;
      });
      

      $('a', ul).bind('click', function() {
        var a = $(this);
        var li = a.parents('li:first');
        
        context.on_click(a, function() { 
          li.siblings().removeClass('current');
          li.addClass('current');
          
          var ul_2 = a.parent('li').find('> ul');
          
          if(!ul_2.length)
            return;
          
          ul_2.addClass(ul.attr('class')).hide();
          ul_2[0].menu_item = a;
          
          ul_2.insertAfter(ul);
          ul.hide(500);
          ul_2.delay(500).show(500);
        });
      });
      
      $('ul', ul).prepend(li);
    });
  };
})(jQuery);
