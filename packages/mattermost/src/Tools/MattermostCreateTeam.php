<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Create a Mattermost team.
 *
 * Creates a team with common fields or a raw Mattermost create body.
 */
class MattermostCreateTeam extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_create_team';
    protected const DESCRIPTION = 'Create a Mattermost team. Provide name, display_name, type, and optional description or raw body.';
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Team name.'],
        'display_name' => ['type' => 'string', 'required' => true, 'description' => 'Team display name.'],
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Team type, usually O or I.'],
        'description' => ['type' => 'string', 'description' => 'Team description.'],
        'body' => ['type' => 'object', 'description' => 'Raw Mattermost team create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/teams';
    protected const REQUIRED = ['name', 'display_name', 'type'];
    protected const BODY_KEYS = ['name', 'display_name', 'type', 'description'];
    protected const BODY_REQUIRED = true;
}
