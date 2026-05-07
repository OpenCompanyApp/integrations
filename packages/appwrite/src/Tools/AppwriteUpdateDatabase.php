<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Update an Appwrite database.
 */
class AppwriteUpdateDatabase extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_update_database';
    protected string $toolDescription = 'Update an Appwrite database name or enabled state.';
    protected string $method = 'PUT';
    protected string $path = '/databases/{database_id}';
    protected array $required = ['database_id', 'name'];
    protected array $bodyParams = ['name', 'enabled'];
    protected array $parameters = [
        'database_id' => ['type' => 'string', 'required' => true, 'description' => 'Database ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Updated database name.'],
        'enabled' => ['type' => 'boolean', 'description' => 'Whether the database is enabled.'],
    ];
}
