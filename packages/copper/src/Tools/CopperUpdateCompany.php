<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Update a Copper company.
 */
class CopperUpdateCompany extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_update_company';

    protected string $toolDescription = 'Update an existing Copper company. Send only fields that should change.';

    protected string $method = 'PUT';

    protected string $path = '/companies/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['name', 'details', 'phone_numbers', 'websites', 'address', 'assignee_id', 'contact_type_id', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper company ID.'],
        'name' => ['type' => 'string', 'description' => 'Company name.'],
        'details' => ['type' => 'string', 'description' => 'Company details.'],
        'phone_numbers' => ['type' => 'array', 'description' => 'Phone number objects.'],
        'websites' => ['type' => 'array', 'description' => 'Website objects.'],
        'address' => ['type' => 'object', 'description' => 'Address object.'],
        'assignee_id' => ['type' => 'integer', 'description' => 'Assigned Copper user ID.'],
        'contact_type_id' => ['type' => 'integer', 'description' => 'Company contact type ID.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Copper custom field values.'],
    ];
}
