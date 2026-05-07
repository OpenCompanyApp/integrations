<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Update an Appwrite user status.
 */
class AppwriteUpdateUserStatus extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_update_user_status';
    protected string $toolDescription = 'Enable or disable an Appwrite user account.';
    protected string $method = 'PATCH';
    protected string $path = '/users/{user_id}/status';
    protected array $required = ['user_id', 'status'];
    protected array $bodyParams = ['status'];
    protected array $parameters = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'status' => ['type' => 'boolean', 'required' => true, 'description' => 'True to enable the user, false to block the user.'],
    ];
}
