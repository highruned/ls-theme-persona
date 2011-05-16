window.site = jQuery.extend(true, window.site ? window.site : {}, {
  ajax_mode: true,
  slide_mode: true,
  slide_speed: 1500,
  slide_buffer_size: 2
});

jQuery.fn.extend({
  random: function() {
    return this.get(Math.floor(this.length * (Math.random() % 1)));
  },
  randomBetween: function(min, max) {
    return this.get(min + jQuery.random(max - min + 1));
  }
});

var random = 0;
jQuery.extend(jQuery.expr[':'],
{
  random: function(a, i, m, r) {
    if (i == 0) {
        random = Math.floor(Math.random() * r.length);
    };
  
    return i == random;
  }
});

jQuery(document).ready(function($) {
  var location = new String(window.location);

  var update_links = function() {
    $('a').each(function() {
      var self = $(this);
      
      if(self.attr('rel')) // we've already updated this link
        return;
      
      var uri = self.attr('href');
      
      if(!uri) // this link doesn't have a URI?!
        return;
      
      /*if(uri === location 
      || (uri + '/') === location 
      || uri === (location + '/')
      || location.search(uri) !== -1
      || (uri.substr(0, 4) !== 'http'
        && uri.substr(0, 1) !== '#'
        && uri.substr(0, 9) !== 'javascript')
      )*/
      if(uri.substr(0, 1) === '/') {
        self.attr('rel', 'address:' + uri);
        self.attr('href', '#' + uri);
      }
    });
  };
  
  var pane_target = $('#content');
  var on_resize;
  var last_hash_change = null;
  
  var on_load = function() {
  
  };

  var on_hash_change = function(a) {
    last_hash_change = a;
    
    var context = {};
    
    var path = a ? a.path : window.location.hash.substr(1);
    
    var x1 = path.match(/\/(.*)$/);
    
    var name = x1 ? x1[1] : '';
    
    var id = name ? name.replace(/\//gi, '_') : 'home';
    
    if(!$('#' + id).length) {
      var html = '';
      
      for(var i = 0, l = site.slide_buffer_size; i < l; ++i)
        html += '<li><section></section></li>';
        
      html += '<li><section id="' + id + '"></section></li>';
      
      $(innerShiv(html)).appendTo($('> ul', pane_target));
      
      on_resize();
    }

    $('section', pane_target).removeClass('active');

    var section_target = pane_target.find('#' + id);
    
    if(section_target.html()) { // section is already good to go
      document.title = $('.content-header h1', section_target).html() + ' - Eric Muyser';
      
      section_target.addClass('active');
      
      on_resize({reposition: false});
      
      var speed = site.slide_mode ? site.slide_speed : 0;
      
      pane_target.scrollTo(section_target.parent(), speed);
      
      return;
    }
      
    $.extend(context, {
      update: {},
      onAfterUpdate: function() {
        update_links();
        
        document.title = $('.content-header h1', section_target).html() + ' - Eric Muyser';
        
        section_target.addClass('active');
        
        on_resize({reposition: false});
        
        var speed = site.slide_mode ? site.slide_speed : 0;
        
        pane_target.scrollTo(section_target.parent(), speed);
      }
    }, true);
    
    context['update'][id] = 'ls_cms_page';

    Phpr.sendRequest('/' + name + '/', 'on_action', context);
  };
  
  $('#navigation-social').menu({
    on_click: function(a, callback) {
      callback();
    }
  });

  $('#navigation-social > ul > li > a').hover(function() {
    $(this).animate({'background-color': '#111'}, 500);
  }, 
  function() {
    $(this).stop().animate({'background-color': '#262626'}, 500, function() {  });
  });
  
  on_resize = function(params) {
    params = $.extend({
      reposition: true
    }, params);
    
    $('section.active .content-body-wrapper', pane_target).css('height', function() {
      return $(window).height() - $('section.active .content-header', pane_target).height() - 70 - 20 - 20 - 40; // 20 padding/margin   
    });
    
    $('#navigation-social').css('height', function() {
      return $(window).height() - 10 - 20; // 20 padding/margin
    });
    
    $('.pane > ul').css({
      width: parseInt($(window).width()) * 5 + 'px',
      height: parseInt($(window).height()) * 5 + 'px'
    });

    $('.pane > ul > li').each(function() {
      $(this).css({
        width: $(window).width(),
        height: $(window).height()
      });
    });
    
    $('section.active .content-body', pane_target).jScrollPane();
    
    if(!$('section.active .content-fade').length) // already init?
      $('section.active .content-body').prepend('<div class="content-fade top"></div>').append('<div class="content-fade bottom"></div>');
    
    if(params.reposition) {
      var section_target = $('section.active', pane_target);
      pane_target.scrollTo(section_target.parent());
    }
  }; 

  $(window).bind('resize', on_resize);
  
  if(!site.ajax_mode)
    return;
  
  var initialize_ajax_mode = function() {
    update_links();
    on_resize();
  
    $.address.internalChange(on_hash_change);
    $.address.externalChange(on_hash_change);
    
    $(window).load(function() {
      if(!last_hash_change)
        on_hash_change();
    });
  };
  
  initialize_ajax_mode();
});
