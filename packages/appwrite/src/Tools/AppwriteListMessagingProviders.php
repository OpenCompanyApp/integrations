<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite messaging providers.
 */
class AppwriteListMessagingProviders extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_messaging_providers';
    protected string $toolDescription = 'List messaging providers in the current Appwrite project.';
    protected string $path = '/messaging/providers';
    protected array $queryParams = ['queries', 'search', 'total'];
    protected array $parameters = [
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for providers.'],
        'total' => ['type' => 'boolean', 'description' => 'Whether Appwrite should calculate total count.'],
    ];
}
