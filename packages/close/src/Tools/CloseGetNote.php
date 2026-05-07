<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Fetch a single Close note activity by ID.
 */
class CloseGetNote extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_get_note';

    protected string $toolDescription = 'Fetch a single Close note activity by ID.';

    protected string $path = '/activity/note/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close note activity ID.'],
    ];
}
