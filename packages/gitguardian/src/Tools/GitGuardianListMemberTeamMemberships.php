<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List team memberships of a member.
 *
 * Maps to the official GitGuardian endpoint GET /v1/members/{member_id}/team_memberships.
 */
class GitGuardianListMemberTeamMemberships extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_member_team_memberships';
    protected const DESCRIPTION = 'List team memberships of a workspace member. The response contains the list of team memberships and a pagination cursor to retrieve the next page. The team memberships are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `manager` except if the requested member is yourself.

Official GitGuardian endpoint: GET /v1/members/{member_id}/team_memberships.';
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
            'description' => 'The id of a team to filter on',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/members/{member_id}/team_memberships';
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
