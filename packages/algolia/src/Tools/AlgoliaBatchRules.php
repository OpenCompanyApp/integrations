<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Save multiple Algolia query rules.
 */
class AlgoliaBatchRules extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_batch_rules'; }
    public function description(): string { return 'Create or update multiple Algolia query rules in one request.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'rules' => ['type' => 'array', 'required' => true, 'description' => 'Array of rule objects.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters such as clearExistingRules or forwardToReplicas.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->batchRules($this->requiredString($args, 'indexName'), $this->requiredList($args, 'rules'), $this->objectArg($args, 'query'))); }
}
