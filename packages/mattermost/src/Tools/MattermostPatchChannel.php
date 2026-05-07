<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Patch a Mattermost channel.
 *
 * Updates common channel profile fields.
 */
class MattermostPatchChannel extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_patch_channel';
    protected const DESCRIPTION = 'Patch a Mattermost channel. Provide changed fields or raw body.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'name' => ['type' => 'string', 'description' => 'Channel name.'],
        'display_name' => ['type' => 'string', 'description' => 'Channel display name.'],
        'header' => ['type' => 'string', 'description' => 'Channel header.'],
        'purpose' => ['type' => 'string', 'description' => 'Channel purpose.'],
        'body' => ['type' => 'object', 'description' => 'Raw Mattermost channel patch body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/channels/{channel_id}/patch';
    protected const REQUIRED = ['channel_id'];
    protected const BODY_KEYS = ['name', 'display_name', 'header', 'purpose'];
    protected const BODY_REQUIRED = true;
}
