<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Patch a Mattermost user.
 *
 * Updates common profile fields for one user.
 */
class MattermostPatchUser extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_patch_user';
    protected const DESCRIPTION = 'Patch a Mattermost user. Provide changed fields or raw body.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'email' => ['type' => 'string', 'description' => 'Email address.'],
        'username' => ['type' => 'string', 'description' => 'Username.'],
        'first_name' => ['type' => 'string', 'description' => 'First name.'],
        'last_name' => ['type' => 'string', 'description' => 'Last name.'],
        'nickname' => ['type' => 'string', 'description' => 'Nickname.'],
        'position' => ['type' => 'string', 'description' => 'Position/title.'],
        'body' => ['type' => 'object', 'description' => 'Raw Mattermost user patch body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/users/{user_id}/patch';
    protected const REQUIRED = ['user_id'];
    protected const BODY_KEYS = ['email', 'username', 'first_name', 'last_name', 'nickname', 'position'];
    protected const BODY_REQUIRED = true;
}
