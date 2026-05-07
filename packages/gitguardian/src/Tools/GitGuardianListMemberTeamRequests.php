<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List team requests of a member.
 *
 * Maps to the official GitGuardian endpoint GET /v1/members/{member_id}/team_requests.
 */
class GitGuardianListMemberTeamRequests extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_member_team_requests';
    protected const DESCRIPTION = 'List pending team requests of a member. If you are using a personal access token, you need to be either a workspace manager or the member being queried.

Official GitGuardian endpoint: GET /v1/members/{member_id}/team_requests.';
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
        'member_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the workspace member',
        ],
        'team_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'team_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/members/{member_id}/team_requests';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'team_id' => 'team_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
