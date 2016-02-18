<?php
/**
 * Locate plugin for Craft CMS
 *
 * Locate_Location Service
 *
 *
 * @author    Isaac Gray
 * @copyright Copyright (c) 2016 Isaac Gray
 * @link      http://isaacgray.me
 * @package   Locate
 * @since     0.4.9
 */

namespace Craft;

class Locate_AdminService extends BaseApplicationComponent
{

    public function getApiKey()
    {
      return craft()->plugins->getPlugin('locate')->getSettings()->googleMapsApiKey;
    }

    public function getGlobalOptions()
    {
      return craft()->plugins->getPlugin('locate')->getSettings()->autocompleteOptions;
    }


}
