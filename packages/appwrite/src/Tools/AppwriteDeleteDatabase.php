<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite database.
 */
class AppwriteDeleteDatabase extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_database';
    protected string $toolDescription = 'Delete an Appwrite database by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/databases/{database_id}';
    protected array $required = ['database_id'];
    protected array $parameters = [
        'database_id' => ['type' => 'string', 'required' => true, 'description' => 'Database ID.'],
    ];
}
