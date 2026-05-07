<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Retrieve an Appwrite collection.
 */
class AppwriteGetCollection extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_get_collection';
    protected string $toolDescription = 'Get metadata for one Appwrite collection.';
    protected string $path = '/databases/{database_id}/collections/{collection_id}';
    protected array $required = ['database_id', 'collection_id'];
    protected array $parameters = [
        'database_id' => ['type' => 'string', 'required' => true, 'description' => 'Database ID.'],
        'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection ID.'],
    ];
}
