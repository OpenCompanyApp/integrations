<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List teams.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams.
 */
class GitGuardianListTeams extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_teams';
    protected const DESCRIPTION = 'This endpoint allows you to list all the teams of your workspace. The response contains the list of teams and a pagination cursor to retrieve the next page. The teams are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: GET /v1/teams.';
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
        'is_global' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'is_global',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'linked_to_an_external_provider' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'linked_to_an_external_provider',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'is_global' => 'is_global',
        'search' => 'search',
        'linked_to_an_external_provider' => 'linked_to_an_external_provider',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
