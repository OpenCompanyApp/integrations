<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Retrieve one Appwrite storage bucket.
 */
class AppwriteGetBucket extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_get_bucket';
    protected string $toolDescription = 'Get one storage bucket by ID.';
    protected string $path = '/storage/buckets/{bucket_id}';
    protected array $required = ['bucket_id'];
    protected array $parameters = [
        'bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Storage bucket ID.'],
    ];
}
