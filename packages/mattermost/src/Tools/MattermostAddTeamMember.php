<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Add a user to a Mattermost team.
 *
 * Creates a team membership.
 */
class MattermostAddTeamMember extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_add_team_member';
    protected const DESCRIPTION = 'Add a user to a Mattermost team.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'body' => ['type' => 'object', 'description' => 'Raw team member body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/teams/{team_id}/members';
    protected const REQUIRED = ['team_id', 'user_id'];
    protected const BODY_KEYS = ['team_id', 'user_id'];
    protected const BODY_REQUIRED = true;
}
