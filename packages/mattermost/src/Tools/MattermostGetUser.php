<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Get a Mattermost user.
 *
 * Retrieves one user by user ID.
 */
class MattermostGetUser extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_get_user';
    protected const DESCRIPTION = 'Get a Mattermost user by user_id.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/users/{user_id}';
    protected const REQUIRED = ['user_id'];
}
