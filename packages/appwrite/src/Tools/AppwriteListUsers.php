<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite users.
 */
class AppwriteListUsers extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_users';
    protected string $toolDescription = 'List users in the current Appwrite project.';
    protected string $path = '/users';
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for users.'],
    ];
}
