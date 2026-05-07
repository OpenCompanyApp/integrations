<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Create a Mattermost channel.
 *
 * Creates a public or private channel in a team.
 */
class MattermostCreateChannel extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_create_channel';
    protected const DESCRIPTION = 'Create a Mattermost channel. Provide team_id, name, display_name, type, and optional header/purpose.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Channel name.'],
        'display_name' => ['type' => 'string', 'required' => true, 'description' => 'Channel display name.'],
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Channel type, usually O or P.'],
        'header' => ['type' => 'string', 'description' => 'Channel header.'],
        'purpose' => ['type' => 'string', 'description' => 'Channel purpose.'],
        'body' => ['type' => 'object', 'description' => 'Raw Mattermost channel create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/channels';
    protected const REQUIRED = ['team_id', 'name', 'display_name', 'type'];
    protected const BODY_KEYS = ['team_id', 'name', 'display_name', 'type', 'header', 'purpose'];
    protected const BODY_REQUIRED = true;
}
