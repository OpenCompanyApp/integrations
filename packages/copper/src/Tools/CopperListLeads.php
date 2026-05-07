<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Search Copper leads.
 */
class CopperListLeads extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_leads';

    protected string $toolDescription = 'Search and list Copper leads.';

    protected string $method = 'POST';

    protected string $path = '/leads/search';

    /** @var list<string> */
    protected array $bodyParams = ['page_size', 'page_number', 'sort_by', 'name', 'company_name', 'email', 'phone_number', 'status_ids', 'assignee_ids', 'tags', 'custom_fields'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'page_size' => ['type' => 'integer', 'description' => 'Number of leads per page, up to 200.'],
        'page_number' => ['type' => 'integer', 'description' => 'Page number to fetch.'],
        'sort_by' => ['type' => 'string', 'description' => 'Copper sort field.'],
        'name' => ['type' => 'string', 'description' => 'Filter by lead name.'],
        'company_name' => ['type' => 'string', 'description' => 'Filter by company name.'],
        'email' => ['type' => 'string', 'description' => 'Filter by email.'],
        'phone_number' => ['type' => 'string', 'description' => 'Filter by phone number.'],
        'status_ids' => ['type' => 'array', 'description' => 'Lead status IDs.'],
        'assignee_ids' => ['type' => 'array', 'description' => 'Assignee user IDs.'],
        'tags' => ['type' => 'array', 'description' => 'Tags filter.'],
        'custom_fields' => ['type' => 'array', 'description' => 'Custom field filters.'],
    ];
}
