<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Get brand data by generic identifier.
 */
class BrandfetchGetBrand extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_get_brand';
    protected const TOOL_DESCRIPTION = 'Get brand data by domain, Brand ID, ticker, ISIN, or crypto symbol.';
    protected const PARAMETERS = [
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Domain, Brand ID, ticker, ISIN, or crypto symbol.'],
        'domain' => ['type' => 'string', 'description' => 'Legacy alias for identifier.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->getBrand((string) ($args['identifier'] ?? $this->required($args, 'domain')));
    }
}
