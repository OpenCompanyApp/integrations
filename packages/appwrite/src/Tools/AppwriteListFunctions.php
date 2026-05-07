<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite functions.
 */
class AppwriteListFunctions extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_functions';
    protected string $toolDescription = 'List functions in the current Appwrite project.';
    protected string $path = '/functions';
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for functions.'],
    ];
}
