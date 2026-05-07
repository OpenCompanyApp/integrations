<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite function executions.
 */
class AppwriteListExecutions extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_executions';
    protected string $toolDescription = 'List executions for an Appwrite function.';
    protected string $path = '/functions/{function_id}/executions';
    protected array $required = ['function_id'];
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'function_id' => ['type' => 'string', 'required' => true, 'description' => 'Function ID.'],
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for executions.'],
    ];
}
