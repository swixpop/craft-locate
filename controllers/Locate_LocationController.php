<?php
/**
 * Locate plugin for Craft CMS
 *
 * Locate_Location Controller
 *
 *
 * @author    Isaac Gray
 * @copyright Copyright (c) 2016 Isaac Gray
 * @link      http://isaacgray.me
 * @package   Locate
 * @since     0.4.9
 */

namespace Craft;

class Locate_LocationController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex',
        );

    public function actionGetInputType()
    {

    }
    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/locate
     */
    public function actionIndex()
    {
    }
}
