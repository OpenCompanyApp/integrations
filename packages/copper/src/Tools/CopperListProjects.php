<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Search Copper projects.
 */
class CopperListProjects extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_projects';

    protected string $toolDescription = 'Search and list Copper projects.';

    protected string $method = 'POST';

    protected string $path = '/projects/search';

    /** @var list<string> */
    protected array $bodyParams = ['page_size', 'page_number', 'sort_by', 'name', 'status_ids', 'assignee_ids', 'company_ids', 'opportunity_ids', 'tags', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'page_size' => ['type' => 'integer', 'description' => 'Number of projects per page, up to 200.'],
        'page_number' => ['type' => 'integer', 'description' => 'Page number to fetch.'],
        'sort_by' => ['type' => 'string', 'description' => 'Copper sort field.'],
        'name' => ['type' => 'string', 'description' => 'Filter by project name.'],
        'status_ids' => ['type' => 'array', 'description' => 'Project status IDs.'],
        'assignee_ids' => ['type' => 'array', 'description' => 'Assignee user IDs.'],
        'company_ids' => ['type' => 'array', 'description' => 'Related company IDs.'],
        'opportunity_ids' => ['type' => 'array', 'description' => 'Related opportunity IDs.'],
        'tags' => ['type' => 'array', 'description' => 'Tags filter.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field filters.'],
    ];
}
