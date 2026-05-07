<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * List team members.
 *
 * Retrieves users who belong to a Mattermost team.
 */
class MattermostListTeamMembers extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_list_team_members';
    protected const DESCRIPTION = 'List members of a Mattermost team.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Members per page.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}/members';
    protected const REQUIRED = ['team_id'];
    protected const QUERY_KEYS = ['page', 'per_page'];
}
