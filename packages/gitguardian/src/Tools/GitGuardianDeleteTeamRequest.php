<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Cancel or decline a team request.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/teams/{team_id}/team_requests/{team_request_id}.
 */
class GitGuardianDeleteTeamRequest extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_team_request';
    protected const DESCRIPTION = 'Cancel or decline a team request. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager, or be the member who created the request being cancelled.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/team_requests/{team_request_id}.';
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
            'description' => 'Whether to notify the member about the request having been denied.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/teams/{team_id}/team_requests/{team_request_id}';
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
