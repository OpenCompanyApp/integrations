<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Get brand data by explicit stock or ETF ticker route.
 */
class BrandfetchGetBrandByTicker extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_get_brand_by_ticker';
    protected const TOOL_DESCRIPTION = 'Get brand data using the explicit stock or ETF ticker route.';
    protected const PARAMETERS = [
        'ticker' => ['type' => 'string', 'required' => true, 'description' => 'Stock or ETF ticker, for example NKE.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->getBrandByType('ticker', (string) $this->required($args, 'ticker'));
    }
}
