<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List team requests of a team.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams/{team_id}/team_requests.
 */
class GitGuardianListTeamRequests extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_team_requests';
    protected const DESCRIPTION = 'List pending requests of a team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/team_requests.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'member_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'member_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}/team_requests';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'member_id' => 'member_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
