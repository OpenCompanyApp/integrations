<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch a Copper task by ID.
 */
class CopperGetTask extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_task';

    protected string $toolDescription = 'Fetch a Copper task by ID.';

    protected string $path = '/tasks/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper task ID.'],
    ];
}
