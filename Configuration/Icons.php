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
 * Registers custom Icons in the IconRegistry provided by EXT:sitepackage
 *
 * https://docs.typo3.org/m/typo3/reference-coreapi/11.5/en-us/ExtensionArchitecture/FileStructure/Configuration/Icons.html
 */

return [
    'sitepackage-icon' => [
        // icon provider class
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        // the source SVG for the SvgIconProvider
        'source' => 'EXT:sitepackage/Resources/Public/Icons/Sitepackage.svg',
    ],
];
