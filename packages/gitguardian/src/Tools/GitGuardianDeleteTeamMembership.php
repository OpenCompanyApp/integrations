<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Remove a member from a team.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/teams/{team_id}/team_memberships/{team_membership_id}.
 */
class GitGuardianDeleteTeamMembership extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_team_membership';
    protected const DESCRIPTION = 'Remove a member from a team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager, or be the member being removed.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/team_memberships/{team_membership_id}.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'team_membership_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team membership',
        ],
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to notify the member about the removal from the team.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/teams/{team_id}/team_memberships/{team_membership_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
        'team_membership_id' => 'team_membership_id',
    ];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
