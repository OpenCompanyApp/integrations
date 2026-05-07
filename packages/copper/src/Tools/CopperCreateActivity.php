<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Create a Copper activity.
 */
class CopperCreateActivity extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_create_activity';

    protected string $toolDescription = 'Create a Copper activity on a lead, person, company, opportunity, or project.';

    protected string $method = 'POST';

    protected string $path = '/activities';

    /** @var list<string> */
    protected array $required = ['parent', 'type'];

    /** @var list<string> */
    protected array $bodyParams = ['parent', 'type', 'details', 'activity_date', 'user_id', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'parent' => ['type' => 'object', 'required' => true, 'description' => 'Parent entity object with type and id.'],
        'type' => ['type' => 'object', 'required' => true, 'description' => 'Activity type object or ID shape expected by Copper.'],
        'details' => ['type' => 'string', 'description' => 'Activity details.'],
        'activity_date' => ['type' => 'integer', 'description' => 'Activity timestamp.'],
        'user_id' => ['type' => 'integer', 'description' => 'Copper user ID.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
