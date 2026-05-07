<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Create a Copper project.
 */
class CopperCreateProject extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_create_project';

    protected string $toolDescription = 'Create a Copper project.';

    protected string $method = 'POST';

    protected string $path = '/projects';

    /** @var list<string> */
    protected array $required = ['name'];

    /** @var list<string> */
    protected array $bodyParams = ['name', 'details', 'assignee_id', 'company_id', 'opportunity_id', 'status_id', 'tags', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Project name.'],
        'details' => ['type' => 'string', 'description' => 'Project details.'],
        'assignee_id' => ['type' => 'integer', 'description' => 'Assigned user ID.'],
        'company_id' => ['type' => 'integer', 'description' => 'Related company ID.'],
        'opportunity_id' => ['type' => 'integer', 'description' => 'Related opportunity ID.'],
        'status_id' => ['type' => 'integer', 'description' => 'Project status ID.'],
        'tags' => ['type' => 'array', 'description' => 'Project tags.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
