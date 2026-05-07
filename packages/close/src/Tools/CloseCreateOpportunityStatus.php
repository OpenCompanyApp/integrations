<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Create a Close opportunity status.
 */
class CloseCreateOpportunityStatus extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_create_opportunity_status';

    protected string $toolDescription = 'Create a Close opportunity status in a pipeline.';

    protected string $method = 'POST';

    protected string $path = '/status/opportunity/';

    /** @var list<string> */
    protected array $required = ['label', 'type'];

    /** @var list<string> */
    protected array $bodyParams = ['label', 'type', 'pipeline_id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'label' => ['type' => 'string', 'required' => true, 'description' => 'Opportunity status label.'],
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Status type: active, won, or lost.', 'enum' => ['active', 'won', 'lost']],
        'pipeline_id' => ['type' => 'string', 'description' => 'Pipeline ID when the organization uses multiple pipelines.'],
    ];
}
