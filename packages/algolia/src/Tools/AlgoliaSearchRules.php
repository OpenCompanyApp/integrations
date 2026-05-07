<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search rules in an Algolia index.
 */
class AlgoliaSearchRules extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_search_rules'; }
    public function description(): string { return 'Search query rules in an Algolia index.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'params' => ['type' => 'object', 'description' => 'Rule search parameters such as query, page, and hitsPerPage.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->searchRules($this->requiredString($args, 'indexName'), $this->objectArg($args, 'params'))); }
}
