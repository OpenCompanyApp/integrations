<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Update an existing Close opportunity.
 */
class CloseUpdateOpportunity extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_update_opportunity';

    protected string $toolDescription = 'Update an existing Close opportunity. Send only fields that should change.';

    protected string $method = 'PUT';

    protected string $path = '/opportunity/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['lead_id', 'status_id', 'user_id', 'note', 'value', 'value_period', 'date_won', 'date_lost', 'expected_close_date', 'confidence', 'custom'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close opportunity ID to update.'],
        'lead_id' => ['type' => 'string', 'description' => 'Move the opportunity to another lead.'],
        'status_id' => ['type' => 'string', 'description' => 'New opportunity status ID.'],
        'user_id' => ['type' => 'string', 'description' => 'Assigned Close user ID.'],
        'note' => ['type' => 'string', 'description' => 'Updated note.'],
        'value' => ['type' => 'integer', 'description' => 'Updated opportunity value.'],
        'value_period' => ['type' => 'string', 'description' => 'Updated value period.'],
        'expected_close_date' => ['type' => 'string', 'description' => 'Expected close date in YYYY-MM-DD format.'],
        'confidence' => ['type' => 'integer', 'description' => 'Confidence percentage.'],
        'custom' => ['type' => 'object', 'description' => 'Custom opportunity fields.'],
    ];
}
