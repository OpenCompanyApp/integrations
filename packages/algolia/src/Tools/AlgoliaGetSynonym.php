<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Algolia synonym by objectID.
 */
class AlgoliaGetSynonym extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_get_synonym'; }
    public function description(): string { return 'Get one Algolia synonym by objectID.'; }
    public function parameters(): array { return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'], 'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The synonym objectID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getSynonym($this->requiredString($args, 'indexName'), $this->requiredString($args, 'objectID'))); }
}
