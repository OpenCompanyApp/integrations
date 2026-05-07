<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Create a Close sales opportunity.
 */
class CloseCreateOpportunity extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_create_opportunity';

    protected string $toolDescription = 'Create a Close opportunity for a lead with status, value, expected close date, and confidence.';

    protected string $method = 'POST';

    protected string $path = '/opportunity/';

    /** @var list<string> */
    protected array $required = ['lead_id', 'status_id'];

    /** @var list<string> */
    protected array $bodyParams = ['lead_id', 'status_id', 'user_id', 'note', 'value', 'value_period', 'date_won', 'date_lost', 'expected_close_date', 'confidence', 'custom'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Close lead ID for this opportunity.'],
        'status_id' => ['type' => 'string', 'required' => true, 'description' => 'Opportunity status ID.'],
        'user_id' => ['type' => 'string', 'description' => 'Assigned Close user ID.'],
        'note' => ['type' => 'string', 'description' => 'Opportunity note or title.'],
        'value' => ['type' => 'integer', 'description' => 'Opportunity value in the smallest currency unit used by Close.'],
        'value_period' => ['type' => 'string', 'description' => 'Value period such as one_time, monthly, annual, or custom Close value period.'],
        'expected_close_date' => ['type' => 'string', 'description' => 'Expected close date in YYYY-MM-DD format.'],
        'confidence' => ['type' => 'integer', 'description' => 'Confidence percentage.'],
        'custom' => ['type' => 'object', 'description' => 'Custom opportunity fields.'],
    ];
}
