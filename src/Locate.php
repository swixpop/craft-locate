<?php
/**
 * Locate plugin for Craft CMS 3.x
 *
 * Harness the power of the Google Autocomplete API inside Craft. Adds an autocomplete search box to Craft entries.
 *
 * @link      https://www.vaersaagod.no/
 * @copyright Copyright (c) 2018 Isaac Gray
 */

namespace swixpop\locate;

use swixpop\locate\models\Settings;
use swixpop\locate\fields\LocateField as LocateFieldField;

use Craft;
use craft\base\Plugin;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * @author    Isaac Gray
 * @package   Locate
 * @since     2.0.0
 *
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class Locate extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Locate
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '2.0.1';

    /**
     * @var bool
     */
    public $hasCpSection = true;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register our fields
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = LocateFieldField::class;
            }
        );

        Craft::info(
            Craft::t(
                'locate',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'locate/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
