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

defined('TYPO3') or die();

(static function () {
    /**
     * Extension key
     */
    $extKey = 'sitepackage';

    /**
     * Page TSconfig file path
     */
    $filePath = 'Configuration/TsConfig/page.tsconfig';

    /**
     * Page TSconfig include path
     */
    $includePath = 'EXT:' . $extKey . '/' . $filePath;

    /**
     * Locallang file path
     */
    $locallangFilePath = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf';

    /**
     * Static Page TSconfig include title
     */
    $title = $locallangFilePath . ':pages.PageTSconfig.' . $extKey . '_title';

    /**
     * Add static TSconfig directly through TCA instead of the API function to be able to translate the title
     */
    $GLOBALS['TCA']['pages']['columns']['tsconfig_includes']['config']['items'][] = [$title, $includePath];
})();