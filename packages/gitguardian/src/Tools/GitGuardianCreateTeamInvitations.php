<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create a team invitation.
 *
 * Maps to the official GitGuardian endpoint POST /v1/teams/{team_id}/team_invitations.
 */
class GitGuardianCreateTeamInvitations extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_team_invitations';
    protected const DESCRIPTION = 'This endpoint allows you to create a team invitation from an existing team and invitation. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_invitations.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/teams/{team_id}/team_invitations';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
