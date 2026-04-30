<?php

declare(strict_types=1);

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

(static function (): void {
    /**
     * Add further columns to pages records
     */
    $tempColumns = [
        'tx_sitepackage_colorscheme' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:pages.tx_sitepackage_colorscheme.title',
            'description' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:pages.tx_sitepackage_colorscheme.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'size' => 1,
                'maxitems' => 1,
                'items' => [
                    [
                        'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:pages.tx_sitepackage_colorscheme.I.0',
                        'value' => '0',
                        'icon' => '',
                    ],
                    [
                        'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:pages.tx_sitepackage_colorscheme.I.1',
                        'value' => '1',
                        'icon' => '',
                    ],
                    [
                        'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:pages.tx_sitepackage_colorscheme.I.2',
                        'value' => '2',
                        'icon' => '',
                    ],
                ],
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
    ];

    ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns);

    ExtensionManagementUtility::addFieldsToPalette(
        'pages',
        'layout',
        '--linebreak--,tx_sitepackage_colorscheme',
        'after:newUntil'
    );
})();
