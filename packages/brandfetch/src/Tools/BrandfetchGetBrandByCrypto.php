<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Get brand data by explicit crypto symbol route.
 */
class BrandfetchGetBrandByCrypto extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_get_brand_by_crypto';
    protected const TOOL_DESCRIPTION = 'Get brand data using the explicit crypto symbol route.';
    protected const PARAMETERS = [
        'symbol' => ['type' => 'string', 'required' => true, 'description' => 'Crypto symbol, for example BTC.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->getBrandByType('crypto', (string) $this->required($args, 'symbol'));
    }
}
