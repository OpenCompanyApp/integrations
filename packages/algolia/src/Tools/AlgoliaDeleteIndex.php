<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete an Algolia index.
 */
class AlgoliaDeleteIndex extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_delete_index'; }
    public function description(): string { return 'Delete an Algolia index and all its records.'; }
    public function parameters(): array
    {
        return ['indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.']];
    }

    /**
     * Delete an index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteIndex($this->requiredString($args, 'indexName')));
    }
}
