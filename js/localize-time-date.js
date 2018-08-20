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

jQuery(document).ready(function($){
  $('.js-localize-time').localizeTime();
  $('.js-localize-date').localizeDate();
});
