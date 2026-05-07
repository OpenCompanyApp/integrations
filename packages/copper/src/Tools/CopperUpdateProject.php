<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Update a Copper project.
 */
class CopperUpdateProject extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_update_project';

    protected string $toolDescription = 'Update a Copper project. Send only fields that should change.';

    protected string $method = 'PUT';

    protected string $path = '/projects/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['name', 'details', 'assignee_id', 'company_id', 'opportunity_id', 'status_id', 'tags', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper project ID.'],
        'name' => ['type' => 'string', 'description' => 'Project name.'],
        'details' => ['type' => 'string', 'description' => 'Project details.'],
        'assignee_id' => ['type' => 'integer', 'description' => 'Assigned user ID.'],
        'company_id' => ['type' => 'integer', 'description' => 'Related company ID.'],
        'opportunity_id' => ['type' => 'integer', 'description' => 'Related opportunity ID.'],
        'status_id' => ['type' => 'integer', 'description' => 'Project status ID.'],
        'tags' => ['type' => 'array', 'description' => 'Project tags.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
