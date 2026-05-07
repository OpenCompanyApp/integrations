<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List members.
 *
 * Maps to the official GitGuardian endpoint GET /v1/members.
 */
class GitGuardianListMembers extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_members';
    protected const DESCRIPTION = 'List members of the workspace.

Official GitGuardian endpoint: GET /v1/members.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Page number.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'role' => [
            'type' => 'string',
            'required' => false,
            'description' => 'role',
        ],
        'access_level' => [
            'type' => 'string',
            'required' => false,
            'description' => 'access_level',
        ],
        'active' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'active',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['created_at', '-created_at', 'last_login', '-last_login'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/members';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'page' => 'page',
        'per_page' => 'per_page',
        'role' => 'role',
        'access_level' => 'access_level',
        'active' => 'active',
        'search' => 'search',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
