<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Request access to a team.
 *
 * Maps to the official GitGuardian endpoint POST /v1/teams/{team_id}/team_requests.
 */
class GitGuardianCreateTeamRequest extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_team_request';
    protected const DESCRIPTION = 'Create an access request to a team. You must be authenticated via a Personal Access Token. You must not already have a pending request on the team, be a member of the team, be a workspace manager or have the restricted access level.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_requests.';
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
    protected const PATH = '/v1/teams/{team_id}/team_requests';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
