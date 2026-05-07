<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Search Copper users.
 */
class CopperListUsers extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_users';

    protected string $toolDescription = 'Search and list Copper users.';

    protected string $method = 'POST';

    protected string $path = '/users/search';

    /** @var list<string> */
    protected array $bodyParams = ['page_size', 'page_number', 'sort_by', 'name', 'email'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'page_size' => ['type' => 'integer', 'description' => 'Number of users per page, up to 200.'],
        'page_number' => ['type' => 'integer', 'description' => 'Page number to fetch.'],
        'sort_by' => ['type' => 'string', 'description' => 'Copper sort field.'],
        'name' => ['type' => 'string', 'description' => 'Filter by user name.'],
        'email' => ['type' => 'string', 'description' => 'Filter by user email.'],
    ];
}
