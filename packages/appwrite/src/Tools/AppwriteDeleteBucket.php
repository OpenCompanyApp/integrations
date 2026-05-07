<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite storage bucket.
 */
class AppwriteDeleteBucket extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_bucket';
    protected string $toolDescription = 'Delete a storage bucket by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/storage/buckets/{bucket_id}';
    protected array $required = ['bucket_id'];
    protected array $parameters = [
        'bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Storage bucket ID.'],
    ];
}
