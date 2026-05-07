<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Get a Mattermost user by username.
 *
 * Resolves usernames to user objects.
 */
class MattermostGetUserByUsername extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_get_user_by_username';
    protected const DESCRIPTION = 'Get a Mattermost user by username.';
    protected const PARAMETERS = [
        'username' => ['type' => 'string', 'required' => true, 'description' => 'Mattermost username.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/users/username/{username}';
    protected const REQUIRED = ['username'];
}
