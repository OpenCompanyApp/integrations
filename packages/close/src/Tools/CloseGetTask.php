<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Fetch a single Close task by ID.
 */
class CloseGetTask extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_get_task';

    protected string $toolDescription = 'Fetch details for a single Close task by ID.';

    protected string $path = '/task/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close task ID.'],
    ];
}
