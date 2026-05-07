<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Search Copper activities.
 */
class CopperListActivities extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_activities';

    protected string $toolDescription = 'Search and list Copper activities.';

    protected string $method = 'POST';

    protected string $path = '/activities/search';

    /** @var list<string> */
    protected array $bodyParams = ['page_size', 'page_number', 'sort_by', 'activity_type_ids', 'parent', 'user_ids', 'minimum_activity_date', 'maximum_activity_date'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'page_size' => ['type' => 'integer', 'description' => 'Number of activities per page, up to 200.'],
        'page_number' => ['type' => 'integer', 'description' => 'Page number to fetch.'],
        'sort_by' => ['type' => 'string', 'description' => 'Copper sort field.'],
        'activity_type_ids' => ['type' => 'array', 'description' => 'Activity type IDs.'],
        'parent' => ['type' => 'object', 'description' => 'Parent Copper entity filter.'],
        'user_ids' => ['type' => 'array', 'description' => 'User IDs.'],
        'minimum_activity_date' => ['type' => 'integer', 'description' => 'Minimum activity timestamp.'],
        'maximum_activity_date' => ['type' => 'integer', 'description' => 'Maximum activity timestamp.'],
    ];
}
