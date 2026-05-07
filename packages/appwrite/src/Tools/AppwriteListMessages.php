<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite messaging messages.
 */
class AppwriteListMessages extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_messages';
    protected string $toolDescription = 'List messaging messages in the current Appwrite project.';
    protected string $path = '/messaging/messages';
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for messages.'],
    ];
}
