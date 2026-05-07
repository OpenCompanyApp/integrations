<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List teams of a member.
 *
 * Maps to the official GitGuardian endpoint GET /v1/members/{member_id}/teams.
 */
class GitGuardianListMemberTeams extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_member_teams';
    protected const DESCRIPTION = 'List teams of a workspace member. The response contains the list of teams and a pagination cursor to retrieve the next page. The teams are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `manager` except if the requested member is yourself.

Official GitGuardian endpoint: GET /v1/members/{member_id}/teams.';
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
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'is_global' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'is_global',
        ],
        'member_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the workspace member',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/members/{member_id}/teams';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'search' => 'search',
        'is_global' => 'is_global',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
