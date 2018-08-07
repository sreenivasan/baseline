/*!
  hey, [be]Lazy.js - v1.5.4 - 2016.03.06
  A fast, small and dependency free lazy load script (https://github.com/dinbror/blazy)
  (c) Bjoern Klinggaard - @bklinggaard - http://dinbror.dk/blazy
*/
  (function(k,f){"function"===typeof define&&define.amd?define(f):"object"===typeof exports?module.exports=f():k.Blazy=f()})(this,function(){function k(b){setTimeout(function(){var c=b._util;c.elements=w(b.options.selector);c.count=c.elements.length;c.destroyed&&(c.destroyed=!1,b.options.container&&h(b.options.container,function(a){l(a,"scroll",c.validateT)}),l(window,"resize",c.saveViewportOffsetT),l(window,"resize",c.validateT),l(window,"scroll",c.validateT));f(b)},1)}function f(b){for(var c=b._util,a=0;a<c.count;a++){var d=c.elements[a],g=d.getBoundingClientRect();if(g.right>=e.left&&g.bottom>=e.top&&g.left<=e.right&&g.top<=e.bottom||n(d,b.options.successClass))b.load(d),c.elements.splice(a,1),c.count--,a--}0===c.count&&b.destroy()}function q(b,c,a){if(!n(b,a.successClass)&&(c||a.loadInvisible||0<b.offsetWidth&&0<b.offsetHeight))if(c=b.getAttribute(p)||b.getAttribute(a.src)){c=c.split(a.separator);var d=c[r&&1<c.length?1:0],g="img"===b.nodeName.toLowerCase();g||void 0===b.src?(c=new Image,c.onerror=function(){a.error&&a.error(b,"invalid");b.className=b.className+" "+a.errorClass},c.onload=function(){g?b.src=d:b.style.backgroundImage='url("'+d+'")';t(b,a)},c.src=d):(b.src=d,t(b,a))}else a.error&&a.error(b,"missing"),n(b,a.errorClass)||(b.className=b.className+" "+a.errorClass)}function t(b,c){b.className=b.className+" "+c.successClass;c.success&&c.success(b);h(c.breakpoints,function(a){b.removeAttribute(a.src)});b.removeAttribute(c.src)}function n(b,c){return-1!==(" "+b.className+" ").indexOf(" "+c+" ")}function w(b){var c=[];b=document.querySelectorAll(b);for(var a=b.length;a--;c.unshift(b[a]));return c}function u(b){e.bottom=(window.innerHeight||document.documentElement.clientHeight)+b;e.right=(window.innerWidth||document.documentElement.clientWidth)+b}function l(b,c,a){b.attachEvent?b.attachEvent&&b.attachEvent("on"+c,a):b.addEventListener(c,a,!1)}function m(b,c,a){b.detachEvent?b.detachEvent&&b.detachEvent("on"+c,a):b.removeEventListener(c,a,!1)}function h(b,c){if(b&&c)for(var a=b.length,d=0;d<a&&!1!==c(b[d],d);d++);}function v(b,c,a){var d=0;return function(){var g=+new Date;g-d<c||(d=g,b.apply(a,arguments))}}var p,e,r;return function(b){if(!document.querySelectorAll){var c=document.createStyleSheet();document.querySelectorAll=function(a,b,d,e,f){f=document.all;b=[];a=a.replace(/\[for\b/gi,"[htmlFor").split(",");for(d=a.length;d--;){c.addRule(a[d],"k:v");for(e=f.length;e--;)f[e].currentStyle.k&&b.push(f[e]);c.removeRule(0)}return b}}var a=this,d=a._util={};d.elements=[];d.destroyed=!0;a.options=b||{};a.options.error=a.options.error||!1;a.options.offset=a.options.offset||100;a.options.success=a.options.success||!1;a.options.selector=a.options.selector||".b-lazy";a.options.separator=a.options.separator||"|";a.options.container=a.options.container?document.querySelectorAll(a.options.container):!1;a.options.errorClass=a.options.errorClass||"b-error";a.options.breakpoints=a.options.breakpoints||!1;a.options.loadInvisible=a.options.loadInvisible||!1;a.options.successClass=a.options.successClass||"b-loaded";a.options.validateDelay=a.options.validateDelay||25;a.options.saveViewportOffsetDelay=a.options.saveViewportOffsetDelay||50;a.options.src=p=a.options.src||"data-src";r=1<window.devicePixelRatio;e={};e.top=0-a.options.offset;e.left=0-a.options.offset;a.revalidate=function(){k(this)};a.load=function(a,b){var c=this.options;void 0===a.length?q(a,b,c):h(a,function(a){q(a,b,c)})};a.destroy=function(){var a=this._util;this.options.container&&h(this.options.container,function(b){m(b,"scroll",a.validateT)});m(window,"scroll",a.validateT);m(window,"resize",a.validateT);m(window,"resize",a.saveViewportOffsetT);a.count=0;a.elements.length=0;a.destroyed=!0};d.validateT=v(function(){f(a)},a.options.validateDelay,a);d.saveViewportOffsetT=v(function(){u(a.options.offset)},a.options.saveViewportOffsetDelay,a);u(a.options.offset);h(a.options.breakpoints,function(a){if(a.width>=window.screen.width)return p=a.src,!1});k(a)}});

/*! no-blend uglified | https://gist.github.com/mhulse/6ec4db51a61eb958b82d */
!function(e,n){e.getComputedStyle(n.head,null).mixBlendMode&&(n.documentElement.className=n.documentElement.className.replace(/\bno-blend\b/,"blend"))}(window,document);

/* spin.js - ajax loading animation */
(function(t,e){if(typeof exports=="object")module.exports=e();else if(typeof define=="function"&&define.amd)define(e);else t.Spinner=e()})(this,function(){"use strict";var t=["webkit","Moz","ms","O"],e={},i;function o(t,e){var i=document.createElement(t||"div"),o;for(o in e)i[o]=e[o];return i}function n(t){for(var e=1,i=arguments.length;e<i;e++)t.appendChild(arguments[e]);return t}var r=function(){var t=o("style",{type:"text/css"});n(document.getElementsByTagName("head")[0],t);return t.sheet||t.styleSheet}();function s(t,o,n,s){var a=["opacity",o,~~(t*100),n,s].join("-"),f=.01+n/s*100,l=Math.max(1-(1-t)/o*(100-f),t),u=i.substring(0,i.indexOf("Animation")).toLowerCase(),d=u&&"-"+u+"-"||"";if(!e[a]){r.insertRule("@"+d+"keyframes "+a+"{"+"0%{opacity:"+l+"}"+f+"%{opacity:"+t+"}"+(f+.01)+"%{opacity:1}"+(f+o)%100+"%{opacity:"+t+"}"+"100%{opacity:"+l+"}"+"}",r.cssRules.length);e[a]=1}return a}function a(e,i){var o=e.style,n,r;i=i.charAt(0).toUpperCase()+i.slice(1);for(r=0;r<t.length;r++){n=t[r]+i;if(o[n]!==undefined)return n}if(o[i]!==undefined)return i}function f(t,e){for(var i in e)t.style[a(t,i)||i]=e[i];return t}function l(t){for(var e=1;e<arguments.length;e++){var i=arguments[e];for(var o in i)if(t[o]===undefined)t[o]=i[o]}return t}function u(t){var e={x:t.offsetLeft,y:t.offsetTop};while(t=t.offsetParent)e.x+=t.offsetLeft,e.y+=t.offsetTop;return e}function d(t,e){return typeof t=="string"?t:t[e%t.length]}var p={lines:12,length:7,width:5,radius:10,rotate:0,corners:1,color:"#000",direction:1,speed:1,trail:100,opacity:1/4,fps:20,zIndex:2e9,className:"spinner",top:"auto",left:"auto",position:"relative"};function c(t){if(typeof this=="undefined")return new c(t);this.opts=l(t||{},c.defaults,p)}c.defaults={};l(c.prototype,{spin:function(t){this.stop();var e=this,n=e.opts,r=e.el=f(o(0,{className:n.className}),{position:n.position,width:0,zIndex:n.zIndex}),s=n.radius+n.length+n.width,a,l;if(t){t.insertBefore(r,t.firstChild||null);l=u(t);a=u(r);f(r,{left:(n.left=="auto"?l.x-a.x+(t.offsetWidth>>1):parseInt(n.left,10)+s)+"px",top:(n.top=="auto"?l.y-a.y+(t.offsetHeight>>1):parseInt(n.top,10)+s)+"px"})}r.setAttribute("role","progressbar");e.lines(r,e.opts);if(!i){var d=0,p=(n.lines-1)*(1-n.direction)/2,c,h=n.fps,m=h/n.speed,y=(1-n.opacity)/(m*n.trail/100),g=m/n.lines;(function v(){d++;for(var t=0;t<n.lines;t++){c=Math.max(1-(d+(n.lines-t)*g)%m*y,n.opacity);e.opacity(r,t*n.direction+p,c,n)}e.timeout=e.el&&setTimeout(v,~~(1e3/h))})()}return e},stop:function(){var t=this.el;if(t){clearTimeout(this.timeout);if(t.parentNode)t.parentNode.removeChild(t);this.el=undefined}return this},lines:function(t,e){var r=0,a=(e.lines-1)*(1-e.direction)/2,l;function u(t,i){return f(o(),{position:"absolute",width:e.length+e.width+"px",height:e.width+"px",background:t,boxShadow:i,transformOrigin:"left",transform:"rotate("+~~(360/e.lines*r+e.rotate)+"deg) translate("+e.radius+"px"+",0)",borderRadius:(e.corners*e.width>>1)+"px"})}for(;r<e.lines;r++){l=f(o(),{position:"absolute",top:1+~(e.width/2)+"px",transform:e.hwaccel?"translate3d(0,0,0)":"",opacity:e.opacity,animation:i&&s(e.opacity,e.trail,a+r*e.direction,e.lines)+" "+1/e.speed+"s linear infinite"});if(e.shadow)n(l,f(u("#000","0 0 4px "+"#000"),{top:2+"px"}));n(t,n(l,u(d(e.color,r),"0 0 1px rgba(0,0,0,.1)")))}return t},opacity:function(t,e,i){if(e<t.childNodes.length)t.childNodes[e].style.opacity=i}});function h(){function t(t,e){return o("<"+t+' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',e)}r.addRule(".spin-vml","behavior:url(#default#VML)");c.prototype.lines=function(e,i){var o=i.length+i.width,r=2*o;function s(){return f(t("group",{coordsize:r+" "+r,coordorigin:-o+" "+-o}),{width:r,height:r})}var a=-(i.width+i.length)*2+"px",l=f(s(),{position:"absolute",top:a,left:a}),u;function p(e,r,a){n(l,n(f(s(),{rotation:360/i.lines*e+"deg",left:~~r}),n(f(t("roundrect",{arcsize:i.corners}),{width:o,height:i.width,left:i.radius,top:-i.width>>1,filter:a}),t("fill",{color:d(i.color,e),opacity:i.opacity}),t("stroke",{opacity:0}))))}if(i.shadow)for(u=1;u<=i.lines;u++)p(u,-2,"progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");for(u=1;u<=i.lines;u++)p(u);return n(e,l)};c.prototype.opacity=function(t,e,i,o){var n=t.firstChild;o=o.shadow&&o.lines||0;if(n&&e+o<n.childNodes.length){n=n.childNodes[e+o];n=n&&n.firstChild;n=n&&n.firstChild;if(n)n.opacity=i}}}var m=f(o("group"),{behavior:"url(#default#VML)"});if(!a(m,"transform")&&m.adj)h();else i=a(m,"animation");return c});

/*! gumshoe v3.5.0 | (c) 2017 Chris Ferdinandi | MIT License | http://github.com/cferdinandi/gumshoe */
!(function(e,t){"function"==typeof define&&define.amd?define([],t(e)):"object"==typeof exports?module.exports=t(e):e.gumshoe=t(e)})("undefined"!=typeof global?global:this.window||this.global,(function(e){"use strict";var t,n,o,r,a,c,i,l={},s="querySelector"in document&&"addEventListener"in e&&"classList"in document.createElement("_"),u=[],f={selector:"[data-gumshoe] a",selectorHeader:"[data-gumshoe-header]",container:e,offset:0,activeClass:"active",scrollDelay:!1,callback:function(){}},d=function(e,t,n){if("[object Object]"===Object.prototype.toString.call(e))for(var o in e)Object.prototype.hasOwnProperty.call(e,o)&&t.call(n,e[o],o,e);else for(var r=0,a=e.length;r<a;r++)t.call(n,e[r],r,e)},v=function(){var e={},t=!1,n=0,o=arguments.length;"[object Boolean]"===Object.prototype.toString.call(arguments[0])&&(t=arguments[0],n++);for(var r=function(n){for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(t&&"[object Object]"===Object.prototype.toString.call(n[o])?e[o]=v(!0,e[o],n[o]):e[o]=n[o])};n<o;n++){var a=arguments[n];r(a)}return e},m=function(e){return Math.max(e.scrollHeight,e.offsetHeight,e.clientHeight)},g=function(){return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight,document.body.offsetHeight,document.documentElement.offsetHeight,document.body.clientHeight,document.documentElement.clientHeight)},h=function(e){var n=0;if(e.offsetParent){do n+=e.offsetTop,e=e.offsetParent;while(e)}else n=e.offsetTop;return n=n-a-t.offset,n>=0?n:0},p=function(t){var n=t.getBoundingClientRect();return n.top>=0&&n.left>=0&&n.bottom<=(e.innerHeight||document.documentElement.clientHeight)&&n.right<=(e.innerWidth||document.documentElement.clientWidth)},y=function(){u.sort((function(e,t){return e.distance>t.distance?-1:e.distance<t.distance?1:0}))};l.setDistances=function(){o=g(),a=r?m(r)+h(r):0,d(u,(function(e){e.distance=h(e.target)})),y()};var b=function(){var e=document.querySelectorAll(t.selector);d(e,(function(e){if(e.hash){var t=document.querySelector(e.hash);t&&u.push({nav:e,target:t,parent:"li"===e.parentNode.tagName.toLowerCase()?e.parentNode:null,distance:0})}}))},H=function(){c&&(c.nav.classList.remove(t.activeClass),c.parent&&c.parent.classList.remove(t.activeClass))},C=function(e){H(),e.nav.classList.add(t.activeClass),e.parent&&e.parent.classList.add(t.activeClass),t.callback(e),c={nav:e.nav,parent:e.parent}};l.getCurrentNav=function(){var n=e.pageYOffset;if(e.innerHeight+n>=o&&p(u[0].target))return C(u[0]),u[0];for(var r=0,a=u.length;r<a;r++){var c=u[r];if(c.distance<=n)return C(c),c}H(),t.callback()};var L=function(){d(u,(function(e){e.nav.classList.contains(t.activeClass)&&(c={nav:e.nav,parent:e.parent})}))};l.destroy=function(){t&&(t.container.removeEventListener("resize",j,!1),t.container.removeEventListener("scroll",j,!1),u=[],t=null,n=null,o=null,r=null,a=null,c=null,i=null)};var E=function(e){window.clearTimeout(n),n=setTimeout((function(){l.setDistances(),l.getCurrentNav()}),66)},j=function(e){n||(n=setTimeout((function(){n=null,"scroll"===e.type&&l.getCurrentNav(),"resize"===e.type&&(l.setDistances(),l.getCurrentNav())}),66))};return l.init=function(e){s&&(l.destroy(),t=v(f,e||{}),r=document.querySelector(t.selectorHeader),b(),0!==u.length&&(L(),l.setDistances(),l.getCurrentNav(),t.container.addEventListener("resize",j,!1),t.scrollDelay?t.container.addEventListener("scroll",E,!1):t.container.addEventListener("scroll",j,!1)))},l}));

/*!
 * headroom.js v0.9.4 - Give your page some headroom. Hide your header until you need it
 * Copyright (c) 2017 Nick Williams - http://wicky.nillia.ms/headroom.js
 * License: MIT
 */

!function(a,b){"use strict";"function"==typeof define&&define.amd?define([],b):"object"==typeof exports?module.exports=b():a.Headroom=b()}(this,function(){"use strict";function a(a){this.callback=a,this.ticking=!1}function b(a){return a&&"undefined"!=typeof window&&(a===window||a.nodeType)}function c(a){if(arguments.length<=0)throw new Error("Missing arguments in extend function");var d,e,f=a||{};for(e=1;e<arguments.length;e++){var g=arguments[e]||{};for(d in g)"object"!=typeof f[d]||b(f[d])?f[d]=f[d]||g[d]:f[d]=c(f[d],g[d])}return f}function d(a){return a===Object(a)?a:{down:a,up:a}}function e(a,b){b=c(b,e.options),this.lastKnownScrollY=0,this.elem=a,this.tolerance=d(b.tolerance),this.classes=b.classes,this.offset=b.offset,this.scroller=b.scroller,this.initialised=!1,this.onPin=b.onPin,this.onUnpin=b.onUnpin,this.onTop=b.onTop,this.onNotTop=b.onNotTop,this.onBottom=b.onBottom,this.onNotBottom=b.onNotBottom}var f={bind:!!function(){}.bind,classList:"classList"in document.documentElement,rAF:!!(window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame)};return window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame,a.prototype={constructor:a,update:function(){this.callback&&this.callback(),this.ticking=!1},requestTick:function(){this.ticking||(requestAnimationFrame(this.rafCallback||(this.rafCallback=this.update.bind(this))),this.ticking=!0)},handleEvent:function(){this.requestTick()}},e.prototype={constructor:e,init:function(){if(e.cutsTheMustard)return this.debouncer=new a(this.update.bind(this)),this.elem.classList.add(this.classes.initial),setTimeout(this.attachEvent.bind(this),100),this},destroy:function(){var a=this.classes;this.initialised=!1;for(var b in a)a.hasOwnProperty(b)&&this.elem.classList.remove(a[b]);this.scroller.removeEventListener("scroll",this.debouncer,!1)},attachEvent:function(){this.initialised||(this.lastKnownScrollY=this.getScrollY(),this.initialised=!0,this.scroller.addEventListener("scroll",this.debouncer,!1),this.debouncer.handleEvent())},unpin:function(){var a=this.elem.classList,b=this.classes;!a.contains(b.pinned)&&a.contains(b.unpinned)||(a.add(b.unpinned),a.remove(b.pinned),this.onUnpin&&this.onUnpin.call(this))},pin:function(){var a=this.elem.classList,b=this.classes;a.contains(b.unpinned)&&(a.remove(b.unpinned),a.add(b.pinned),this.onPin&&this.onPin.call(this))},top:function(){var a=this.elem.classList,b=this.classes;a.contains(b.top)||(a.add(b.top),a.remove(b.notTop),this.onTop&&this.onTop.call(this))},notTop:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notTop)||(a.add(b.notTop),a.remove(b.top),this.onNotTop&&this.onNotTop.call(this))},bottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.bottom)||(a.add(b.bottom),a.remove(b.notBottom),this.onBottom&&this.onBottom.call(this))},notBottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notBottom)||(a.add(b.notBottom),a.remove(b.bottom),this.onNotBottom&&this.onNotBottom.call(this))},getScrollY:function(){return void 0!==this.scroller.pageYOffset?this.scroller.pageYOffset:void 0!==this.scroller.scrollTop?this.scroller.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop},getViewportHeight:function(){return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight},getElementPhysicalHeight:function(a){return Math.max(a.offsetHeight,a.clientHeight)},getScrollerPhysicalHeight:function(){return this.scroller===window||this.scroller===document.body?this.getViewportHeight():this.getElementPhysicalHeight(this.scroller)},getDocumentHeight:function(){var a=document.body,b=document.documentElement;return Math.max(a.scrollHeight,b.scrollHeight,a.offsetHeight,b.offsetHeight,a.clientHeight,b.clientHeight)},getElementHeight:function(a){return Math.max(a.scrollHeight,a.offsetHeight,a.clientHeight)},getScrollerHeight:function(){return this.scroller===window||this.scroller===document.body?this.getDocumentHeight():this.getElementHeight(this.scroller)},isOutOfBounds:function(a){var b=a<0,c=a+this.getScrollerPhysicalHeight()>this.getScrollerHeight();return b||c},toleranceExceeded:function(a,b){return Math.abs(a-this.lastKnownScrollY)>=this.tolerance[b]},shouldUnpin:function(a,b){var c=a>this.lastKnownScrollY,d=a>=this.offset;return c&&d&&b},shouldPin:function(a,b){var c=a<this.lastKnownScrollY,d=a<=this.offset;return c&&b||d},update:function(){var a=this.getScrollY(),b=a>this.lastKnownScrollY?"down":"up",c=this.toleranceExceeded(a,b);this.isOutOfBounds(a)||(a<=this.offset?this.top():this.notTop(),a+this.getViewportHeight()>=this.getScrollerHeight()?this.bottom():this.notBottom(),this.shouldUnpin(a,c)?this.unpin():this.shouldPin(a,c)&&this.pin(),this.lastKnownScrollY=a)}},e.options={tolerance:{up:0,down:0},offset:0,scroller:window,classes:{pinned:"headroom--pinned",unpinned:"headroom--unpinned",top:"headroom--top",notTop:"headroom--not-top",bottom:"headroom--bottom",notBottom:"headroom--not-bottom",initial:"headroom"}},e.cutsTheMustard="undefined"!=typeof f&&f.rAF&&f.bind&&f.classList,e});



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
        "iframe[src*='facebook.com/plugins/video.php']",
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
/* add .focus class to parent when direct child input has focus */
(function($){
	$.fn.parentFocus = function(){
		return this.each(function(){
      $(this).on({
        focus: function(){
          $(this).parent().addClass('focus');
        },
        blur: function(){
          $(this).parent().removeClass('focus');
        }
      });
		});
	};
}(jQuery));
/**
 * data-read-more-after
 * Take multiple children, hide all but the first N, and add a "read more" link
 * option: data-read-more-after-link-position="new-line"
 * option: data-read-more-after-link-classes="text-caps text-blue" etc.
 */
(function($){
	jQuery.fn.truncateAndReadMore = function(){
		// Set up translations (uses non-breaking spaces to prevent awkward line breaks)
		var readMoreTranslations = {
			en: "Read&nbsp;More",
			fr: "Lire&nbsp;la&nbsp;Suite",
      ar: "اقرأ أكثر",
      pt: "Leia mais",
      es: "Leer más",
      de: "Weiterlesen"
    };
		var defaultReadMoreText = readMoreTranslations['en'];
		// Detect language
		var htmlLangAttr = $('html').attr('lang');
		var htmlLangAttr = htmlLangAttr.substring(0,2);

		if ( htmlLangAttr && readMoreTranslations[htmlLangAttr] ){
			defaultReadMoreText = readMoreTranslations[htmlLangAttr];
		}
		// For each element targeted...
		return this.each(function(){
      // get number of paragraphs to hide
      var visElems = $(this).attr('data-read-more-after');
      // check for alternate display options
      var display = $(this).attr('data-read-more-after-link-position');
      var customReadMoreText = $(this).attr('data-read-more-after-link-text');
      var readMoreText = customReadMoreText ? customReadMoreText : defaultReadMoreText;
      display = display ? display : '';
      // check for optional classes to add
      var readMoreLinkClasses = $(this).attr('data-read-more-after-link-classes');
      readMoreLinkClasses = readMoreLinkClasses ? readMoreLinkClasses : '';
      // check if visible elements is a positive number, if not set default to 2
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
			var firstParaSibs = jQuery(this).children();
			// Make sure there's more than N children element in the container
			if ( firstParaSibs.length > visElems){
        if ( display == 'new-line' ){
          var readMoreBlockLink = '<p class="read-more-wrapper"><a class="read-more arrow-down ' + readMoreLinkClasses +'">' + readMoreText +'</a></p>';
          var readMoreInlineLink = '';
        } else {
          var readMoreBlockLink = '';
          var readMoreInlineLink = '<a class="read-more read-more-inline arrow-down ' + readMoreLinkClasses +'">' + readMoreText +'</a>';
        }
        $(this).append( readMoreBlockLink );
        // Hide extra para's, add "read more", trigger click handler setup event
        firstParaSibs
          .not('.do-not-hide')
          .hide()
          .siblings(":lt(" + (visElems-1) + ")") // uses zero-based index counting
          .addBack(":eq(0)") // .siblings excludes the first element, so add it back
          .show()
          .last()
          .append( readMoreInlineLink )
          .trigger('readMoreEventSetup');
			}

		});
	}
}(jQuery));
// Modal
(function($){
  $.fn.modal = function(){
    return this.each(function(index){
      // switch index to start from 1 instead of 0 for readability in the markup
      index++;
      // check for option to disable automatic hiding of source element
      var showSourceElem = $(this).attr('data-modal-show-source');
      // get the ID of the element that contains the content for the modal from the "data-modal-source" attribute
      var modalSourceId = $(this).attr('data-modal-source');
      var modalSourceElem = $( modalSourceId );
      var modalLinkId = $(this).attr('id');

      if ( modalSourceId ) {
        modalIdSlug = modalSourceId.replace( /(#|\.)/, '');
      } else if (modalLinkId) {
        modalIdSlug = modalLinkId;
      } else {
        modalIdSlug = index;
      }
      var modalWrapperId = 'modal-' + modalIdSlug;
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
      var modalInnerClasses = modalInnerClassesAttr ? modalInnerClassesAttr : 'padding-medium bg-white text-dark';
      // get the optional list of classes to add to the inner content area from the "data-modal-classes-outer" attribute in the HTML tag
      var modalOuterClassesAttr = $(this).attr('data-modal-classes-outer');
      // use the default classes to set the modal container to have a transparent dark gray background and lots of horizontal padding
      var modalOuterClasses = modalOuterClassesAttr ? modalOuterClassesAttr : 'bg-dkgray-trans width-narrow';

      // set up modal wrappers
      // assemble the outer and inner modal wrappers around the content
      var modal = '<div id="' + modalWrapperId + '" class="modal-wrapper section ' + modalOuterClasses + '"><div class="modal-inner section-inner ' + modalInnerClasses + '"><a class="modal-close">X</a><div class="modal-content"></div></div></div>';
      // append the modal before the closing </body> tag and add the class "open" (which hooks into CSS3 animations)
      // NOTE: animate() is used just to provide a slight delay before adding the 'open' class, which is necessary to trigger CSS3 animation (for some reason)
      $(modal).appendTo('body');

			// set up the click event
			$(this).on('click', function(e){
				e.preventDefault();
        var modalWrapper = $('#' + modalWrapperId)
        var modalContent = modalWrapper.find('.modal-content');
        // unhide the source element before appending it to the modal window
        modalSourceElem
          .clone()
          .removeClass('nav-desktop-dropdown')
          .show()
          .appendTo(modalContent);
        // Open the modal
        // check for any lazy loading inside the modal and swap data-src into src and kill any spinners
        modalWrapper
          .addClass('open')
          .find('[data-src]')
          .each(function(){
            var modalDataSrc = $(this).attr('data-src');
            $(this).attr('src',modalDataSrc).removeClass('lazy').parent().spin(false);;
        });
				// set up the "close modal" function
				function modalClose(){
					modalWrapper.removeClass('open')
          modalContent.empty();
					$(document).unbind("keyup", modalClose );
				}
				// call modalClose() when the "close" button is clicked
				$('.modal-close').on('click', function(event){
					modalClose();
					event.stopPropagation();
				});
				// call modalClose() when the modal background is clicked
				modalWrapper.on('click', function(){
					modalClose();
				});
				// stop clicks in the modal content from propagating up and triggering a "close" event
				modalContent.on('click',function(event){
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
  $.fn.expando = function(device){
    var screenSize = device ? device + '-' : '';
    $(this).not(screenSize+'expando-collapsed').not(screenSize+'expando-collapsed').each(function(){
      var expandoText = $(this).attr("title");
      var expandoText2 = $(this).find('h1,h2,h3,h4,h5,h6').first().addClass(screenSize+'expando-title').text();
      var expandoText3raw = $(this).children().first().text();
      var expandoText3 = expandoText3raw.substring(0,60);
      var expandedOnLoad = $(this).hasClass(screenSize+'expando-expanded');

      if ( expandoText ){
        $(this).wrapInner('<div class="'+screenSize+'expando-inner" />').prepend('<a class="'+screenSize+'expando-link" href="#">' + expandoText + '</a>');
        //console.log('expandoText1!');
      } else if (expandoText2) {
        $(this).wrapInner('<div class="'+screenSize+'expando-inner" />').prepend('<a class="'+screenSize+'expando-link" href="#">' + expandoText2 + '</a>');
        //console.log('expandoText2!');
      } else if (expandoText3) {
        $(this).wrapInner('<div class="'+screenSize+'expando-inner" />').prepend('<a class="'+screenSize+'expando-link" href="#">' + expandoText3 + '...</a>');
        //console.log('expandoText3!');
      } else {
        $(this).wrapInner('<div class="'+screenSize+'expando-inner" />').prepend('<a class="'+screenSize+'expando-link" href="#">Click to expand</a>');
      };
      // if set to pre-expanded, don't add the "collapsed" class
      if ( !expandedOnLoad ){
        $(this).addClass( screenSize+'expando-collapsed');
      }

    });
    $('a.'+screenSize+'expando-link').unbind().click(function(e){
      e.preventDefault();
      $(this)
        .parent()
        .toggleClass(screenSize+'expando-expanded')
        .toggleClass(screenSize+'expando-collapsed');
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

// Collapsible WP nav menus
(function($){
  jQuery.fn.collapseMenu = function( screenSize ){
    return this.each(function(){
      $(this)
        .find('.menu')
        .addClass('js-nav-menu-' + screenSize + '-collapsed')
        .children('.menu > li:first-child')
        .addClass('js-nav-menu-' + screenSize + '-toggle')
        .on('click', function(e){
          e.preventDefault();
          $(this)
            .siblings()
            .toggleClass(screenSize + '-hide')
            .parent()
            .toggleClass('js-nav-menu-' + screenSize + '-collapsed')
            .toggleClass('js-nav-menu-' + screenSize + '-expanded');
        })
        .siblings('li')
        .addClass(screenSize + '-hide');
    });
  }
}(jQuery));
/* Horizontally overflowing sidescrolling section */
(function($){
	jQuery.fn.horzScrollControls = function(){
		return this.each(function(index){
			// check for data- attribute options, or else use this element and it's first child as the target
			var horzScrollFrame = this;
			$(this).wrapInner('<div class="horizontal-scroll-inner"></div>');
			var horzScrollContent = $(this).children('.horizontal-scroll-inner')[0];

			// duration of scroll animation
			var scrollDuration = 1000;
			// Set up controls wrapper
			var controlsWrapper = $('<div class="horizontal-scroll-nav-controls"></div>').prependTo(this);
			// Control Labels
			var controlLabelForward = $(this).attr('data-horizontal-scroll-forward-label') ? $(this).attr('data-horizontal-scroll-forward-label') : 'Forward';
			var controlLabelBackward = $(this).attr('data-horizontal-scroll-back-label') ? $(this).attr('data-horizontal-scroll-back-label') : 'Back';
			// Set up control elements, hiding the back control initial
			var controlForward = $('<div class="horizontal-scroll-nav-control horizontal-scroll-nav-control-forward">' + controlLabelForward + '</div>').prependTo(controlsWrapper);
			var controlBackward = $('<div class="horizontal-scroll-nav-control horizontal-scroll-nav-control-back">' + controlLabelBackward + '</div>').prependTo(controlsWrapper);

			// get outer container width
			var getHorzFrameSize = function() {
				return $(horzScrollFrame).outerWidth();
			}
			var horzFrameSize = getHorzFrameSize();
			// get inner container width
			var getHorzContentSize = function() {
				return $(horzScrollContent).outerWidth();
			}
			var horzContentSize = getHorzContentSize();

			// re-measure widths when window is resized
			$(window).on('resize', function() {
				horzFrameSize = getHorzFrameSize();
				horzContentSize = getHorzContentSize();
			});

			// get how much of horz is invisible
			var horzHiddenSize = Math.abs(horzContentSize - horzFrameSize);

			// get how much have we scrolled to the left
			var getHorzPosition = function() {
				return $(horzScrollFrame).scrollLeft();
			};

			// determine whether scroll controls are active or inactive
			var setControlState = function(){
				horzPosition = getHorzPosition();
				if (horzPosition <= 30) {
					$(controlBackward).addClass('inactive');
					$(controlForward).removeClass('inactive');
				} else if (horzPosition < horzHiddenSize) {
					// show both controls
					$(controlBackward).removeClass('inactive');
					$(controlForward).removeClass('inactive');
				} else if (horzPosition >= horzHiddenSize) {
					$(controlBackward).removeClass('inactive');
					$(controlForward).addClass('inactive');
				}
			}
			setControlState();

			// update variables when scrolled
			$(horzScrollFrame).on('scroll', function() {
				horzHiddenSize =  Math.abs(horzContentSize - horzFrameSize);
				setControlState();
			});

			// determine whether to scroll one screen width or all the way to the end
			var calculateScrollIncrement = function(direction){
				// current window width
				var horzFrameSizeOffset = 0.8 * horzFrameSize;
				// current scroll horzPosition
				var horzPosition = getHorzPosition();
				// debug console.log('horzHiddenSize: ' + horzHiddenSize + ', horzFrameSize: ' + horzFrameSize + ', currentPosition: ' + currentPosition);
				if ( direction == 'forward'){
					if ( horzHiddenSize > horzFrameSizeOffset + horzPosition){
						// if there's more hidden content than the screen width,
						// only scroll one screen width over
						return horzFrameSizeOffset + horzPosition;
					} else {
						return horzHiddenSize;
					}
				} else {
					if ( horzHiddenSize < horzFrameSizeOffset + horzPosition){
						return horzPosition - horzFrameSizeOffset;
					} else {
						return 0;
					}
				}

			}

			// scroll forward click event
			$(controlForward).on('click', function() {
				scrollIncrement = calculateScrollIncrement('forward');
				$(horzScrollFrame).animate( { scrollLeft: scrollIncrement}, scrollDuration);
			});

			// scroll backward click event
			$(controlBackward).on('click', function() {
				scrollIncrement = calculateScrollIncrement('backward');
				$(horzScrollFrame).animate( { scrollLeft: (scrollIncrement) }, scrollDuration);
			});

			/* debug */
			console.log(this);
			console.log(horzScrollContent);
			console.log('horzFrameSize: ' + horzFrameSize);
			console.log('horzContentSize: ' + horzContentSize);
			console.log('horzHiddenSize: ' + horzHiddenSize);
		});
	}
}(jQuery));




// as the page loads, call these scripts
jQuery(document).ready(function($) {
	$('html').removeClass('no-js').addClass('js');
  /*
    Scripts that can potentially change the size of elements and the document.
    Run these first so following scripts don't have to recalculate position, in
    descending order of how much they're likely to change the document size.
  */
	// Truncate and add "Read More" link
	$('[data-read-more-after], [data-readmore-after]').truncateAndReadMore();
  // Expandooooo
  $(".expando, .js-expando").expando();
  $(".expando-mobile, .mobile-expando").expando('mobile');
  $(".tablet-expando").expando('tablet');
  // Collapsed Menus
  $(".nav-mobile-collapsed").collapseMenu('mobile');
  $(".nav-tablet-collapsed").collapseMenu('tablet');
  $(".nav-desktop-collapsed").collapseMenu('desktop');
  // iframe resizer
  $(".iframe-wrapper, .video-wrapper").fitVids();
  // Modals
	$('.js-modal').modal();
	$('.js-modal-onload').trigger('click');

  // Add spinner to lazy images
	$('img.lazy').parent().spin('tiny');

	var bLazy = new Blazy({
    container: '.page-container',
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
          $(".video-wrapper, .iframe-wrapper").fitVids();
      },
      error: function(ele){
      	var parent = ele.parentNode;
          $(ele).parent().spin(false);
      },
      offset: 300,
      selector: '.lazy',
  });
  // for AK-style form fields, wrap adjacent sibs in fieldset
  $('.form-style-labelabove .input-text').findAdjacentSibsAndWrap('.input-text:not(.input-text-nogroup)', 'fieldset class="input-group"');
  // Add a 'focus' class to the parent element when input gets focus
  $("input, select, textarea").parentFocus();

  /* --- end of scripts likely to change document size */

  // Time
  $('.js-localize-time').localizeTime();
  $('.js-localize-date').localizeDate();
  // Set up AJAX links
	$('.ajax-link').ajaxLink();

  // Headroom - "shy" sticky
  // grab an element, construct an instance of Headroom and init
  var shyStickyOptions = {
    tolerance: {
      up: 5,
      down: 5
    },
    onPin: function(){
      $('body').addClass('has-shySticky-active');
    },
    onUnpin: function(){
      $('body').removeClass('has-shySticky-active');
    },
  }
  var shyStickyElem = document.querySelector(".site-header-layout-compact");
  if (shyStickyElem){
    var shySticky  = new Headroom(shyStickyElem, shyStickyOptions);
    shySticky.init();
  }

  /* Update on-page nav items with .active if they're on screen */
  gumshoe.init({
    selector: 'nav a', // Default link selector (must use a valid CSS selector)
  });
  // Set up controls for horizontal scroll areas
  $('.horizontal-scroll').horzScrollControls();
  // Insert the number of actions taken for a given AK page
	$(".ak-action-count").akGetActionCount();
  // Preselect an item in a select tag
  $('[data-preselect]').preselect();
  // Pop up share dialogs in a mini new window
	$(".tw-share, .fb-share, .button-dot.facebook, .button-share-facebook, .button-share-twitter").newWindowPopup();
  // Reveal the bg image when hovering on the image credit
	$(".section-img-credit").hover(
		function(){
			$(this).stop().prev('.section-inner').animate({opacity:0});
		}, function(){
			$(this).stop().prev('.section-inner').animate({opacity:1});
		}
	);

  /* for AJAX Action Network widgets, re-run this script when they finish loading */
  $(document).on('can_embed_loaded', function(){
      $("input, select, textarea").off().parentFocus();
    }
  );

	// Add URL param "source" as hidden input on any AK forms
	var url_source = urlParam('source');
  if ( url_source ){

	// Add URL param "source" as hidden input on any AK forms
  	$('.actionkit-widget').each(function(){
  		$(this).append('<input type="hidden" name="source" value="' +  url_source + '"> ');
  	});

	// Add URL param "source" to AK map iframe src, then AK can append it to map links
  	$('.ak-event-map').each(function(){
  		var iframe_src = $(this).attr('src');
  		if ( ~iframe_src.indexOf("?") ){
  			var iframe_src_new = iframe_src + '&source=' + url_source;
      } else {
        var iframe_src_new = iframe_src + '?source=' + url_source;
      }
  		$(this).attr('src', iframe_src_new);
  	});

    // Pass URL param "source" to share buttons
    $('.button-share-facebook, .fb-share, .button-share-twitter, .tw-share').each(function(){
      var share_url = $(this).attr('href');
      if ( ~share_url.indexOf("?") ){
        var share_url_new = share_url + '%3Fsource%3D' + url_source;
      } else {
        var share_url_new = share_url + '%26source%3D' + url_source;
      }
      $(this).attr('href', share_url_new);
    });

	// Add URL param "source" to megamap
	    $("iframe.megamap, iframe[data-src='https://new-map.350.org/*']").each(function(){
		    var datasrc = $(this).attr('data-src');
		    if ( ~datasrc.indexOf("?") ){
		      var datasrc_new = datasrc + '&source=' + url_source;
		    } else {
		      var datasrc_new = datasrc + '?source=' + url_source;
		    }
		    $(this).attr('data-src', datasrc_new);
		    // console.log('iframe data-src: '+$(this).attr('data-src'));
			});

	// Add URL param "source" to host buttons
	  $("a.host_button").each(function(){
	    var url = $(this).attr('href');
	    if ( ~url.indexOf("?") ){
	      var url_new = url + '&source=' + url_source;
	    } else {
	      var url_new = url + '?source=' + url_source;
	    }
	    $(this).attr('href', url_new);
	    // console.log('host button link (source): '+$(this).attr('href'));
	  });
  }

  var url_referrer = urlParam('referrer');
	// console.log('referrer: '+url_referrer);

  if ( url_referrer ){
	// Add URL param "referrer" to megamap
    $("iframe.megamap").each(function(){
      var datasrc = $(this).attr('data-src');
      if ( ~datasrc.indexOf("?") ){
        var datasrc_new = datasrc + '&referrer=' + url_referrer;
      } else {
        var datasrc_new = datasrc + '?referrer=' + url_referrer;
      }
      $(this).attr('data-src', datasrc_new);
      // console.log('iframe data-src: '+$(this).attr('data-src'));
    });

	// Add URL param "referrer" to host buttons
    $("a.host_button").each(function(){
      var url = $(this).attr('href');
      if ( ~url.indexOf("?") ){
        var url_new = url + '&referrer=' + url_referrer;
      } else {
        var url_new = url + '?referrer=' + url_referrer;
      }
      $(this).attr('href', url_new);
      // console.log('host button link (referrer): '+$(this).attr('href'));
    });
  }
}); /* end of as page load scripts */
