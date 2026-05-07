<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete one Algolia query rule.
 */
class AlgoliaDeleteRule extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_delete_rule'; }
    public function description(): string { return 'Delete one Algolia query rule by objectID.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The rule objectID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteRule($this->requiredString($args, 'indexName'), $this->requiredString($args, 'objectID'))); }
}
