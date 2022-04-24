<?php namespace Nerdauto\Backendskin;

use App;
use Config;
use Event;
use System\Classes\PluginBase;

/**
 * backendskin Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'backendskin',
            'description' => 'A backend skin for NERD AUTO',
            'author'      => 'nerdauto',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Checking if we're in the backend. If not, end the cycle.
         */
        if (!App::runningInBackend()) {
            return;
        }
        /**
         * These initialize when before the page is loaded
         *
         * TODO Make the paths dynamic with a selector in the settings
         */
        Event::listen('backend.page.beforeDisplay', function($controller) {
            $controller->addCss('/plugins/nerdauto/backendskin/theme/nerdauto/assets/css/style.css');
            $controller->addJs('/plugins/nerdauto/backendskin/theme/nerdauto/assets/js/script.js');
        });
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Layout override in Config/Backend.php
         *
         * This should return a path to the theme class
         *
         * TODO Make the path dynamic with a selector in the settings
         */
        Config::set('backend.skin', 'nerdauto\backendskin\theme\NerdAuto');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Nerdauto\Backendskin\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'nerdauto.backendskin.some_permission' => [
                'tab' => 'backendskin',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'backendskin' => [
                'label'       => 'backendskin',
                'url'         => Backend::url('nerdauto/backendskin/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['nerdauto.backendskin.*'],
                'order'       => 500,
            ],
        ];
    }
}
