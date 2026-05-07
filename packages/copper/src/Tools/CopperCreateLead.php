<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Create a Copper lead.
 */
class CopperCreateLead extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_create_lead';

    protected string $toolDescription = 'Create a new Copper lead.';

    protected string $method = 'POST';

    protected string $path = '/leads';

    /** @var list<string> */
    protected array $required = ['name'];

    /** @var list<string> */
    protected array $bodyParams = ['name', 'company_name', 'title', 'email', 'phone_numbers', 'address', 'details', 'assignee_id', 'customer_source_id', 'status_id', 'tags', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Lead name.'],
        'company_name' => ['type' => 'string', 'description' => 'Lead company name.'],
        'title' => ['type' => 'string', 'description' => 'Lead title.'],
        'email' => ['type' => 'object', 'description' => 'Copper email object.'],
        'phone_numbers' => ['type' => 'array', 'description' => 'Phone number objects.'],
        'address' => ['type' => 'object', 'description' => 'Address object.'],
        'details' => ['type' => 'string', 'description' => 'Lead details.'],
        'assignee_id' => ['type' => 'integer', 'description' => 'Assigned user ID.'],
        'customer_source_id' => ['type' => 'integer', 'description' => 'Customer source ID.'],
        'status_id' => ['type' => 'integer', 'description' => 'Lead status ID.'],
        'tags' => ['type' => 'array', 'description' => 'Lead tags.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
