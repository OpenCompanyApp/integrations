<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Update an Appwrite collection.
 */
class AppwriteUpdateCollection extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_update_collection';
    protected string $toolDescription = 'Update collection metadata, permissions, or document security.';
    protected string $method = 'PUT';
    protected string $path = '/databases/{database_id}/collections/{collection_id}';
    protected array $required = ['database_id', 'collection_id', 'name'];
    protected array $bodyParams = ['name', 'permissions', 'document_security' => 'documentSecurity', 'enabled'];
    protected array $parameters = [
        'database_id' => ['type' => 'string', 'required' => true, 'description' => 'Database ID.'],
        'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Updated collection name.'],
        'permissions' => ['type' => 'array', 'description' => 'Collection permission strings.', 'items' => ['type' => 'string']],
        'document_security' => ['type' => 'boolean', 'description' => 'Enable document-level security.'],
        'enabled' => ['type' => 'boolean', 'description' => 'Whether the collection is enabled.'],
    ];
}
