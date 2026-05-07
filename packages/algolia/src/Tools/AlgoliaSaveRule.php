<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or replace an Algolia query rule.
 */
class AlgoliaSaveRule extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_save_rule'; }
    public function description(): string { return 'Create or replace an Algolia query rule.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The rule objectID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Rule payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->saveRule($this->requiredString($args, 'indexName'), $this->requiredString($args, 'objectID'), $this->objectArg($args, 'payload'))); }
}
