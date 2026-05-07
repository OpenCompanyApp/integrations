<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Update a Copper activity.
 */
class CopperUpdateActivity extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_update_activity';

    protected string $toolDescription = 'Update a Copper activity. Send only fields that should change.';

    protected string $method = 'PUT';

    protected string $path = '/activities/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['parent', 'type', 'details', 'activity_date', 'user_id', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper activity ID.'],
        'parent' => ['type' => 'object', 'description' => 'Parent entity object.'],
        'type' => ['type' => 'object', 'description' => 'Activity type object.'],
        'details' => ['type' => 'string', 'description' => 'Activity details.'],
        'activity_date' => ['type' => 'integer', 'description' => 'Activity timestamp.'],
        'user_id' => ['type' => 'integer', 'description' => 'Copper user ID.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
