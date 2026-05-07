<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Delete a Close opportunity.
 */
class CloseDeleteOpportunity extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_delete_opportunity';

    protected string $toolDescription = 'Delete an opportunity from Close.';

    protected string $method = 'DELETE';

    protected string $path = '/opportunity/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close opportunity ID to delete.'],
    ];
}
