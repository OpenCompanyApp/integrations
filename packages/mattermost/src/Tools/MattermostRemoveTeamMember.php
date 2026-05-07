<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Remove a user from a Mattermost team.
 *
 * Deletes a team membership.
 */
class MattermostRemoveTeamMember extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_remove_team_member';
    protected const DESCRIPTION = 'Remove a user from a Mattermost team.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/teams/{team_id}/members/{user_id}';
    protected const REQUIRED = ['team_id', 'user_id'];
}
