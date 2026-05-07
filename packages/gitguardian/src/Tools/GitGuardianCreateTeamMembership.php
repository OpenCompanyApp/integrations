<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Add a member to a team.
 *
 * Maps to the official GitGuardian endpoint POST /v1/teams/{team_id}/team_memberships.
 */
class GitGuardianCreateTeamMembership extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_team_membership';
    protected const DESCRIPTION = 'Add a member to a team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_memberships.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to notify the member about the team membership.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/teams/{team_id}/team_memberships';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
