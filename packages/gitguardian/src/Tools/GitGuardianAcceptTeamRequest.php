<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Accept a team request.
 *
 * Maps to the official GitGuardian endpoint POST /v1/teams/{team_id}/team_requests/{team_request_id}/accept.
 */
class GitGuardianAcceptTeamRequest extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_accept_team_request';
    protected const DESCRIPTION = 'Accept a team request by adding the member to the team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_requests/{team_request_id}/accept.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'team_request_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team request',
        ],
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to notify the member about the request having been accepted.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/teams/{team_id}/team_requests/{team_request_id}/accept';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
        'team_request_id' => 'team_request_id',
    ];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
