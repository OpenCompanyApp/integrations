<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Deactivate or activate a Mattermost user.
 *
 * Sets a user's active flag using the Mattermost active endpoint.
 */
class MattermostDeactivateUser extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_deactivate_user';
    protected const DESCRIPTION = 'Set a Mattermost user active flag. Use active=false to deactivate or true to reactivate.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'active' => ['type' => 'boolean', 'required' => true, 'description' => 'Whether the user should be active.'],
        'body' => ['type' => 'object', 'description' => 'Raw active body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/users/{user_id}/active';
    protected const REQUIRED = ['user_id', 'active'];
    protected const BODY_KEYS = ['active'];
    protected const BODY_REQUIRED = true;
}
