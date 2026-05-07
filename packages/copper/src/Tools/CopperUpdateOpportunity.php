<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Update a Copper opportunity.
 */
class CopperUpdateOpportunity extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_update_opportunity';

    protected string $toolDescription = 'Update a Copper opportunity. Send only fields that should change.';

    protected string $method = 'PUT';

    protected string $path = '/opportunities/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['name', 'company_id', 'primary_contact_id', 'assignee_id', 'pipeline_id', 'pipeline_stage_id', 'status', 'monetary_value', 'win_probability', 'close_date', 'details', 'customer_source_id', 'loss_reason_id', 'tags', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper opportunity ID.'],
        'name' => ['type' => 'string', 'description' => 'Opportunity name.'],
        'company_id' => ['type' => 'integer', 'description' => 'Related company ID.'],
        'primary_contact_id' => ['type' => 'integer', 'description' => 'Primary person ID.'],
        'assignee_id' => ['type' => 'integer', 'description' => 'Assigned user ID.'],
        'pipeline_id' => ['type' => 'integer', 'description' => 'Pipeline ID.'],
        'pipeline_stage_id' => ['type' => 'integer', 'description' => 'Pipeline stage ID.'],
        'status' => ['type' => 'string', 'description' => 'Opportunity status.'],
        'monetary_value' => ['type' => 'integer', 'description' => 'Opportunity value.'],
        'win_probability' => ['type' => 'integer', 'description' => 'Win probability percentage.'],
        'close_date' => ['type' => 'string', 'description' => 'Expected close date.'],
        'details' => ['type' => 'string', 'description' => 'Opportunity details.'],
        'customer_source_id' => ['type' => 'integer', 'description' => 'Customer source ID.'],
        'loss_reason_id' => ['type' => 'integer', 'description' => 'Loss reason ID.'],
        'tags' => ['type' => 'array', 'description' => 'Tags to set.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
