<?php
/**
 * Locate plugin for Craft CMS
 *
 * Locate_Location Model
 *
 *
 * @author    Isaac Gray
 * @copyright Copyright (c) 2016 Isaac Gray
 * @link      http://isaacgray.me
 * @package   Locate
 * @since     1.0.0
 */

namespace Craft;

class Locate_LocationModel extends BaseModel
{
    /**
     * Defines this model's attributes.
     *
     * @return array
     */
    protected function defineAttributes()
    {
        return array(
            'lat' => AttributeType::String,
            'lng' => AttributeType::String,
            'location' => AttributeType::String,
            'placeid' => AttributeType::String,
        );
    }

}
