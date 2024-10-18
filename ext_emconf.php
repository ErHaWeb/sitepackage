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
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/FileStructure/ExtEmconf.html
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Sitepackage',
    'description' => 'Sitepackage for TYPO3 13',
    'category' => 'templates',
    'author' => 'Author Name',
    'author_email' => 'email@author.name.com',
    'author_company' => 'Author Company',
    'state' => 'stable',
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'VendorName\\Sitepackage\\' => 'Classes',
        ],
    ],
];
