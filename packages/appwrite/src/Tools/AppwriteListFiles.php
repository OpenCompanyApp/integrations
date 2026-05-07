<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List files in an Appwrite storage bucket.
 */
class AppwriteListFiles extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_files';
    protected string $toolDescription = 'List files in a storage bucket.';
    protected string $path = '/storage/buckets/{bucket_id}/files';
    protected array $required = ['bucket_id'];
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Storage bucket ID.'],
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for files.'],
    ];
}
