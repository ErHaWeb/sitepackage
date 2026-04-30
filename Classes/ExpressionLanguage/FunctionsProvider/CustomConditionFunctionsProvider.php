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
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/SymfonyExpressionLanguage/Index.html#additional-functions
 */

namespace VendorName\Sitepackage\ExpressionLanguage\FunctionsProvider;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

final class CustomConditionFunctionsProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @return ExpressionFunction[]
     */
    public function getFunctions(): array
    {
        return [
            $this->getRootlineFieldFunction(),
        ];
    }

    protected function getRootlineFieldFunction(): ExpressionFunction
    {
        return new ExpressionFunction(
            'rootlineField',
            static fn(): null => null,
            static function (array $arguments, string $field): string|false {
                $rootlinePages = array_reverse($arguments['tree']->rootLine);
                foreach ($rootlinePages as $rootlinePage) {
                    $value = $rootlinePage[$field] ?? null;
                    if ($value) {
                        return (string) $value;
                    }
                }
                return false;
            }
        );
    }
}
