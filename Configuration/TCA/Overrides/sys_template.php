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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(static function () {
    /**
     * Extension key
     */
    $extKey = 'sitepackage';

    /**
     * TypoScript path
     */
    $path = 'Configuration/TypoScript';

    /**
     * Locallang file path
     */
    $locallangFilePath = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf';

    /**
     * Static TypoScript include title
     */
    $title = $locallangFilePath . ':sys_template.TypoScript.' . $extKey . '_title';

    /**
     * Add default TypoScript (constants and setup)
     */
    ExtensionManagementUtility::addStaticFile($extKey, $path, $title);
})();