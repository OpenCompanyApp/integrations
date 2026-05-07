<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search multiple Algolia indices in one request.
 */
class AlgoliaSearchMultiple extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_search_multiple'; }
    public function description(): string { return 'Search multiple Algolia indices in one request using the multiple queries endpoint.'; }
    public function parameters(): array
    {
        return [
            'requests' => ['type' => 'array', 'required' => true, 'description' => 'Array of query objects with indexName and params.'],
            'strategy' => ['type' => 'string', 'description' => 'Multiple query strategy. Defaults to none.'],
        ];
    }

    /**
     * Execute a multiple-index search.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->searchMultiple($this->requiredList($args, 'requests'), $this->stringArg($args, 'strategy', 'none')));
    }
}
