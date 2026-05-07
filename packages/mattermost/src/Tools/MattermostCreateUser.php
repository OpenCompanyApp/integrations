<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Create a Mattermost user.
 *
 * Sends the Mattermost user create body with first-class common fields.
 */
class MattermostCreateUser extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_create_user';
    protected const DESCRIPTION = 'Create a Mattermost user. Provide email, username, password, and optional profile fields or raw body.';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address.'],
        'username' => ['type' => 'string', 'required' => true, 'description' => 'Username.'],
        'password' => ['type' => 'string', 'required' => true, 'description' => 'Password.'],
        'first_name' => ['type' => 'string', 'description' => 'First name.'],
        'last_name' => ['type' => 'string', 'description' => 'Last name.'],
        'nickname' => ['type' => 'string', 'description' => 'Nickname.'],
        'body' => ['type' => 'object', 'description' => 'Raw Mattermost user create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/users';
    protected const REQUIRED = ['email', 'username', 'password'];
    protected const BODY_KEYS = ['email', 'username', 'password', 'first_name', 'last_name', 'nickname'];
    protected const BODY_REQUIRED = true;
}
