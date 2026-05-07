<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Return logos from a brand profile.
 */
class BrandfetchListLogos extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_list_logos';
    protected const TOOL_DESCRIPTION = 'Fetch a brand and return its logos array.';
    protected const PARAMETERS = [
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Domain, Brand ID, ticker, ISIN, or crypto symbol.'],
        'brand_id' => ['type' => 'string', 'description' => 'Legacy alias for identifier.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->listLogos((string) ($args['identifier'] ?? $this->required($args, 'brand_id')));
    }
}
