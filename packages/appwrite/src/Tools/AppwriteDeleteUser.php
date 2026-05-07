<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite user.
 */
class AppwriteDeleteUser extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_user';
    protected string $toolDescription = 'Delete a user from the current Appwrite project.';
    protected string $method = 'DELETE';
    protected string $path = '/users/{user_id}';
    protected array $required = ['user_id'];
    protected array $parameters = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
}
