<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete one Algolia synonym.
 */
class AlgoliaDeleteSynonym extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_delete_synonym'; }
    public function description(): string { return 'Delete one Algolia synonym by objectID.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The synonym objectID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteSynonym($this->requiredString($args, 'indexName'), $this->requiredString($args, 'objectID'))); }
}
