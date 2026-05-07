<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search values for a facet attribute.
 */
class AlgoliaSearchFacetValues extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_search_facet_values'; }
    public function description(): string { return 'Search values for an Algolia facet attribute.'; }
    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'],
            'facetName' => ['type' => 'string', 'required' => true, 'description' => 'The facet attribute name.'],
            'params' => ['type' => 'object', 'description' => 'Facet search parameters such as facetQuery and filters.'],
        ];
    }

    /**
     * Search facet values.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->searchFacetValues(
            $this->requiredString($args, 'indexName'),
            $this->requiredString($args, 'facetName'),
            $this->objectArg($args, 'params')
        ));
    }
}
