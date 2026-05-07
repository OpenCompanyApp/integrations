<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite document.
 */
class AppwriteDeleteDocument extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_document';
    protected string $toolDescription = 'Delete a document by database, collection, and document ID.';
    protected string $method = 'DELETE';
    protected string $path = '/databases/{database_id}/collections/{collection_id}/documents/{document_id}';
    protected array $required = ['database_id', 'collection_id', 'document_id'];
    protected array $parameters = [
        'database_id' => ['type' => 'string', 'required' => true, 'description' => 'Database ID.'],
        'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'Collection ID.'],
        'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
    ];
}
