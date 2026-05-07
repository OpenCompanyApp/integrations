<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List API tokens..
 *
 * Maps to the official GitGuardian endpoint GET /v1/api_tokens.
 */
class GitGuardianListApiTokens extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_api_tokens';
    protected const DESCRIPTION = 'List all the tokens in the workspace, some filters are available and described below.

Official GitGuardian endpoint: GET /v1/api_tokens.';
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
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'status',
        ],
        'member_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter by member id.',
        ],
        'creator_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter by creator id.',
        ],
        'scopes' => [
            'type' => 'string',
            'required' => false,
            'description' => 'scopes',
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
            'enum' => ['created_at', '-created_at', 'last_used_at', '-last_used_at', 'expire_at', '-expire_at', 'revoked_at', '-revoked_at'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/api_tokens';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'status' => 'status',
        'member_id' => 'member_id',
        'creator_id' => 'creator_id',
        'scopes' => 'scopes',
        'search' => 'search',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
