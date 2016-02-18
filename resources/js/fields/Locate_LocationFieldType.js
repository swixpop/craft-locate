/**
 * locate plugin for Craft CMS
 *
 * Locate_LocationFieldType JS
 *
 * @author    Isaac Gray
 * @copyright Copyright (c) 2016 Isaac Gray
 * @link      http://isaacgray.me
 * @package   Locate
 * @since     0.4.9
 */

 ;(function ( $, window, document, undefined ) {

    var pluginName = "Locate__LocationFieldType",
        defaults = {
        };

    // Plugin constructor
    function Plugin( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype = {

        init: function(id) {
            var _this = this;

            $(function () {
              var input = document.getElementById(_this.options.prefix+_this.options.id+'-proxy');
              var options = JSON.parse('{'+_this.options.optionsObject+'}');
              var autocomplete = new google.maps.places.Autocomplete(input, options);
              autocomplete.addListener('place_changed', function(){
                var place = autocomplete.getPlace();
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng()
                var location = input.value;
                var placeid = place.place_id;
                _this.element.value = lat+'|'+lng+'|'+location+'|'+placeid;
              });
            });
        }
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );
