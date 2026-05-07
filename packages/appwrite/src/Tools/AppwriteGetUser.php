<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Retrieve one Appwrite user.
 */
class AppwriteGetUser extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_get_user';
    protected string $toolDescription = 'Get one Appwrite user by ID.';
    protected string $path = '/users/{user_id}';
    protected array $required = ['user_id'];
    protected array $parameters = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
}
