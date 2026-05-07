<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite collection.
 */
class AppwriteDeleteCollection extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_collection';
    protected string $toolDescription = 'Delete a collection from an Appwrite database.';
    protected string $method = 'DELETE';
    protected string $path = '/databases/{database_id}/collections/{collection_id}';
    protected array $required = ['database_id', 'collection_id'];
    protected array $parameters = [
        'database_id' => ['type' => 'string', 'required' => true, 'description' => 'Database ID.'],
        'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection ID.'],
    ];
}
