<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Delete a Mattermost channel.
 *
 * Soft-deletes a channel by ID.
 */
class MattermostDeleteChannel extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_delete_channel';
    protected const DESCRIPTION = 'Delete a Mattermost channel by channel_id.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/channels/{channel_id}';
    protected const REQUIRED = ['channel_id'];
}
