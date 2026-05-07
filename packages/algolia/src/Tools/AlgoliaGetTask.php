<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the status of an Algolia asynchronous task.
 */
class AlgoliaGetTask extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_get_task'; }
    public function description(): string { return 'Get the status of an Algolia indexing task.'; }
    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'],
            'taskID' => ['type' => 'string', 'required' => true, 'description' => 'The Algolia task ID.'],
        ];
    }

    /**
     * Get an Algolia task status.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getTask($this->requiredString($args, 'indexName'), $this->requiredString($args, 'taskID')));
    }
}
