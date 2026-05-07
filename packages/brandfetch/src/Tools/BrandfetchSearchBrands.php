<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Search for brands by name or domain.
 */
class BrandfetchSearchBrands extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_search_brands';
    protected const TOOL_DESCRIPTION = 'Search for brands by name or domain using Brand Search API.';
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Brand name or domain to search for.'],
        'client_id' => ['type' => 'string', 'description' => 'Optional Brand Search client ID override.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->searchBrands(
            (string) $this->required($args, 'query'),
            isset($args['client_id']) ? (string) $args['client_id'] : null,
        );
    }
}
