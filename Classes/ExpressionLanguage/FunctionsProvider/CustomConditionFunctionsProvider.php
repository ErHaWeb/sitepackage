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
 * https://docs.typo3.org/m/typo3/reference-coreapi/13.4/en-us/ApiOverview/SymfonyExpressionLanguage/Index.html#additional-functions
 */

namespace VendorName\Sitepackage\ExpressionLanguage\FunctionsProvider;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

class CustomConditionFunctionsProvider implements ExpressionFunctionProviderInterface
{
    public function getFunctions(): array
    {
        return [
            $this->getRootlineFieldFunction(),
        ];
    }

    /**
     * @return ExpressionFunction
     */
    protected function getRootlineFieldFunction(): ExpressionFunction
    {
        return new ExpressionFunction('rootlineField', static function ($str) {}, function (...$args) {
            $rootlinePages = array_reverse($args[0]['tree']->rootLine);
            foreach ($rootlinePages as $rootlinePage) {
                $val = $rootlinePage[$args[1]] ?? null;
                if (isset($val) && $val) {
                    return $val;
                }
            }
            return false;
        });
    }
}
