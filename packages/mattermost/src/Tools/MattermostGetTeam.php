<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Get a Mattermost team.
 *
 * Retrieves one team by team ID.
 */
class MattermostGetTeam extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_get_team';
    protected const DESCRIPTION = 'Get a Mattermost team by team_id.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}';
    protected const REQUIRED = ['team_id'];
}
