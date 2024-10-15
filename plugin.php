<?php

/**
 * Plugin Name: Rayzist Custom Elements
 * Plugin URI: https://rayzist.com/
 * Description: This plugin is meant to be used for any websites hosted by Rayzist Photomask for further customization.
 * Author: Rayzist Photomask
 * Author URI: https://rayzist.com/
 * License: GPLv2
 * Text Domain: breakdance
 * Domain Path: /languages/
 * Version: 1.0.0
 */

namespace BreakdanceCustomElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

add_action('breakdance_loaded', function () {
    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/elements',
        'RayzistCustomElements',
        'element',
        'Custom Rayzist Elements',
        false
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/macros',
        'RayzistCustomElements',
        'macro',
        'Custom Rayzist Macros',
        false,
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/presets',
        'RayzistCustomElements',
        'preset',
        'Custom Rayzist Presets',
        false,
    );
},
    // register elements before loading them
    9
);
