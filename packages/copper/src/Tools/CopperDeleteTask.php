<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Delete a Copper task.
 */
class CopperDeleteTask extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_delete_task';

    protected string $toolDescription = 'Delete a task from Copper.';

    protected string $method = 'DELETE';

    protected string $path = '/tasks/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper task ID to delete.'],
    ];
}
