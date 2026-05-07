<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite storage buckets.
 */
class AppwriteListBuckets extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_buckets';
    protected string $toolDescription = 'List storage buckets in the current Appwrite project.';
    protected string $path = '/storage/buckets';
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for buckets.'],
    ];
}
