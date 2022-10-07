<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

declare(strict_types=1);

/**
 * https://docs.typo3.org/m/typo3/reference-coreapi/11.5/en-us/ExtensionArchitecture/FileStructure/ExtLocalconf.html
 */

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

(static function () {
    /**
     * Adding the default User TSconfig
     */
    ExtensionManagementUtility::addUserTSConfig(trim(
        '
                @import "EXT:sitepackage/Configuration/TsConfig/User/*.tsconfig"
            '
    ));

    /**
     * Add static TypoScript from EXT:fluid_styled_content
     */
    if (ExtensionManagementUtility::isLoaded('fluid_styled_content')) {
        ExtensionManagementUtility::addTypoScriptConstants(trim(
            '
                @import "EXT:fluid_styled_content/Configuration/TypoScript/constants.typoscript"
                
                styles {
                    templates {
                        templateRootPath = EXT:sitepackage/Resources/Private/Templates/Content/
                        partialRootPath = EXT:sitepackage/Resources/Private/Partials/Content/
                        layoutRootPath = EXT:sitepackage/Resources/Private/Layouts/Content/
                    }
                }
            '
        ));
        ExtensionManagementUtility::addTypoScriptSetup(trim(
            '
                @import "EXT:fluid_styled_content/Configuration/TypoScript/setup.typoscript"
            '
        ));
    }

    /**
     * Add static TypoScript from EXT:seo
     */
    if (ExtensionManagementUtility::isLoaded('seo')) {
        ExtensionManagementUtility::addTypoScriptConstants(trim(
            '
                @import "EXT:seo/Configuration/TypoScript/XmlSitemap/constants.typoscript"
            '
        ));
        ExtensionManagementUtility::addTypoScriptSetup(trim(
            '
                @import "EXT:seo/Configuration/TypoScript/XmlSitemap/setup.typoscript"
            '
        ));
    }

    /**
     * Add static TypoScript from EXT:form and register custom configuration
     */
    if (ExtensionManagementUtility::isLoaded('form')) {
        ExtensionManagementUtility::addTypoScriptSetup(trim(
            '
                @import "EXT:form/Configuration/TypoScript/setup.typoscript"
                module.tx_form.settings.yamlConfigurations.100 = EXT:sitepackage/Configuration/Form/CustomFormSetup.yaml
                plugin.tx_form.settings.yamlConfigurations.100 = EXT:sitepackage/Configuration/Form/CustomFormSetup.yaml
            '
        ));
    }

    /**
     * Add further rootline fields
     */
    $rootlineFields = &$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'];
    if ($rootlineFields !== '') {
        $rootlineFields .= ',';
    }
    $rootlineFields .= 'tx_sitepackage_colorscheme';

    /**
     * Add sitepackage preset for RTE
     */
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sitepackage'] = 'EXT:sitepackage/Configuration/RTE/RteConfig.yaml';

    /**
     * Get Extension Configuration
     */
    $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)
        ->get('sitepackage');

    /**
     * Customize Login Mask and Backend display based on Extension Configuration
     */
    ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend'],
        [
            'backendFavicon' => $extensionConfiguration['backend']['backendFavicon'],
            'backendLogo' => $extensionConfiguration['backend']['backendLogo'],
            'loginBackgroundImage' => $extensionConfiguration['backend']['loginBackgroundImage'],
            'loginFootnote' => str_replace('%s', date("Y"), $extensionConfiguration['backend']['loginFootnote']),
            'loginHighlightColor' => $extensionConfiguration['backend']['loginHighlightColor'],
            'loginLogo' => $extensionConfiguration['backend']['loginLogo'],
            'loginLogoAlt' => $extensionConfiguration['backend']['loginLogoAlt']
        ]
    );
})();