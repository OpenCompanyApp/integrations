<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite messaging topics.
 */
class AppwriteListTopics extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_topics';
    protected string $toolDescription = 'List messaging topics in the current Appwrite project.';
    protected string $path = '/messaging/topics';
    protected array $queryParams = ['queries', 'search', 'total'];
    protected array $parameters = [
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for topics.'],
        'total' => ['type' => 'boolean', 'description' => 'Whether Appwrite should calculate total count.'],
    ];
}
