	$(document).ready(function () { $("#bgimageffghet").fadeIn('slow'); $(".toggle_avatar").click(function (e) { e.stopPropagation();$("#toggle_avatar").fadeToggle(50);});$(document).click(function () {var $el = $("#toggle_avatar");if ($el.is(":visible")) {$el.fadeIn(50);$el.fadeOut(50);}});});
$(document).ready(function () { $("#bgimageffghet").fadeIn('slow'); $(".toggle_cat").click(function (e) { e.stopPropagation();$("#toggle_cat").fadeToggle(50);});$(document).click(function () {var $el = $("#toggle_cat");if ($el.is(":visible")) {$el.fadeIn(50);$el.fadeOut(50);}});});$(document).ready(function() {if (window.history && history.pushState) {historyedited = false;$(window).bind('popstate', function(e) {if (historyedited) {loadContent(location.pathname + location.search);}});doPager();}});function doPager() {$('body #Theme_Flexible').click(function(e) {e.preventDefault();loadContent($(this).attr('href'));history.pushState(null, null, $(this).attr('href'));historyedited = true;});}function loadContent(url) {$('.Theme_Content_Wrap_Discover').empty().addClass('loading').load(url + ' .Theme_Content_Wrap_Discover', function() {$('#Theme_Content').removeClass();doPager();});}

/*
    --------------------------------
    Infinite Scroll
    --------------------------------
    + https://github.com/paulirish/infinitescroll
    + version 2.0b2.110713
    + Copyright 2011 Paul Irish & Luke Shumard
    + Licensed under the MIT license

    + Documentation: http://infinite-scroll.com/

*/

(function(window,$,undefined){$.infinitescroll=function infscr(options,callback,element){this.element=$(element);this._create(options,callback);};$.infinitescroll.defaults={loading:{finished:undefined,finishedMsg:"<em>Congratulations, you've reached the end of the internet.</em>",img:"http://www.infinite-scroll.com/loading.gif",msg:null,msgText:"<em>Einen Moment bitte...</em>",selector:null,speed:'fast',start:undefined},state:{isDuringAjax:false,isInvalidPage:false,isDestroyed:false,isDone:false,isPaused:false,currPage:1},callback:undefined,debug:false,behavior:undefined,binder:$(window),nextSelector:"div.navigation a:first",navSelector:"div.navigation",contentSelector:null,extraScrollPx:150,itemSelector:"div.post",animate:false,pathParse:undefined,dataType:'html',appendCallback:true,bufferPx:40,errorCallback:function(){},infid:0,pixelsFromNavToBottom:undefined,path:undefined};$.infinitescroll.prototype={_binding:function infscr_binding(binding){var instance=this,opts=instance.options;if(!!opts.behavior&&this['_binding_'+opts.behavior]!==undefined){this['_binding_'+opts.behavior].call(this);return;}
if(binding!=='bind'&&binding!=='unbind'){this._debug('Binding value  '+binding+' not valid')
return false;}
if(binding=='unbind'){(this.options.binder).unbind('smartscroll.infscr.'+instance.options.infid);}else{(this.options.binder)[binding]('smartscroll.infscr.'+instance.options.infid,function(){instance.scroll();});};this._debug('Binding',binding);},_create:function infscr_create(options,callback){if(!this._validate(options)){return false;}
var opts=this.options=$.extend(true,{},$.infinitescroll.defaults,options),relurl=/(.*?\/\/).*?(\/.*)/,path=$(opts.nextSelector).attr('href');opts.contentSelector=opts.contentSelector||this.element;opts.loading.selector=opts.loading.selector||opts.contentSelector;if(!path){this._debug('Navigation selector not found');return;}
opts.path=this._determinepath(path);opts.loading.msg=$('<div id="infscr-loading"><img alt="Loading..." src="'+opts.loading.img+'" /><div>'+opts.loading.msgText+'</div></div>');(new Image()).src=opts.loading.img;opts.pixelsFromNavToBottom=$(document).height()-$(opts.navSelector).offset().top;opts.loading.start=opts.loading.start||function(){$(opts.navSelector).hide();opts.loading.msg.appendTo(opts.loading.selector).show(opts.loading.speed,function(){beginAjax(opts);});};opts.loading.finished=opts.loading.finished||function(){opts.loading.msg.fadeOut('normal');};opts.callback=function(instance,data){if(!!opts.behavior&&instance['_callback_'+opts.behavior]!==undefined){instance['_callback_'+opts.behavior].call($(opts.contentSelector)[0],data);}
if(callback){callback.call($(opts.contentSelector)[0],data);}};this._setup();},_debug:function infscr_debug(){if(this.options.debug){return window.console&&console.log.call(console,arguments);}},_determinepath:function infscr_determinepath(path){var opts=this.options;if(!!opts.behavior&&this['_determinepath_'+opts.behavior]!==undefined){this['_determinepath_'+opts.behavior].call(this,path);return;}
if(!!opts.pathParse){this._debug('pathParse manual');return opts.pathParse;}else if(path.match(/^(.*?)\b2\b(.*?$)/)){path=path.match(/^(.*?)\b2\b(.*?$)/).slice(1);}else if(path.match(/^(.*?)2(.*?$)/)){if(path.match(/^(.*?page=)2(\/.*|$)/)){path=path.match(/^(.*?page=)2(\/.*|$)/).slice(1);return path;}
path=path.match(/^(.*?)2(.*?$)/).slice(1);}else{if(path.match(/^(.*?page=)1(\/.*|$)/)){path=path.match(/^(.*?page=)1(\/.*|$)/).slice(1);return path;}else{this._debug('Sorry, we couldn\'t parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.');opts.state.isInvalidPage=true;}}
this._debug('determinePath',path);return path;},_error:function infscr_error(xhr){var opts=this.options;if(!!opts.behavior&&this['_error_'+opts.behavior]!==undefined){this['_error_'+opts.behavior].call(this,xhr);return;}
if(xhr!=='destroy'&&xhr!=='end'){xhr='unknown';}
this._debug('Error',xhr);if(xhr=='end'){this._showdonemsg();}
opts.state.isDone=true;opts.state.currPage=1;opts.state.isPaused=false;this._binding('unbind');},_loadcallback:function infscr_loadcallback(box,data){var opts=this.options,callback=this.options.callback,result=(opts.state.isDone)?'done':(!opts.appendCallback)?'no-append':'append',frag;if(!!opts.behavior&&this['_loadcallback_'+opts.behavior]!==undefined){this['_loadcallback_'+opts.behavior].call(this,box,data);return;}
switch(result){case'done':this._showdonemsg();return false;break;case'no-append':if(opts.dataType=='html'){data='<div>'+data+'</div>';data=$(data).find(opts.itemSelector);};break;case'append':var children=box.children();if(children.length==0){return this._error('end');}
frag=document.createDocumentFragment();while(box[0].firstChild){frag.appendChild(box[0].firstChild);}
this._debug('contentSelector',$(opts.contentSelector)[0])
$(opts.contentSelector)[0].appendChild(frag);data=children.get();break;}
opts.loading.finished.call($(opts.contentSelector)[0],opts)
if(opts.animate){var scrollTo=$(window).scrollTop()+$('#infscr-loading').height()+opts.extraScrollPx+'px';$('html,body').animate({scrollTop:scrollTo},800,function(){opts.state.isDuringAjax=false;});}
if(!opts.animate)opts.state.isDuringAjax=false;callback(this,data);},_nearbottom:function infscr_nearbottom(){var opts=this.options,pixelsFromWindowBottomToBottom=0+$(document).height()-(opts.binder.scrollTop())-$(window).height();if(!!opts.behavior&&this['_nearbottom_'+opts.behavior]!==undefined){this['_nearbottom_'+opts.behavior].call(this);return;}
this._debug('math:',pixelsFromWindowBottomToBottom,opts.pixelsFromNavToBottom);return(pixelsFromWindowBottomToBottom-opts.bufferPx<opts.pixelsFromNavToBottom);},_pausing:function infscr_pausing(pause){var opts=this.options;if(!!opts.behavior&&this['_pausing_'+opts.behavior]!==undefined){this['_pausing_'+opts.behavior].call(this,pause);return;}
if(pause!=='pause'&&pause!=='resume'&&pause!==null){this._debug('Invalid argument. Toggling pause value instead');};pause=(pause&&(pause=='pause'||pause=='resume'))?pause:'toggle';switch(pause){case'pause':opts.state.isPaused=true;break;case'resume':opts.state.isPaused=false;break;case'toggle':opts.state.isPaused=!opts.state.isPaused;break;}
this._debug('Paused',opts.state.isPaused);return false;},_setup:function infscr_setup(){var opts=this.options;if(!!opts.behavior&&this['_setup_'+opts.behavior]!==undefined){this['_setup_'+opts.behavior].call(this);return;}
this._binding('bind');return false;},_showdonemsg:function infscr_showdonemsg(){var opts=this.options;if(!!opts.behavior&&this['_showdonemsg_'+opts.behavior]!==undefined){this['_showdonemsg_'+opts.behavior].call(this);return;}
opts.loading.msg.find('img').hide().parent().find('div').html(opts.loading.finishedMsg).animate({opacity:1},2000,function(){$(this).parent().fadeOut('normal');});opts.errorCallback.call($(opts.contentSelector)[0],'done');},_validate:function infscr_validate(opts){for(var key in opts){if(key.indexOf&&key.indexOf('Selector')>-1&&$(opts[key]).length===0){this._debug('Your '+key+' found no elements.');return false;}
return true;}},bind:function infscr_bind(){this._binding('bind');},destroy:function infscr_destroy(){this.options.state.isDestroyed=true;return this._error('destroy');},pause:function infscr_pause(){this._pausing('pause');},resume:function infscr_resume(){this._pausing('resume');},retrieve:function infscr_retrieve(pageNum){var instance=this,opts=instance.options,path=opts.path,box,frag,desturl,method,condition,pageNum=pageNum||null,getPage=(!!pageNum)?pageNum:opts.state.currPage;beginAjax=function infscr_ajax(opts){opts.state.currPage++;instance._debug('heading into ajax',path);box=$(opts.contentSelector).is('table')?$('<tbody/>'):$('<div/>');desturl=path.join(opts.state.currPage);method=(opts.dataType=='html'||opts.dataType=='json')?opts.dataType:'html+callback';if(opts.appendCallback&&opts.dataType=='html')method+='+callback'
switch(method){case'html+callback':instance._debug('Using HTML via .load() method');box.load(desturl+' '+opts.itemSelector,null,function infscr_ajax_callback(responseText){instance._loadcallback(box,responseText);});break;case'html':case'json':instance._debug('Using '+(method.toUpperCase())+' via $.ajax() method');$.ajax({url:desturl,dataType:opts.dataType,complete:function infscr_ajax_callback(jqXHR,textStatus){condition=(typeof(jqXHR.isResolved)!=='undefined')?(jqXHR.isResolved()):(textStatus==="success"||textStatus==="notmodified");(condition)?instance._loadcallback(box,jqXHR.responseText):instance._error('end');}});break;}};if(!!opts.behavior&&this['retrieve_'+opts.behavior]!==undefined){this['retrieve_'+opts.behavior].call(this,pageNum);return;}
if(opts.state.isDestroyed){this._debug('Instance is destroyed');return false;};opts.state.isDuringAjax=true;opts.loading.start.call($(opts.contentSelector)[0],opts);},scroll:function infscr_scroll(){var opts=this.options,state=opts.state;if(!!opts.behavior&&this['scroll_'+opts.behavior]!==undefined){this['scroll_'+opts.behavior].call(this);return;}
if(state.isDuringAjax||state.isInvalidPage||state.isDone||state.isDestroyed||state.isPaused)return;if(!this._nearbottom())return;this.retrieve();},toggle:function infscr_toggle(){this._pausing();},unbind:function infscr_unbind(){this._binding('unbind');},update:function infscr_options(key){if($.isPlainObject(key)){this.options=$.extend(true,this.options,key);}}}
$.fn.infinitescroll=function infscr_init(options,callback){var thisCall=typeof options;switch(thisCall){case'string':var args=Array.prototype.slice.call(arguments,1);this.each(function(){var instance=$.data(this,'infinitescroll');if(!instance){return false;}
if(!$.isFunction(instance[options])||options.charAt(0)==="_"){return false;}
instance[options].apply(instance,args);});break;case'object':this.each(function(){var instance=$.data(this,'infinitescroll');if(instance){instance.update(options);}else{$.data(this,'infinitescroll',new $.infinitescroll(options,callback,this));}});break;}
return this;};var event=$.event,scrollTimeout;event.special.smartscroll={setup:function(){$(this).bind("scroll",event.special.smartscroll.handler);},teardown:function(){$(this).unbind("scroll",event.special.smartscroll.handler);},handler:function(event,execAsap){var context=this,args=arguments;event.type="smartscroll";if(scrollTimeout){clearTimeout(scrollTimeout);}
scrollTimeout=setTimeout(function(){$.event.handle.apply(context,args);},execAsap==="execAsap"?0:100);}};$.fn.smartscroll=function(fn){return fn?this.bind("smartscroll",fn):this.trigger("smartscroll",["execAsap"]);};})(window,jQuery);


$(function(){
	
	
	$("a.up").click(function(){
	//get the id
	the_id = $(this).attr('id');
	
	jQuery(".horizontal-vote").addClass('up');
	
	//fadeout the vote-count 
	$("span#votes_count"+the_id).fadeOut("fast");
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "action=vote_up&id="+$(this).attr("id")+"&user_id="+$(this).attr("user_id"),
			url: "../sources/votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).html(msg);
				//fadein the vote count
				$("span#votes_count"+the_id).fadeIn();
				//remove the spinner
			}
		});
	});
	
	$("a.down").click(function(){
	//get the id
	the_id = $(this).attr('id');
	
	jQuery(".horizontal-vote").removeClass('up');
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "action=vote_down&id="+$(this).attr("id")+"&user_id="+$(this).attr("user_id"),
			url: "../sources/votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).fadeOut();
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});
});	


/*
    Main Javascript File
*/
$(function(){
    var $container = $('#container');

    $container.isotope({
			  // options...
	});
	$container.imagesLoaded( function(){
			  $container.isotope({
			    // options...
			  });
	});
			
    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.box',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'Keine weiteren Beiträge.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
		
		$.each($(newElements), function(index, value){
	    	item_click_events($(value));
	    });
				
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.isotope( 'appended', $newElems, true );
        });
      }
    );
	
	
     /**
	 * OPTIONAL!
	 * Load new pages by clicking a link
	 */
	
  });


	$(document).ready(function () {
		$.each($('.box'), function(index, value){
			item_click_events($(value));
		});
		$.each($('.item-media'), function(index, value){
			item_click_events($(value));
		});
		$.each($('.badge-featured-item'), function(index, value){
			item_click_events($(value));
		});
	});
	
	function item_click_events(item){
		media_news_gif(item);
	}
	
	function media_news_gif(object){
		var gifs = $(object).find('.gif-post .animation');
		var gif_play = $(object).find('.play');
		gif_click(gifs);
		gif_click(gif_play);
	}

	function gif_click(object){
		$(object).click(function(){
			animated_gif = $(this).parent('.gif-post').find('.animation');
			play_icon = $(this).parent('.gif-post').find('.play');
			toggle_gif(animated_gif, play_icon);
		});
	}
	
	function toggle_gif(img, icon){
		if($(img).data('state') == 0){
			play_gif(img, icon);
		} else {
			stop_gif(img, icon);
		}
	}

	function play_gif(img, icon){
		$(img).attr('src', $(img).data('animation'));
		$(img).data('state', 1);
		$(icon).fadeOut();
	}

	function stop_gif(img, icon){
		$(img).attr('src', $(img).data('original'));
		$(img).data('state', 0);
		$(icon).fadeIn();
	}
	


function verify_age() {
	
		//get the id
		the_id = $(this).attr('class');
		$.cookie("age",1,{expires:30,path:'/',});
		window.location.reload(true);
	
	}
	
	function verify_age_modal() {
	
		//get the id
		the_id = $(this).attr('class');
		$.cookie("age_modal",1,{expires:30,path:'/',});
		window.location.reload(true);
	
	}
	

		

    function fbshare(url) {
		var left 	= (screen.width/2) - 333,
        	top 	= (screen.height/2) - 175;
        window.open ("http://www.facebook.com/share.php?u="+url,'Facebook', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=660, height=350, top=' + top + ', left=' + left);        
    }
	
	function twittershare(title, url) {
		var left 	= (screen.width/2) - 333,
        	top 	= (screen.height/2) - 175;
        window.open ("http://twitter.com/home?status="+title+" "+url,'Twitter', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=660, height=350, top=' + top + ', left=' + left);        
    }
	
	function googleshare(url) {
		var left 	= (screen.width/2) - 333,
        	top 	= (screen.height/2) - 175;
        window.open ("https://plus.google.com/share?url="+url,'Google+', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=660, height=350, top=' + top + ', left=' + left);        
    }
	
	
// Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
//       It will only set the 'top' and 'position' of your element, you
//       might need to adjust the width in some cases.

(function($) {
  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: ''
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css('position', '')
              .css('top', '');
            s.stickyElement.parent().removeClass(s.className);
            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop != newTop) {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop);

            if (typeof s.getWidthFrom !== 'undefined') {
              s.stickyElement.css('width', $(s.getWidthFrom).width());
            }

            s.stickyElement.parent().addClass(s.className);
            s.currentTop = newTop;
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();
    },
    methods = {
      init: function(options) {
        var o = $.extend(defaults, options);
        return this.each(function() {
          var stickyElement = $(this);

          var stickyId = stickyElement.attr('id');
          var wrapper = $('<div></div>')
            .attr('id', stickyId + '-sticky-wrapper')
            .addClass(o.wrapperClassName);
          stickyElement.wrapAll(wrapper);

          if (o.center) {
            stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") == "right") {
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          var stickyWrapper = stickyElement.parent();
          stickyWrapper.css('height', stickyElement.outerHeight());
          sticked.push({
            topSpacing: o.topSpacing,
            bottomSpacing: o.bottomSpacing,
            stickyElement: stickyElement,
            currentTop: null,
            stickyWrapper: stickyWrapper,
            className: o.className,
            getWidthFrom: o.getWidthFrom
          });
        });
      },
      update: scroller
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));

    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };
  $(function() {
    setTimeout(scroller, 0);
  });
})(jQuery);



$(document).ready(function() {
   $(window).scroll(function() {
       var scrollVal = $(this).scrollTop();
        if ( scrollVal > 140) {
            $('fixed-toolbar').css({'position':'fixed','top' :'0px'});
        } else {
            $('fixed-toolbar').css({'position':'static','top':'auto'});
        }
    });
 });
 
var MC=MC||{};MC.cPC=function(a,b){typeof OnColorChanged!=="undefined"&&OnColorChanged(a,b)};MC.ColorPicker=function(){var b=function(a,b,c){if(a.addEventListener)a.addEventListener(b,c,false);else if(a.attachEvent)a.attachEvent("on"+b,c);else a["on"+b]=c},d=function(a){if(!a)return 0;var b=/(^| )color( |$)/;return b.test(a)},a,c=function(){this.a=this.b=this.c=null;this.i=-1;this.R=[];this.S=[];this.h()};c.prototype={d:function(b){var a=document.createElement("div");a.className="clear";b.appendChild(a)},e:function(b,c,d){var a=document.createElement("div");if(b=="TT"){a.className="transChooser";a.setAttribute("rgb","transparent")}else{a.style.backgroundColor="#"+b+d+c;a.setAttribute("rgb","#"+b+d+c)}return a},f:function(a){a.cancelBubble=true;a.f&&a.f()},g:function(){for(var b,a=this.c,h=["00","00","11","22","33","44","55","66","77","88","99","AA","BB","CC","DD","EE","FF","TT"],g=0;g<18;g++){b=this.e(h[g],h[g],h[g]);a.appendChild(b)}this.d(a);for(var d=["00","33","66","99","CC","FF"],c=0;c<6;c++){for(var f=0;f<3;f++)for(var e=0;e<6;e++){b=this.e(d[f],d[e],d[c]);a.appendChild(b)}this.d(a)}this.d(a);for(var c=0;c<6;c++){for(var f=3;f<6;f++)for(var e=0;e<6;e++){b=this.e(d[f],d[e],d[c]);a.appendChild(b)}this.d(a)}},h:function(){this.r=document.createElement("div");this.r.id="colorpicker";this.a=document.createElement("div");this.a.id="hexBox";this.b=document.createElement("div");this.b.id="bgBox";this.c=document.createElement("div");this.c.id="colorContainer";this.j();this.r.appendChild(this.a);this.r.appendChild(this.b);this.r.appendChild(this.c);this.g();this.m();var a=this;b(document.body,"click",function(){if(a.i>-1)a.S[a.i].style.zIndex=1;a.o()})},j:function(){b(this.c,"mouseover",this.k);b(this.c,"click",this.l)},k:function(b){if(b.target)var c=b.target;else c=b.srcElement;if(c.id!="colorContainer")a.b.style.backgroundColor=a.a.innerHTML=c.getAttribute("rgb");a.f(b)},l:function(c){if(c.target)var b=c.target;else b=c.srcElement;if(b.id!="colorContainer"){a.S[a.i].style.backgroundColor=a.R[a.i].value=b.getAttribute("rgb");a.S[a.i].style.zIndex=1;a.o();MC.cPC(b.style.backgroundColor,a.i)}a.f(c)},m:function(){for(var c=document.getElementsByTagName("input"),e=this,b=0,f=c.length;b<f;b++)if(d(c[b].className)){var a=this.R.length;if(c[b].i===undefined){this.R[a]=c[b];this.R[a].i=a;this.R[a].onchange=function(){e.n(e.S[this.i],this)};this.S[a]=document.createElement("span");this.S[a].i=a;this.S[a].className="colorChooser";this.R[a].parentNode.insertBefore(this.S[a],this.R[a].nextSibling);this.p(this.S[a]);this.n(this.S[a],this.R[a])}}},n:function(b,a){try{b.style.backgroundColor=a.value}catch(c){}},o:function(){this.r.style.display="none"},p:function(c){var a=this;b(c,"click",function(b){if(a.i>-1)a.S[a.i].style.zIndex=1;a.i=c.i;c.appendChild(a.r).style.display="block";a.S[a.i].style.zIndex=2;a.f(b)})}};var e=function(){if(!a)a=new c};b(window,"load",e);return{refresh:function(){for(var b=0,c=a.R.length;b<c;b++)a.n(a.S[b],a.R[b])},reload:function(){a.m()}}}()

