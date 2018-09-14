<?php
/**
 * Locate plugin for Craft CMS 3.x
 *
 * Harness the power of the Google Autocomplete API inside Craft. Adds an autocomplete search box to Craft entries.
 *
 * @link      https://www.vaersaagod.no/
 * @copyright Copyright (c) 2018 Isaac Gray
 */

namespace swixpop\locate\models;

use swixpop\locate\Locate;

use Craft;
use craft\base\Model;

/**
 * @author    Isaac Gray
 * @package   Locate
 * @since     2.0.0
 */
class LocateModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $lat = '';


    /**
     * @var string
     */
    public $lng = '';

    /**
     * @var string
     */
    public $location = '';

    /**
     * @var string
     */
    public $placeid = '';

    /**
     * @var string
     */
    public $locationData = '';

    // Public Methods
    // =========================================================================

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['lat', 'lng', 'location', 'placeid', 'locationData'], 'string'],
            [['lat', 'lng', 'location', 'placeid', 'locationData'], 'default', 'value' => ''],
        ];
    }
}
