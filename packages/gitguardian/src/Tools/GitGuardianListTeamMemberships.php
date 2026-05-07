<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List team memberships.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams/{team_id}/team_memberships.
 */
class GitGuardianListTeamMemberships extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_team_memberships';
    protected const DESCRIPTION = 'List all the memberships of a team. If you are using a personal access token, you need to be a workspace manager or be part of the team.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/team_memberships.';
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
        'is_team_leader' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'is_team_leader',
        ],
        'team_permission' => [
            'type' => 'string',
            'required' => false,
            'description' => 'team_permission',
        ],
        'incident_permission' => [
            'type' => 'string',
            'required' => false,
            'description' => 'incident_permission',
        ],
        'member_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'member_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}/team_memberships';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'is_team_leader' => 'is_team_leader',
        'team_permission' => 'team_permission',
        'incident_permission' => 'incident_permission',
        'member_id' => 'member_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
