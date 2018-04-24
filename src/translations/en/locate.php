<?php
/**
 * Locate plugin for Craft CMS 3.x
 *
 * Harness the power of the Google Autocomplete API inside Craft. Adds an autocomplete search box to Craft entries.
 *
 * @link      https://www.vaersaagod.no/
 * @copyright Copyright (c) 2018 Isaac Gray
 */

/**
 * Locate en Translation
 *
 * Returns an array with the string to be translated (as passed to `Craft::t('locate', '...')`) as
 * the key, and the translation as the value.
 *
 * http://www.yiiframework.com/doc-2.0/guide-tutorial-i18n.html
 *
 * @author    Isaac Gray
 * @package   Locate
 * @since     2.0.0
 */
return [
    'Locate plugin loaded' => 'Locate plugin loaded',
    'plugin settings' => 'plugin settings',
    'Modify the default behaviour of the Autocomplete field by passing in a JSON object of options. Setting the options here will override any global options set in the plugin settings. For more detail on how to correctly format the options, please see the' => 'Modify the default behaviour of the Autocomplete field by passing in a JSON object of options. Setting the options here will override any global options set in the plugin settings. For more detail on how to correctly format the options, please see the',
    'Before using the Location field you must set your Google Maps API key in the' => 'Before using the Location field you must set your Google Maps API key in the',
    'Important:' => 'Important:',
    'Please ask your site administrator to set the Google Maps API key in the Location plugin settings' => 'Please ask your site administrator to set the Google Maps API key in the Location plugin settings',
    'Google autocomplete options' => 'Google autocomplete options',
    'Google Autocomplete Global Options' => 'Google Autocomplete Global Options',
    'Google Maps API Key' => 'Google Maps API Key',
    'Use your API key, or get one from <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Google</a>' => 'Use your API key, or get one from <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Google</a>',
    'The Autocomplete field defaults to all place types (cities, addresses, businesses, etc.) in the world. By default, the API will attempt to detect the user\'s location from their IP address, and will bias the results to that location. You can modify the default behaviour by passing in a JSON object of options. For a full list of allowed options see the official documentation from' => 'The Autocomplete field defaults to all place types (cities, addresses, businesses, etc.) in the world. By default, the API will attempt to detect the user\'s location from their IP address, and will bias the results to that location. You can modify the default behaviour by passing in a JSON object of options. For a full list of allowed options see the official documentation from',
    'You can set these options globally, or on a per field basis. Options set on individual fields will override the global options' => 'You can set these options globally, or on a per field basis. Options set on individual fields will override the global options',
    'Warning:' => 'Warning:',
    'The options object must be formatted correctly or the plugin will not function! Please see the plugin documentation for complete instructions and examples. If after doing so you are unclear about what to enter below, please leave it blank.' => 'The options object must be formatted correctly or the plugin will not function! Please see the plugin documentation for complete instructions and examples. If after doing so you are unclear about what to enter below, please leave it blank.',
    'Plugin documentation' => 'Plugin documentation',
    'Only show establishments and bias the results to the Pacific Northwest, and only in Canada (ie. Doughnut shops in Vancouver)' => 'Only show establishments and bias the results to the Pacific Northwest, and only in Canada (ie. Doughnut shops in Vancouver)',

];
