<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Rename or update a Close opportunity status.
 */
class CloseUpdateOpportunityStatus extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_update_opportunity_status';

    protected string $toolDescription = 'Rename or update a Close opportunity status.';

    protected string $method = 'PUT';

    protected string $path = '/status/opportunity/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['label'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close opportunity status ID.'],
        'label' => ['type' => 'string', 'description' => 'Updated opportunity status label.'],
    ];
}
