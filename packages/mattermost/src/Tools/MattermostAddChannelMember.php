<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Add a user to a Mattermost channel.
 *
 * Creates a channel membership.
 */
class MattermostAddChannelMember extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_add_channel_member';
    protected const DESCRIPTION = 'Add a user to a Mattermost channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'post_root_id' => ['type' => 'string', 'description' => 'Optional root post ID for the join message.'],
        'body' => ['type' => 'object', 'description' => 'Raw channel member body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/channels/{channel_id}/members';
    protected const REQUIRED = ['channel_id', 'user_id'];
    protected const BODY_KEYS = ['user_id', 'post_root_id'];
    protected const BODY_REQUIRED = true;
}
