<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite storage file.
 */
class AppwriteDeleteFile extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_file';
    protected string $toolDescription = 'Delete a file from a storage bucket.';
    protected string $method = 'DELETE';
    protected string $path = '/storage/buckets/{bucket_id}/files/{file_id}';
    protected array $required = ['bucket_id', 'file_id'];
    protected array $parameters = [
        'bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Storage bucket ID.'],
        'file_id' => ['type' => 'string', 'required' => true, 'description' => 'File ID.'],
    ];
}
