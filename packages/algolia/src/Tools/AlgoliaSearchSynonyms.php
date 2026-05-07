<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search synonyms in an Algolia index.
 */
class AlgoliaSearchSynonyms extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_search_synonyms'; }
    public function description(): string { return 'Search synonyms in an Algolia index.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'params' => ['type' => 'object', 'description' => 'Search parameters such as query, type, page, and hitsPerPage.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->searchSynonyms($this->requiredString($args, 'indexName'), $this->objectArg($args, 'params'))); }
}
