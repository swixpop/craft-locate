# Locate plugin for Craft CMS 3.x

Harness the power of the [Google Autocomplete API](https://developers.google.com/maps/documentation/javascript/places-autocomplete) inside Craft. Adds an autocomplete search box to Craft entries which allows place and address queries to be made to the API. Populates a hidden **Location** field with `lat`, `lng`, `location`, and `placeid` which you can grab in your templates to do with as you wish.


## Requirements

* [Craft CMS](https://craftcms.com/) 3.0.0-beta.23 or later.
* [Google API key](https://developers.google.com/maps/documentation/javascript/get-api-key) with `
Google Maps JavaScript API` and `Google Places API Web Service` enabled.

#### Note:
Google has updated their API access policy. See https://cloud.google.com/maps-platform/user-guide/

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require swixpop/locate

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Locate, or from the command line:

        ./craft install/plugin locate

4. Configure the plugin via the plugin settings page in the control panel.

5. You can now create `Location` fields and add them to your entries.

## Configuration

Navigate to Settings > Plugins > Locate. Enter your Google API key if you already have one, or [get one here](https://developers.google.com/maps/documentation/javascript/get-api-key). The settings page also allows you to customize the behaviour of the autocomplete box.

### Customize the autocomplete box

The autocomplete search box need not be customized. It defaults to all place types (cities, addresses, businesses, etc.) in the world. By default, the API will attempt to detect the user's location from their IP address, and will bias the results to that location.

However, by passing in some basic options, advanced filtering can be achieved. You can modify the default behaviour by passing in a JSON object of options. For a full list of allowed options see the [official documentation from Google](https://developers.google.com/maps/documentation/javascript/places-autocomplete#add_autocomplete).

These options can be set globally or on a per field basis. Options set on individual fields will override the global options.

**The options object must be formatted correctly or the plugin will throw a javascript error! If after reading this documentation you are unclear about what to enter in the options box, please leave it blank.**

#### Restrict search by place type

You can specify an array of `types` to restrict the results returned to your autocomplete box. In general only a single type is allowed. Possible values are:

* `geocode`
* `address`
* `establishment`
* `(regions)`
* `(cities)`

See the [official documentation](https://developers.google.com/maps/documentation/javascript/places-autocomplete#add_autocomplete) for details on how using these `types` will restrict your results.

##### Example usage

Restrict the results to cities:
```json
"types": ["(cities)"]
```

Restrict the results to business establishments:
```json
"types": ["establishment"]
```

#### Bias the search towards a geographical already

You can use the `bounds` property to specify a `google.maps.LatLngBoundsLiteral` and bias your search results to a geographic area. This is an object specifying `north`, `east`, `south`, and `west` values. The autocomplete box return results biased towards, *but not restricted to*, the area you specify.

See the [LatLngBoundsLiteral object specification](https://developers.google.com/maps/documentation/javascript/reference#LatLngBoundsLiteral) for full details.

Note that the values are entered as a *number* and not a *string*

##### Example usage

Bias the search results to the Pacific Northwest:
```json
"bounds": {
  "north": 50,
  "east": -122,
  "south": 48,
  "west": -123
}
```

#### Restrict search by country

You can restrict results to an individual country using the `componentRestrictions` property. The country must be passed as as a two-character, ISO 3166-1 Alpha-2 compatible country code.

##### Example usage

Restrict the results to Canada:
```json
"componentRestrictions": {
  "country": "ca"
}
```

#### Putting it all together

Using the above examples we can create an options object that restricts searches to businesses in Canada, preferably in the Pacific Northwest region (ie. Starbucks in Vancouver).

```json
"types": ["establishment"],
"bounds": {
  "north": 50,
  "east": -122,
  "south": 48,
  "west": -123
},
"componentRestrictions": {
  "country": "ca"
}
```

## Using the Location field

The Location field returns `locationData`, `lat`, `lng`, `location`, and `placeid`. You can use these in your templates and pass them on to your javascript.

* `locationData` returns the full API response from Google, with an additional `components` array which maps the `address_components` to an array with the component types as keys. See [here](https://developers.google.com/maps/documentation/geocoding/intro#Types) for a list of some types. (For example, you can access `locationData.components.country` in your twig. You can also add `_short` to any component key to access the `short_name` of that address component, for example `locationData.components.country_short`).
* `lat` returns the latitude of the place
* `lng` returns the longitude of the place
* `location` returns autocomplete query
* `placeid` returns a textual identifier that uniquely identifies a place

The `placeid` can be used to make additional requests to the Google Maps API. With `placeid` you can make [place details requests](https://developers.google.com/maps/documentation/javascript/places#place_details_requests) to get information such as address, phone number, reviews, etc. You can also use the `placeid` to generate map markers. Read more about [referencing a place with a place ID](https://developers.google.com/maps/documentation/javascript/places#placeid).

### Templating examples

Using the options restrictions from the previous section, we could search for "Lucky's Donuts" in the autocomplete box.

```html
<div class="yummy" data-place-id="{{ entry.myLocationFieldHandle.placeid }}" data-lat="{{ entry.myLocationFieldHandle.lat }}" data-lng="{{ entry.myLocationFieldHangle.lng }}">
  <span>You searched for: {{ entry.myLocationFieldHandle.location }}</span>
</div>
```
would generate the following:
```html
<div class="yummy" data-place-id="ChIJ0drOuuNzhlQRB8PCozmcz_4" data-lat="49.25915390000001" data-lng="-123.10084899999998">
  <span>You searched for: Lucky's Doughnuts, Main Street, Vancouver, BC, Canada</span>
</div>
```

You could then generate a simple map by loading up the Google Maps javascript API:
```javascript
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
```
and grabbing the `placeid`, `lat`, and `lng` in your javascript:

```javascript
var map,
    myLat = $('.yummy').attr('data-lat'),
    myLng = $('.yummy').attr('data-lng'),
    myPlaceId = $('.yummy').attr('data-place-id');

function initialize() {
  // Create a map centered at your location.
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: myLat, lng: myLng},
    zoom: 15
  });

  var myLatLng = new google.maps.LatLng({lat: myLat, lng: myLng});

  var marker = new google.maps.Marker({
    map: map,
    place: {
      placeId: myPlaceId,
      location: myLatLng
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
```


Brought to you by [Isaac Gray](https://www.vaersaagod.no/)
