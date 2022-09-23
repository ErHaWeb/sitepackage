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

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

(static function () {
    /**
     * Adding the default Page TSconfig
     * 
     * https://docs.typo3.org/c/typo3/cms-core/main/en-us/Changelog/12.0/Feature-96614-AutomaticInclusionOfPageTsConfigOfExtensions.html
     */
    $versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
    if ($versionInformation->getMajorVersion() < 12) {
        ExtensionManagementUtility::addPageTSConfig(trim(
            '
                @import "EXT:sitepackage/Configuration/page.tsconfig"
            '
        ));
    }

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
            '
        ));
        ExtensionManagementUtility::addTypoScriptSetup(trim(
            '
                @import "EXT:fluid_styled_content/Configuration/TypoScript/setup.typoscript"
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
})();