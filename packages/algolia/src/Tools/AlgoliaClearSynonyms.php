<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Clear synonyms from an Algolia index.
 */
class AlgoliaClearSynonyms extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_clear_synonyms'; }
    public function description(): string { return 'Clear synonyms from an Algolia index.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters such as forwardToReplicas.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->clearSynonyms($this->requiredString($args, 'indexName'), $this->objectArg($args, 'query'))); }
}
