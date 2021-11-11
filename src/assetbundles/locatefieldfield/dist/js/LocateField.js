/**
 * Locate plugin for Craft CMS
 *
 * LocateField Field JS
 *
 * @author    Isaac Gray
 * @copyright Copyright (c) 2018 Isaac Gray
 * @link      https://www.vaersaagod.no/
 * @package   Locate
 * @since     2.0.0
 */

;(function ($, window, document, undefined) {

    var pluginName = "LocateLocateField",
        defaults = {};

    // Plugin constructor
    function Plugin(element, options) {
        this.element = element;

        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype = {

        init: function (id) {
            var _this = this;


            $(function () {
                var fields = {
                    lat: document.getElementById(_this.options.prefix + _this.options.name + '-lat'),
                    lng: document.getElementById(_this.options.prefix + _this.options.name + '-lng'),
                    placeid: document.getElementById(_this.options.prefix + _this.options.name + '-placeid'),
                    locationData: document.getElementById(_this.options.prefix + _this.options.name + '-locationData'),
                }
                var input = document.getElementById(_this.options.prefix + _this.options.name + '-location');

                var options = JSON.parse('{' + _this.options.optionsObject + '}');
                var autocomplete = new google.maps.places.Autocomplete(input, options);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    if (typeof place === 'object') {
                        if (place.hasOwnProperty('geometry')) {
                            fields.lat.value = place.geometry.location.lat();
                            fields.lng.value = place.geometry.location.lng()
                        }

                        if (place.hasOwnProperty('place_id')) {
                            fields.placeid.value = place.place_id;
                        }

                        fields.locationData.value = JSON.stringify(place);
                    }

                });

                input.addEventListener('change', function(e) {
                   if (!input.value) {
                       fields.lat.value = '';
                       fields.lng.value = '';
                       fields.placeid.value = '';
                   }
                });

                document.addEventListener('keydown', function(e) {
                    var key = e.keyCode || e.which;

                    if (key === 13 && document.activeElement === input) {
                        e.preventDefault();
                        $(autocomplete).trigger('place_changed');
                    }
                });
            });
        }
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function (options) {
        // Temporary fix for Locate to get the right prefix
        options.prefix = options.namespace.replace(options.name, '');

        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                    new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);
