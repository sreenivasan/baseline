/*!
  hey, [be]Lazy.js - v1.5.4 - 2016.03.06
  A fast, small and dependency free lazy load script (https://github.com/dinbror/blazy)
  (c) Bjoern Klinggaard - @bklinggaard - http://dinbror.dk/blazy
*/
  (function(k,f){"function"===typeof define&&define.amd?define(f):"object"===typeof exports?module.exports=f():k.Blazy=f()})(this,function(){function k(b){setTimeout(function(){var c=b._util;c.elements=w(b.options.selector);c.count=c.elements.length;c.destroyed&&(c.destroyed=!1,b.options.container&&h(b.options.container,function(a){l(a,"scroll",c.validateT)}),l(window,"resize",c.saveViewportOffsetT),l(window,"resize",c.validateT),l(window,"scroll",c.validateT));f(b)},1)}function f(b){for(var c=b._util,a=0;a<c.count;a++){var d=c.elements[a],g=d.getBoundingClientRect();if(g.right>=e.left&&g.bottom>=e.top&&g.left<=e.right&&g.top<=e.bottom||n(d,b.options.successClass))b.load(d),c.elements.splice(a,1),c.count--,a--}0===c.count&&b.destroy()}function q(b,c,a){if(!n(b,a.successClass)&&(c||a.loadInvisible||0<b.offsetWidth&&0<b.offsetHeight))if(c=b.getAttribute(p)||b.getAttribute(a.src)){c=c.split(a.separator);var d=c[r&&1<c.length?1:0],g="img"===b.nodeName.toLowerCase();g||void 0===b.src?(c=new Image,c.onerror=function(){a.error&&a.error(b,"invalid");b.className=b.className+" "+a.errorClass},c.onload=function(){g?b.src=d:b.style.backgroundImage='url("'+d+'")';t(b,a)},c.src=d):(b.src=d,t(b,a))}else a.error&&a.error(b,"missing"),n(b,a.errorClass)||(b.className=b.className+" "+a.errorClass)}function t(b,c){b.className=b.className+" "+c.successClass;c.success&&c.success(b);h(c.breakpoints,function(a){b.removeAttribute(a.src)});b.removeAttribute(c.src)}function n(b,c){return-1!==(" "+b.className+" ").indexOf(" "+c+" ")}function w(b){var c=[];b=document.querySelectorAll(b);for(var a=b.length;a--;c.unshift(b[a]));return c}function u(b){e.bottom=(window.innerHeight||document.documentElement.clientHeight)+b;e.right=(window.innerWidth||document.documentElement.clientWidth)+b}function l(b,c,a){b.attachEvent?b.attachEvent&&b.attachEvent("on"+c,a):b.addEventListener(c,a,!1)}function m(b,c,a){b.detachEvent?b.detachEvent&&b.detachEvent("on"+c,a):b.removeEventListener(c,a,!1)}function h(b,c){if(b&&c)for(var a=b.length,d=0;d<a&&!1!==c(b[d],d);d++);}function v(b,c,a){var d=0;return function(){var g=+new Date;g-d<c||(d=g,b.apply(a,arguments))}}var p,e,r;return function(b){if(!document.querySelectorAll){var c=document.createStyleSheet();document.querySelectorAll=function(a,b,d,e,f){f=document.all;b=[];a=a.replace(/\[for\b/gi,"[htmlFor").split(",");for(d=a.length;d--;){c.addRule(a[d],"k:v");for(e=f.length;e--;)f[e].currentStyle.k&&b.push(f[e]);c.removeRule(0)}return b}}var a=this,d=a._util={};d.elements=[];d.destroyed=!0;a.options=b||{};a.options.error=a.options.error||!1;a.options.offset=a.options.offset||100;a.options.success=a.options.success||!1;a.options.selector=a.options.selector||".b-lazy";a.options.separator=a.options.separator||"|";a.options.container=a.options.container?document.querySelectorAll(a.options.container):!1;a.options.errorClass=a.options.errorClass||"b-error";a.options.breakpoints=a.options.breakpoints||!1;a.options.loadInvisible=a.options.loadInvisible||!1;a.options.successClass=a.options.successClass||"b-loaded";a.options.validateDelay=a.options.validateDelay||25;a.options.saveViewportOffsetDelay=a.options.saveViewportOffsetDelay||50;a.options.src=p=a.options.src||"data-src";r=1<window.devicePixelRatio;e={};e.top=0-a.options.offset;e.left=0-a.options.offset;a.revalidate=function(){k(this)};a.load=function(a,b){var c=this.options;void 0===a.length?q(a,b,c):h(a,function(a){q(a,b,c)})};a.destroy=function(){var a=this._util;this.options.container&&h(this.options.container,function(b){m(b,"scroll",a.validateT)});m(window,"scroll",a.validateT);m(window,"resize",a.validateT);m(window,"resize",a.saveViewportOffsetT);a.count=0;a.elements.length=0;a.destroyed=!0};d.validateT=v(function(){f(a)},a.options.validateDelay,a);d.saveViewportOffsetT=v(function(){u(a.options.offset)},a.options.saveViewportOffsetDelay,a);u(a.options.offset);h(a.options.breakpoints,function(a){if(a.width>=window.screen.width)return p=a.src,!1});k(a)}});

/**
 * Copyright (c) 2007-2015 Ariel Flesler - aflesler ○ gmail • com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 2.1.3
 */
;(function(f){"use strict";"function"===typeof define&&define.amd?define(["jquery"],f):"undefined"!==typeof module&&module.exports?module.exports=f(require("jquery")):f(jQuery)})(function($){"use strict";function n(a){return!a.nodeName||-1!==$.inArray(a.nodeName.toLowerCase(),["iframe","#document","html","body"])}function h(a){return $.isFunction(a)||$.isPlainObject(a)?a:{top:a,left:a}}var p=$.scrollTo=function(a,d,b){return $(window).scrollTo(a,d,b)};p.defaults={axis:"xy",duration:0,limit:!0};$.fn.scrollTo=function(a,d,b){"object"=== typeof d&&(b=d,d=0);"function"===typeof b&&(b={onAfter:b});"max"===a&&(a=9E9);b=$.extend({},p.defaults,b);d=d||b.duration;var u=b.queue&&1<b.axis.length;u&&(d/=2);b.offset=h(b.offset);b.over=h(b.over);return this.each(function(){function k(a){var k=$.extend({},b,{queue:!0,duration:d,complete:a&&function(){a.call(q,e,b)}});r.animate(f,k)}if(null!==a){var l=n(this),q=l?this.contentWindow||window:this,r=$(q),e=a,f={},t;switch(typeof e){case "number":case "string":if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(e)){e= h(e);break}e=l?$(e):$(e,q);case "object":if(e.length===0)return;if(e.is||e.style)t=(e=$(e)).offset()}var v=$.isFunction(b.offset)&&b.offset(q,e)||b.offset;$.each(b.axis.split(""),function(a,c){var d="x"===c?"Left":"Top",m=d.toLowerCase(),g="scroll"+d,h=r[g](),n=p.max(q,c);t?(f[g]=t[m]+(l?0:h-r.offset()[m]),b.margin&&(f[g]-=parseInt(e.css("margin"+d),10)||0,f[g]-=parseInt(e.css("border"+d+"Width"),10)||0),f[g]+=v[m]||0,b.over[m]&&(f[g]+=e["x"===c?"width":"height"]()*b.over[m])):(d=e[m],f[g]=d.slice&& "%"===d.slice(-1)?parseFloat(d)/100*n:d);b.limit&&/^\d+$/.test(f[g])&&(f[g]=0>=f[g]?0:Math.min(f[g],n));!a&&1<b.axis.length&&(h===f[g]?f={}:u&&(k(b.onAfterFirst),f={}))});k(b.onAfter)}})};p.max=function(a,d){var b="x"===d?"Width":"Height",h="scroll"+b;if(!n(a))return a[h]-$(a)[b.toLowerCase()]();var b="client"+b,k=a.ownerDocument||a.document,l=k.documentElement,k=k.body;return Math.max(l[h],k[h])-Math.min(l[b],k[b])};$.Tween.propHooks.scrollLeft=$.Tween.propHooks.scrollTop={get:function(a){return $(a.elem)[a.prop]()}, set:function(a){var d=this.get(a);if(a.options.interrupt&&a._last&&a._last!==d)return $(a.elem).stop();var b=Math.round(a.now);d!==b&&($(a.elem)[a.prop](b),a._last=this.get(a))}};return p});
/**
 * Copyright (c) 2007-2015 Ariel Flesler - aflesler<a>gmail<d>com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 1.4.0
 */
;(function(a){if(typeof define==='function'&&define.amd){define(['jquery'],a)}else{a(jQuery)}}(function($){var g=location.href.replace(/#.*/,'');var h=$.localScroll=function(a){$('body').localScroll(a)};h.defaults={duration:1000,axis:'y',event:'click',stop:true,target:window};$.fn.localScroll=function(a){a=$.extend({},h.defaults,a);if(a.hash&&location.hash){if(a.target)window.scrollTo(0,0);scroll(0,location,a)}return a.lazy?this.on(a.event,'a,area',function(e){if(filter.call(this)){scroll(e,this,a)}}):this.find('a,area').filter(filter).bind(a.event,function(e){scroll(e,this,a)}).end().end();function filter(){return!!this.href&&!!this.hash&&this.href.replace(this.hash,'')===g&&(!a.filter||$(this).is(a.filter))}};h.hash=function(){};function scroll(e,a,b){var c=a.hash.slice(1),elem=document.getElementById(c)||document.getElementsByName(c)[0];if(!elem)return;if(e)e.preventDefault();var d=$(b.target);if(b.lock&&d.is(':animated')||b.onBefore&&b.onBefore(e,elem,d)===false)return;if(b.stop){d.stop(true)}if(b.hash){var f=elem.id===c?'id':'name',$a=$('<a> </a>').attr(f,c).css({position:'absolute',top:$(window).scrollTop(),left:$(window).scrollLeft()});elem[f]='';$('body').prepend($a);location.hash=a.hash;$a.remove();elem[f]=c}d.scrollTo(elem,b).trigger('notify.serialScroll',[elem])}return h}));

/*! http://tinynav.viljamis.com v1.2 by @viljamis */
(function(a,k,g){a.fn.tinyNav=function(l){var c=a.extend({active:"selected",header:"",indent:"- ",label:""},l);return this.each(function(){g++;var h=a(this),b="tinynav"+g,f=".l_"+b,e=a("<select/>").attr("id",b).addClass("tinynav "+b);if(h.is("ul,ol")){""!==c.header&&e.append(a("<option/>").text(c.header));var d="";h.addClass("l_"+b).find("a").each(function(){d+='<option value="'+a(this).attr("href")+'">';var b;for(b=0;b<a(this).parents("ul, ol").length-1;b++)d+=c.indent;d+=a(this).text()+"</option>"});
e.append(d);c.header||e.find(":eq("+a(f+" li").index(a(f+" li."+c.active))+")").attr("selected",!0);e.change(function(){k.location.href=a(this).val()});a(f).after(e);c.label&&e.before(a("<label/>").attr("for",b).addClass("tinynav_label "+b+"_label").append(c.label))}})}})(jQuery,this,0);

/* spin.js - ajax loading animation */
(function(t,e){if(typeof exports=="object")module.exports=e();else if(typeof define=="function"&&define.amd)define(e);else t.Spinner=e()})(this,function(){"use strict";var t=["webkit","Moz","ms","O"],e={},i;function o(t,e){var i=document.createElement(t||"div"),o;for(o in e)i[o]=e[o];return i}function n(t){for(var e=1,i=arguments.length;e<i;e++)t.appendChild(arguments[e]);return t}var r=function(){var t=o("style",{type:"text/css"});n(document.getElementsByTagName("head")[0],t);return t.sheet||t.styleSheet}();function s(t,o,n,s){var a=["opacity",o,~~(t*100),n,s].join("-"),f=.01+n/s*100,l=Math.max(1-(1-t)/o*(100-f),t),u=i.substring(0,i.indexOf("Animation")).toLowerCase(),d=u&&"-"+u+"-"||"";if(!e[a]){r.insertRule("@"+d+"keyframes "+a+"{"+"0%{opacity:"+l+"}"+f+"%{opacity:"+t+"}"+(f+.01)+"%{opacity:1}"+(f+o)%100+"%{opacity:"+t+"}"+"100%{opacity:"+l+"}"+"}",r.cssRules.length);e[a]=1}return a}function a(e,i){var o=e.style,n,r;i=i.charAt(0).toUpperCase()+i.slice(1);for(r=0;r<t.length;r++){n=t[r]+i;if(o[n]!==undefined)return n}if(o[i]!==undefined)return i}function f(t,e){for(var i in e)t.style[a(t,i)||i]=e[i];return t}function l(t){for(var e=1;e<arguments.length;e++){var i=arguments[e];for(var o in i)if(t[o]===undefined)t[o]=i[o]}return t}function u(t){var e={x:t.offsetLeft,y:t.offsetTop};while(t=t.offsetParent)e.x+=t.offsetLeft,e.y+=t.offsetTop;return e}function d(t,e){return typeof t=="string"?t:t[e%t.length]}var p={lines:12,length:7,width:5,radius:10,rotate:0,corners:1,color:"#000",direction:1,speed:1,trail:100,opacity:1/4,fps:20,zIndex:2e9,className:"spinner",top:"auto",left:"auto",position:"relative"};function c(t){if(typeof this=="undefined")return new c(t);this.opts=l(t||{},c.defaults,p)}c.defaults={};l(c.prototype,{spin:function(t){this.stop();var e=this,n=e.opts,r=e.el=f(o(0,{className:n.className}),{position:n.position,width:0,zIndex:n.zIndex}),s=n.radius+n.length+n.width,a,l;if(t){t.insertBefore(r,t.firstChild||null);l=u(t);a=u(r);f(r,{left:(n.left=="auto"?l.x-a.x+(t.offsetWidth>>1):parseInt(n.left,10)+s)+"px",top:(n.top=="auto"?l.y-a.y+(t.offsetHeight>>1):parseInt(n.top,10)+s)+"px"})}r.setAttribute("role","progressbar");e.lines(r,e.opts);if(!i){var d=0,p=(n.lines-1)*(1-n.direction)/2,c,h=n.fps,m=h/n.speed,y=(1-n.opacity)/(m*n.trail/100),g=m/n.lines;(function v(){d++;for(var t=0;t<n.lines;t++){c=Math.max(1-(d+(n.lines-t)*g)%m*y,n.opacity);e.opacity(r,t*n.direction+p,c,n)}e.timeout=e.el&&setTimeout(v,~~(1e3/h))})()}return e},stop:function(){var t=this.el;if(t){clearTimeout(this.timeout);if(t.parentNode)t.parentNode.removeChild(t);this.el=undefined}return this},lines:function(t,e){var r=0,a=(e.lines-1)*(1-e.direction)/2,l;function u(t,i){return f(o(),{position:"absolute",width:e.length+e.width+"px",height:e.width+"px",background:t,boxShadow:i,transformOrigin:"left",transform:"rotate("+~~(360/e.lines*r+e.rotate)+"deg) translate("+e.radius+"px"+",0)",borderRadius:(e.corners*e.width>>1)+"px"})}for(;r<e.lines;r++){l=f(o(),{position:"absolute",top:1+~(e.width/2)+"px",transform:e.hwaccel?"translate3d(0,0,0)":"",opacity:e.opacity,animation:i&&s(e.opacity,e.trail,a+r*e.direction,e.lines)+" "+1/e.speed+"s linear infinite"});if(e.shadow)n(l,f(u("#000","0 0 4px "+"#000"),{top:2+"px"}));n(t,n(l,u(d(e.color,r),"0 0 1px rgba(0,0,0,.1)")))}return t},opacity:function(t,e,i){if(e<t.childNodes.length)t.childNodes[e].style.opacity=i}});function h(){function t(t,e){return o("<"+t+' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',e)}r.addRule(".spin-vml","behavior:url(#default#VML)");c.prototype.lines=function(e,i){var o=i.length+i.width,r=2*o;function s(){return f(t("group",{coordsize:r+" "+r,coordorigin:-o+" "+-o}),{width:r,height:r})}var a=-(i.width+i.length)*2+"px",l=f(s(),{position:"absolute",top:a,left:a}),u;function p(e,r,a){n(l,n(f(s(),{rotation:360/i.lines*e+"deg",left:~~r}),n(f(t("roundrect",{arcsize:i.corners}),{width:o,height:i.width,left:i.radius,top:-i.width>>1,filter:a}),t("fill",{color:d(i.color,e),opacity:i.opacity}),t("stroke",{opacity:0}))))}if(i.shadow)for(u=1;u<=i.lines;u++)p(u,-2,"progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");for(u=1;u<=i.lines;u++)p(u);return n(e,l)};c.prototype.opacity=function(t,e,i,o){var n=t.firstChild;o=o.shadow&&o.lines||0;if(n&&e+o<n.childNodes.length){n=n.childNodes[e+o];n=n&&n.firstChild;n=n&&n.firstChild;if(n)n.opacity=i}}}var m=f(o("group"),{behavior:"url(#default#VML)"});if(!a(m,"transform")&&m.adj)h();else i=a(m,"animation");return c});

/*global jQuery */
/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement('div');
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery );


(function(factory) {

  if (typeof exports == 'object') {
    // CommonJS
    factory(require('jquery'), require('spin'));
  }
  else if (typeof define == 'function' && define.amd) {
    // AMD, register as anonymous module
    define(['jquery', 'spin'], factory);
  }
  else {
    // Browser globals
    if (!window.Spinner) throw new Error('Spin.js not present');
    factory(window.jQuery, window.Spinner);
  }

}(function($, Spinner) {

  $.fn.spin = function(opts, color) {

    return this.each(function() {
      var $this = $(this),
        data = $this.data();

      if (data.spinner) {
        data.spinner.stop();
        delete data.spinner;
      }
      if (opts !== false) {
        opts = $.extend(
          { color: color || $this.css('color') },
          $.fn.spin.presets[opts] || opts
        )
        data.spinner = new Spinner(opts).spin(this)
      }
    })
  }

  $.fn.spin.presets = {
    tiny_1: { lines: 8, length: 2, width: 2, radius: 3, hwaccel: true, corners: 1 },
    tiny: { lines: 9, length: 0, width: 4, radius: 9, hwaccel: true, corners: 1 },
    large: { lines: 10, length: 8, width: 4, radius: 8, hwaccel: true, corners: 1 }
  }

}));

// Functions
function urlParam(name){
	var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if (!results) { return 0; }
	return results[1] || 0;
}

(function($){
	$.fn.ajaxLink = function(isSingle, uniqueID){
		jQuery(this).each(function(){
			jQuery(this).on('click',function(e){
				e.preventDefault();
				var ajaxSourceURL = jQuery(this).href;
				var ajaxSourceElem = jQuery(this).attr('data-ajax-source');
				var ajaxDest = jQuery(this).attr('data-ajax-dest');
				if (!isSingle){ 
					jQuery('.ajax-link.active').removeClass('active');
					jQuery(this).addClass('active');
				}
				jQuery(ajaxDest).fadeOut(function(){
					jQuery(this)
						.empty()
						.spin('small')
						.addClass('loading')
						.fadeIn('fast')
						.load(ajaxSourceURL + ' ' + ajaxSourceElem, function(){
							jQuery(ajaxDest).spin(false).removeClass('loading');
							jQuery(ajaxDest + " img.lazy").unveil(100);
							jQuery.localScroll();
						});
				});
			});
		});
		return this;
	}
}(jQuery));
// Localize the time with browser settings
(function($){
	$.fn.localizeTime = function(options){
		return this.each(function(){
			var timeFormat = $.extend({
				hour:"2-digit", 
				minute:"2-digit",
				timeZoneName:"short",
			}, options );
			var actionTime = new Date( jQuery(this).attr('data-time') );
			if ( typeof actionTime.toLocaleTimeString === "function" ){
				var actionTimeLocal = actionTime.toLocaleTimeString( [], { timeFormat } );
				if ( actionTimeLocal ){
					jQuery(this).html( actionTimeLocal );
				}
			}
		});
	};
}(jQuery));
// Localize the date with browser settings
(function($){
	$.fn.localizeDate = function(dateOptions){
		return this.each(function(){
			var dateFormat = $.extend({
				month:"short", 
				day:"2-digit", 
			}, dateOptions );
			var actionDate = new Date( jQuery(this).attr('data-time') );
			if ( typeof actionDate.toLocaleDateString === "function" ){
				var actionDateLocal = actionDate.toLocaleDateString( [], { dateFormat } );
				if ( actionDateLocal ){
					jQuery(this).html( actionDateLocal );
				}
			}
		});
	};
}(jQuery));
/**
 * Take multiple children, hide all but the first N, and add a "read more" link
 */
(function($){
	jQuery.fn.truncateAndReadMore = function(){
		// Set up translations
		var readMoreTranslations = {
			en: "Read&nbsp;More&hellip;",
			fr: "Lire&nbsp;la&nbsp;Suite&nbsp;&hellip;",
      ar: "اقرأ أكثر"
		};
		var readMoreText = readMoreTranslations['en'];
		// Detect language
		var htmlLangAttr = $('html').attr('lang');
		if ( htmlLangAttr && readMoreTranslations[htmlLangAttr] ){
			readMoreText = readMoreTranslations[htmlLangAttr];
		}
		// For each element targeted...
		return this.each(function(){
      // get number of paragraphs to hide
      var visElems = $(this).attr('data-read-more-after');
      var visElems = (visElems > 0) ? visElems : 2 ;
			// Set up click handler function 
			jQuery(this).on('readMoreEventSetup', function(){
				var target = jQuery(this);
				jQuery(this).find('.read-more').on('click', function(e){
					e.preventDefault();
					jQuery(this).hide();
					target.children(':hidden').fadeIn();
				});
			});
			// Make sure there's more than N children element in the container
			var firstParaSibs = jQuery(this).children();
			// Hide extra para's, add "read more", trigger click handler setup event
			if ( firstParaSibs.length > visElems){
				firstParaSibs
					.not('.do-not-hide')
					.hide()
					.siblings(":lt(" + (visElems-1) + ")") // uses zero-based index counting
          .addBack(":eq(0)") // I'm not entirely sure why the first element gets skipped, but apparently it does, so add it back
					.show()
          .last()
					.append(' <a class="read-more">' + readMoreText +'</a>')
					.trigger('readMoreEventSetup');
			}

		});
	}
}(jQuery));
// Modal
(function($){
  $.fn.modal = function(){
    return this.each(function(){
      // check for option to disable automatic hiding of source element
      var showSourceElem = $(this).attr('data-modal-show-source');
      // get the ID of the element that contains the content for the modal from the "data-modal-source" attribute in the HTML tag
      var modalSourceID = $(this).attr('data-modal-source');
      var modalSourceElem = $( modalSourceID );
      // if showing the source element...
      if (showSourceElem){
        modalSourceElem.removeClass('hidden js-hidden');
      } else {
        // Make sure the modal source element is hidden only with inline styles
        modalSourceElem.hide().removeClass('hidden js-hidden');
      }
      // get the optional list of classes to add to the inner content area from the "data-modal-classes-inner" attribute in the HTML tag
      var modalInnerClassesAttr = $(this).attr('data-modal-classes-inner');
      // use the default classes to set the inner modal to be a white box with lots of padding
			var modalInnerClasses = 'box box-huge bg-white'; 
			if ( modalInnerClassesAttr ){
				modalInnerClasses = modalInnerClassesAttr;
			}
			// get the optional list of classes to add to the inner content area from the "data-modal-classes-outer" attribute in the HTML tag
			var modalOuterClassesAttr = $(this).attr('data-modal-classes-outer');
			// use the default classes to set the modal container to have a transparent dark gray background and lots of horizontal padding
			var modalOuterClasses = 'bg-dkgray-trans width-narrow'; 
			if ( modalOuterClassesAttr ){
				modalOuterClasses = modalOuterClassesAttr;
			}

			// set up the click event
			$(this).on('click', function(e){
				e.preventDefault();
        // unhide the source element before appending it to the modal window
        modalSourceElem.show();
        // assemble the outer and inner modal wrappers around the content
        var modal = '<div class="modal-wrapper section ' + modalOuterClasses + '"><div class="modal-content section-inner ' + modalInnerClasses + '"><a class="modal-close">X</a></div></div>';

				// append the modal before the closing </body> tag and add the class "open" (which hooks into CSS3 animations)
				// NOTE: animate() is used just to provide a slight delay before adding the 'open' class, which is necessary to trigger CSS3 animation (for some reason)
				$(modal).appendTo('body').animate({borderRightWidth:0},10, function(){
					$(this).addClass('open').children('.section-inner').append(modalSourceElem);
				});
				$('body').addClass("no-scroll");
				// set up the "close modal" function
				function modalClose(){
					$('body').removeClass('no-scroll');
					$('.modal-wrapper').removeClass('open').animate({borderRightWidth:0}, 400, function(){
						$(this).remove();
					});
					$(document).unbind("keyup", modalClose );
				}
				// call modalClose() when the "close" button is clicked
				$('.modal-close').on('click', function(event){
					modalClose();
					event.stopPropagation();
				});
				// call modalClose() when the modal background is clicked
				$('.modal-wrapper').on('click', function(){
					modalClose();
				});
				// stop clicks in the modal content from propagating up and triggering a "close" event
				$('.modal-content').on('click',function(event){
					event.stopPropagation();
				});
				// call modalClose() when the Esc key is pressed
				$(document).keyup(function(e){
		     		if (e.keyCode == 27) { 
		     			modalClose();
		     		}
		    	});
			});
		});
	}
}(jQuery));
(function($){
	jQuery.fn.newWindowPopup = function(){
		jQuery(this).on('click', function(e){
		    e.preventDefault();
		    var destination = jQuery(this).attr('href');
			var popupWidthAttr = jQuery(this).attr('data-popup-width');
			var popupHeightAttr = jQuery(this).attr('data-popup-height');
			if ( jQuery(this).is('.fb-share, .button-facebook, .button-share-facebook') ){
				popupWidth = 520;
				popupHeight = 350;
			} else if ( jQuery(this).is('.tw-share, .button-twitter, .button-share-twitter') ){
				popupWidth = 550;
				popupHeight = 420;
			} else if ( popupHeightAttr || popupWidthAttr ){
				if ( popupHeightAttr ){
					popupHeight = popupHeightAttr;
				}
				if ( popupWidthAttr ){
					popupWidth = popupWidthAttr;
				}
			} else {
				popupWidth = 500;
				popupHeight = 500;
			}
			var winTop = (screen.height / 2) - (popupHeight / 2);
			var winLeft = (screen.width / 2) - (popupWidth / 2);
	    	window.open( destination , 'new-window-popup', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,resizable=yes,scrollbars=yes,width=' + popupWidth + ',height=' + popupHeight );
	    });
	}
}(jQuery));
// Expandooo
(function($){
  $.fn.expando = function(){
    $(this).each(function(){
      var expandoText = $(this).attr("title");
      var expandoText2 = $(this).find('h1,h2,h3,h4,h5,h6').first().addClass('hidden').html();
      var expandoText3raw = $(this).children().first().text();
      var expandoText3 = expandoText3raw.substring(0,60);
      var expandedOnLoad = $(this).hasClass('expanded');
      
      if ( expandoText ){
        $(this).wrapInner('<div class="expando-inner" />').prepend('<a class="expando-link" href="#">' + expandoText + '</a>');
        console.log('expandoText1!');
      } else if (expandoText2) {
        $(this).wrapInner('<div class="expando-inner" />').prepend('<a class="expando-link" href="#">' + expandoText2 + '</a>');
        console.log('expandoText2!');
      } else if (expandoText3) {
        $(this).wrapInner('<div class="expando-inner" />').prepend('<a class="expando-link" href="#">' + expandoText3 + '...</a>');
        console.log('expandoText3!');
      } else {    
        $(this).wrapInner('<div class="expando-inner" />').prepend('<a class="expando-link" href="#">Click to expand</a>');
      };
      // if 
      if ( !expandedOnLoad ){
        $(this).addClass('collapsed');
      }

    });
    $("a.expando-link").click(function(e){
      e.preventDefault();
      $(this)
        .parent()
        .toggleClass('expanded')
        .toggleClass('collapsed');
    });
    return this;
  }
}(jQuery));

// find adjacent identical siblings and wrap them with a tag
(function($){
	$.fn.findAdjacentSibsAndWrap = function( sibFilter, wrapperTag ){
		$(this)
			.first()
			.nextAll( sibFilter + " + " + sibFilter)
			.addBack()
			.wrapAll('<' + wrapperTag + '/>');
	}
}(jQuery));

// use data-preselect to pre-select options within <select> tags
(function($){
	$.fn.preselect = function(){
		return this.each(function(){
			var preselectOption = $(this).attr('data-preselect');
			$(this).val( preselectOption ).change();
		});
	}
}(jQuery));

// Retrieve and display the total action count from one or more AK pages
(function($){
	jQuery.fn.akGetActionCount = function(){
		return this.each(function(){
			var akPages = $(this).attr('data-action-count-pages');
			var akPagesStart = parseInt( $(this).text() );
			var akCount = akPagesStart ? akPagesStart : 0;
			akPages = akPages ? ( (akPages).trim() ).split(' ') : null;

		    if ( akPages ){ 
			    for ( var i = 0, akPagesLength = akPages.length; i < akPagesLength; i++ ){
			    	$.ajax({
			    		context: this,
						url: '//350.actionkit.com/progress/?page=' + akPages[i],
						dataType: 'jsonp',
						success: function(data) {
							var returnCount = parseInt( data.total.actions );
							akCount = akCount + returnCount;
		    				$(this).html( akCount );
						}
					});
			    }
		    }
		});
	}
}(jQuery));

// as the page loads, call these scripts
jQuery(document).ready(function($) {
	$('html').removeClass('no-js').addClass('js');
	var responsive_viewport = $(window).width();
	$('.js-modal').modal();
	$('.js-modal-onload').trigger('click');
	$('.lazy').parent().spin('tiny');
	// for AK-style form fields, wrap adjacent sibs in fieldset
	$('.form-style-labelabove .input-text').findAdjacentSibsAndWrap('.input-text', 'fieldset class="input-group"');
	$('[data-preselect]').preselect();
	var bLazy = new Blazy({ 
		breakpoints: [
			{
				width: 650,
				src: 'data-src-small',
    		},
			{
				width: 1024,
				src: 'data-src-medium',
			}
    	],
    	success: function(ele){
    		var parent = ele.parentNode;
            $(ele).parent().spin(false);
            $(".video-wrapper").fitVids();
        },
        error: function(ele){
        	var parent = ele.parentNode;
            $(ele).parent().spin(false);
        },
        offset: 300,
        selector: '.lazy',
    });
    $('.js-localize-time').localizeTime();
    $('.js-localize-date').localizeDate();
	$('.ajax-link').ajaxLink();
	$.localScroll.hash({
		onBefore: function( e, anchor, $target ){
			var ifExpando = $(anchor).hasClass('expando');
			if( ifExpando ){
				$(anchor).find('.expando-link').trigger('click');
			}
		},
		offset: -70,
	});
	$.localScroll({
		filter: ':not(.js-modal)',
		// if anchor linking to an expando section, expand it before scrolling to it
		onBefore: function( e, anchor, $target ){
			var ifExpando = $(anchor).hasClass('expando');
			if( ifExpando ){
				$(anchor).find('.expando-link').trigger('click');
			}
		},
		hash: true,
		offset: -70,
    });
	$(".video-wrapper").fitVids();
	$(".ak-action-count").akGetActionCount();
	$(".tw-share, .fb-share, .button-dot.facebook, .button-share-facebook, .button-share-twitter").newWindowPopup();
	$(".nav-mobile-select, .nav-tablet-select").each(function(){
		var mob_nav_label = $(this).attr("data-nav-label");
		$(this).find(".menu").tinyNav({
			active: 'current-menu-item', // String: Set the "active" class
			header:  '', // String: Specify text for "header" and show header instead of the active item
			indent: '- ', // String: Specify text for indenting sub-items
			label: mob_nav_label, // String: Sets the <label> text for the <select> (if not set, no label will be added)
		});
	});
	$(".section-img-credit").hover( 
		function(){
			$(this).stop().prev('.section-inner').animate({opacity:0});
		}, function(){
			$(this).stop().prev('.section-inner').animate({opacity:1});
		}
	);
	var initialWidth = $(window).width();
	var resizeStartWidth = initialWidth;

	if ("ontouchstart" in document.documentElement){
		// block first click on .parent nav elements
		$('.desktop-dropdown .menu > .parent > a').on('touchstart',function(e){
			e.preventDefault();
		});
	}

	// Add URL param "source" as hidden input on any AK forms
	var url_source = urlParam('source');
  if ( url_source ){
  	$('.actionkit-widget').each(function(){
  		$(this).append('<input type="hidden" name="source" value="' +  url_source + '"> ');
  	});
  }
	// Add URL param "source" to AK map iframe src, then AK can append it to map links
  if ( url_source ){
  	$('.ak-event-map').each(function(){
  		var iframe_src = $(this).attr('src');
  		if ( ~iframe_src.indexOf("?") ){
  			var iframe_src_new = iframe_src + '&source=' + url_source;
      } else {
        var iframe_src_new = iframe_src + '?source=' + url_source;
      }
  		$(this).attr('src', iframe_src_new);
  	});
  }
  // Pass URL param "source" to share buttons
  if ( url_source ){
    $('.button-share-facebook, .fb-share, .button-share-twitter, .tw-share').each(function(){
      var share_url = $(this).attr('href');
      if ( ~share_url.indexOf("?") ){
        var share_url_new = share_url + '%3Fsource%3D' + url_source;
      } else {
        var share_url_new = share_url + '%26source%3D' + url_source;
      }
      $(this).attr('href', share_url_new);
    });
  }
	// Truncate and add "Read More" link
	$('[data-read-more-after], [data-readmore-after]').truncateAndReadMore();
	// Expandooooo
	$(".expando, .js-expando").expando();
}); /* end of as page load scripts */

