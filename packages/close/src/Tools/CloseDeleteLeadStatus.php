<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Delete a Close lead status.
 */
class CloseDeleteLeadStatus extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_delete_lead_status';

    protected string $toolDescription = 'Delete a Close lead status.';

    protected string $method = 'DELETE';

    protected string $path = '/status/lead/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close lead status ID to delete.'],
    ];
}
