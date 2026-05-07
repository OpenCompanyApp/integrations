<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Create a Close lead status.
 */
class CloseCreateLeadStatus extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_create_lead_status';

    protected string $toolDescription = 'Create a new Close lead status.';

    protected string $method = 'POST';

    protected string $path = '/status/lead/';

    /** @var list<string> */
    protected array $required = ['label'];

    /** @var list<string> */
    protected array $bodyParams = ['label'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'label' => ['type' => 'string', 'required' => true, 'description' => 'Lead status label.'],
    ];
}
