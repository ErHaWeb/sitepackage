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
 *
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/FileStructure/ExtEmconf.html
 */

declare(strict_types=1);

$EM_CONF[$_EXTKEY] = [
    'title' => 'Sitepackage',
    'description' => 'Sitepackage for TYPO3 11',
    'category' => 'templates',
    'author' => 'Author Name',
    'author_email' => 'email@author.name.com',
    'author_company' => 'Author Company',
    'state' => 'stable',
    'clearcacheonload' => 1,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
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
