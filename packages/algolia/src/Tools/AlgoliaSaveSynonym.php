<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or replace an Algolia synonym.
 */
class AlgoliaSaveSynonym extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_save_synonym'; }
    public function description(): string { return 'Create or replace an Algolia synonym.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The synonym objectID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Synonym payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->saveSynonym($this->requiredString($args, 'indexName'), $this->requiredString($args, 'objectID'), $this->objectArg($args, 'payload'))); }
}
