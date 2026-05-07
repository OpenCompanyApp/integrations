<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Return colors from a brand profile.
 */
class BrandfetchListColors extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_list_colors';
    protected const TOOL_DESCRIPTION = 'Fetch a brand and return its color palette.';
    protected const PARAMETERS = [
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Domain, Brand ID, ticker, ISIN, or crypto symbol.'],
        'brand_id' => ['type' => 'string', 'description' => 'Legacy alias for identifier.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->listColors((string) ($args['identifier'] ?? $this->required($args, 'brand_id')));
    }
}
