<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Delete a Close opportunity status.
 */
class CloseDeleteOpportunityStatus extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_delete_opportunity_status';

    protected string $toolDescription = 'Delete a Close opportunity status.';

    protected string $method = 'DELETE';

    protected string $path = '/status/opportunity/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close opportunity status ID to delete.'],
    ];
}
