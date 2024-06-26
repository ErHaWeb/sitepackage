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
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/SymfonyExpressionLanguage/Index.html#registering-new-provider-within-an-extension
 */

namespace VendorName\Sitepackage\ExpressionLanguage;

use TYPO3\CMS\Core\ExpressionLanguage\AbstractProvider;
use VendorName\Sitepackage\ExpressionLanguage\FunctionsProvider\CustomConditionFunctionsProvider;

class CustomTypoScriptConditionProvider extends AbstractProvider
{
    public function __construct()
    {
        $this->expressionLanguageProviders = [
            CustomConditionFunctionsProvider::class,
        ];
    }
}
