<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Retrieve Appwrite file metadata.
 */
class AppwriteGetFile extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_get_file';
    protected string $toolDescription = 'Get metadata for one file in a storage bucket.';
    protected string $path = '/storage/buckets/{bucket_id}/files/{file_id}';
    protected array $required = ['bucket_id', 'file_id'];
    protected array $parameters = [
        'bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Storage bucket ID.'],
        'file_id' => ['type' => 'string', 'required' => true, 'description' => 'File ID.'],
    ];
}
