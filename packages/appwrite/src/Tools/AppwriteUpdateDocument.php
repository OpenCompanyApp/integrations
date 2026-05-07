<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Update an Appwrite document.
 */
class AppwriteUpdateDocument extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_update_document';
    protected string $toolDescription = 'Update a document data payload and optional permissions.';
    protected string $method = 'PATCH';
    protected string $path = '/databases/{database_id}/collections/{collection_id}/documents/{document_id}';
    protected array $required = ['database_id', 'collection_id', 'document_id', 'data'];
    protected array $bodyParams = ['data', 'permissions'];
    protected array $parameters = [
        'database_id' => ['type' => 'string', 'required' => true, 'description' => 'Database ID.'],
        'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection ID.'],
        'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Document data fields to update.'],
        'permissions' => ['type' => 'array', 'description' => 'Document permission strings.', 'items' => ['type' => 'string']],
    ];
}
