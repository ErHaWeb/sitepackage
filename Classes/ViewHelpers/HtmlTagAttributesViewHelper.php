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
 * https://docs.typo3.org/m/typo3/reference-coreapi/10.4/en-us/ApiOverview/Fluid/DevelopCustomViewhelper.html
 */

namespace VendorName\Sitepackage\ViewHelpers;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class HtmlTagAttributesViewHelper extends AbstractViewHelper
{
    /**
     * Initialize Arguments
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('data', 'array', '');
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $tsfe = $GLOBALS['TSFE'] ?? GeneralUtility::makeInstance(
            TypoScriptFrontendController::class,
            GeneralUtility::makeInstance(Context::class)
        );

        foreach ($this->arguments['data'] as $key => $value) {
            $tsfe->config['config']['htmlTag.']['attributes.'][$key] = $value;
        }

        return '';
    }
}
