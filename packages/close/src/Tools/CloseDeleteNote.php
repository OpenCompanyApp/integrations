<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Delete a Close note activity.
 */
class CloseDeleteNote extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_delete_note';

    protected string $toolDescription = 'Delete a Close note activity.';

    protected string $method = 'DELETE';

    protected string $path = '/activity/note/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close note activity ID to delete.'],
    ];
}
