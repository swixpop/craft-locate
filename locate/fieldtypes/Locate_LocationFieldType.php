<?php
/**
 * Locate plugin for Craft CMS
 *
 * Locate_Location FieldType
 *
 *
 * @author    Isaac Gray
 * @copyright Copyright (c) 2016 Isaac Gray
 * @link      http://isaacgray.me
 * @package   Locate
 * @since     0.4.9
 */

namespace Craft;

class Locate_LocationFieldType extends BaseFieldType
{
    /**
     * Returns the name of the fieldtype.
     *
     * @return mixed
     */
    public function getName()
    {
        return Craft::t('Location');
    }

    /**
     * Returns the content attribute config.
     *
     * @return mixed
     */
    public function defineContentAttribute()
    {
        return AttributeType::Mixed;
    }

    /**
     * Returns the field's input HTML.
     *
     * @param string $name
     * @param mixed  $value
     * @return string
     */
    public function getInputHtml($name, $value)
    {
        if (!$value)
            $value = new Locate_LocationModel();

        $id = craft()->templates->formatInputId($name);
        $namespacedId = craft()->templates->namespaceInputId($id);

        $apiKey = craft()->locate_admin->getApiKey();

        if ($apiKey) {
          craft()->templates->includeJsFile('https://maps.googleapis.com/maps/api/js?key='.$apiKey.'&libraries=places', true);
          craft()->templates->includeJsResource('locate/js/fields/Locate_LocationFieldType.js');

  /* -- Variables to pass down to our field.js */
          if ($this->getSettings()->optionsObject) {
            $jsonOptions = $this->getSettings()->optionsObject;
          } else {
            $jsonOptions = craft()->locate_admin->getGlobalOptions();
          }
          $jsonVars = array(
              'id' => $id,
              'name' => $name,
              'namespace' => $namespacedId,
              'prefix' => craft()->templates->namespaceInputId(""),
              'optionsObject' => $jsonOptions,
              );

          $jsonVars = json_encode($jsonVars);
          craft()->templates->includeJs("$('#{$namespacedId}-location').Locate__LocationFieldType(" . $jsonVars . ");");
        }

        // Include our Javascript & CSS
        craft()->templates->includeCssResource('locate/css/fields/Locate_LocationFieldType.css');
        // craft()->templates->includeJsResource('locate/js/fields/Locate_LocationFieldType.js');



/* -- Variables to pass down to our rendered template */

        $variables = array(
            'id' => $id,
            'name' => $name,
            'namespaceId' => $namespacedId,
            'values' => $value,
            'apiKey' => $apiKey,
            );

        return craft()->templates->render('locate/fields/Locate_LocationFieldType.twig', $variables);

    }

    /**
     * Returns the input value as it should be saved to the database.
     *
     * @param mixed $value
     * @return mixed
     */
    public function prepValueFromPost($value)
    {

        if ( empty($value) )
        {
            return new Locate_LocationModel();
        }

        $coordinates = explode('|', $value);
        $location = new Locate_LocationModel();
        $location->lat = $coordinates[0];
        $location->lng = $coordinates[1];
        $location->location = $coordinates[2];
        $location->placeid = $coordinates[3];
        return $location;
    }

    /**
     * Prepares the field's value for use.
     *
     * @param mixed $value
     * @return mixed
     */
    public function prepValue($value)
    {
      return $value;
    }

    protected function defineSettings()
    {
        return array(
            'optionsObject' => array(AttributeType::String, 'default' => '')
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('locate/fields/Locate_LocationFieldSettings.twig', array(
            'settings' => $this->getSettings()
        ));
    }
    public function prepSettings($settings)
    {
        return $settings;
    }
}
