<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a team membership.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/teams/{team_id}/team_memberships/{team_membership_id}.
 */
class GitGuardianUpdateTeamMembership extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_team_membership';
    protected const DESCRIPTION = 'Update permissions of a team membership. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: PATCH /v1/teams/{team_id}/team_memberships/{team_membership_id}.';
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
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/teams/{team_id}/team_memberships/{team_membership_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
        'team_membership_id' => 'team_membership_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
