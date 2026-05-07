<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Rename an existing Close lead status.
 */
class CloseUpdateLeadStatus extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_update_lead_status';

    protected string $toolDescription = 'Rename an existing Close lead status.';

    protected string $method = 'PUT';

    protected string $path = '/status/lead/{id}/';

    /** @var list<string> */
    protected array $required = ['id', 'label'];

    /** @var list<string> */
    protected array $bodyParams = ['label'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close lead status ID.'],
        'label' => ['type' => 'string', 'required' => true, 'description' => 'Updated lead status label.'],
    ];
}
