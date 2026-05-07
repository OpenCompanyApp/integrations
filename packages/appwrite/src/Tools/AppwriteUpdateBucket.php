<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Update an Appwrite storage bucket.
 */
class AppwriteUpdateBucket extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_update_bucket';
    protected string $toolDescription = 'Update storage bucket metadata, permissions, and file constraints.';
    protected string $method = 'PUT';
    protected string $path = '/storage/buckets/{bucket_id}';
    protected array $required = ['bucket_id', 'name'];
    protected array $bodyParams = ['name', 'permissions', 'file_security' => 'fileSecurity', 'enabled', 'maximum_file_size' => 'maximumFileSize', 'allowed_file_extensions' => 'allowedFileExtensions', 'compression', 'encryption', 'antivirus'];
    protected array $parameters = [
        'bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Storage bucket ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Updated bucket name.'],
        'permissions' => ['type' => 'array', 'description' => 'Bucket permission strings.', 'items' => ['type' => 'string']],
        'file_security' => ['type' => 'boolean', 'description' => 'Enable file-level security.'],
        'enabled' => ['type' => 'boolean', 'description' => 'Whether the bucket is enabled.'],
        'maximum_file_size' => ['type' => 'integer', 'description' => 'Maximum file size in bytes.'],
        'allowed_file_extensions' => ['type' => 'array', 'description' => 'Allowed file extensions without dots.', 'items' => ['type' => 'string']],
        'compression' => ['type' => 'string', 'description' => 'Compression mode such as none, gzip, or zstd.'],
        'encryption' => ['type' => 'boolean', 'description' => 'Whether files are encrypted.'],
        'antivirus' => ['type' => 'boolean', 'description' => 'Whether antivirus scanning is enabled.'],
    ];
}
