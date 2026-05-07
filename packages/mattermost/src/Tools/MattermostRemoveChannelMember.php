<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Remove a user from a Mattermost channel.
 *
 * Deletes a channel membership.
 */
class MattermostRemoveChannelMember extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_remove_channel_member';
    protected const DESCRIPTION = 'Remove a user from a Mattermost channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/channels/{channel_id}/members/{user_id}';
    protected const REQUIRED = ['channel_id', 'user_id'];
}
