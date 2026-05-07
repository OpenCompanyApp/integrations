<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * List channel members.
 *
 * Retrieves members of a Mattermost channel.
 */
class MattermostListChannelMembers extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_list_channel_members';
    protected const DESCRIPTION = 'List members of a Mattermost channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Members per page.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/channels/{channel_id}/members';
    protected const REQUIRED = ['channel_id'];
    protected const QUERY_KEYS = ['page', 'per_page'];
}
