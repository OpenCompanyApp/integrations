<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Save multiple Algolia synonyms.
 */
class AlgoliaBatchSynonyms extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_batch_synonyms'; }
    public function description(): string { return 'Create or update multiple Algolia synonyms in one request.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'synonyms' => ['type' => 'array', 'required' => true, 'description' => 'Array of synonym objects.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters such as replaceExistingSynonyms or forwardToReplicas.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->batchSynonyms($this->requiredString($args, 'indexName'), $this->requiredList($args, 'synonyms'), $this->objectArg($args, 'query'))); }
}
