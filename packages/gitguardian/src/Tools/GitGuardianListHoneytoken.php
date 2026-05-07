<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List honeytokens.
 *
 * Maps to the official GitGuardian endpoint GET /v1/honeytokens.
 */
class GitGuardianListHoneytoken extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_honeytoken';
    protected const DESCRIPTION = 'This endpoint allows you to list all the honeytokens of your workspace. The response contains the list of honeytokens and a pagination cursor to retrieve the next page. The honeytokens are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: GET /v1/honeytokens.';
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
            'enum' => ['triggered', 'active', 'revoked'],
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'type',
            'enum' => ['AWS'],
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'creator_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'creator_id',
        ],
        'revoker_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'revoker_id',
        ],
        'creator_api_token_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'creator_api_token_id',
        ],
        'revoker_api_token_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'revoker_api_token_id',
        ],
        'tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'tags',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['created_at', '-created_at', 'triggered_at', '-triggered_at', 'revoked_at', '-revoked_at', 'name', '-name'],
        ],
        'show_token' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'show_token',
        ],
        'x_privacy_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
            'enum' => ['true', 'false'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/honeytokens';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'status' => 'status',
        'type' => 'type',
        'search' => 'search',
        'creator_id' => 'creator_id',
        'revoker_id' => 'revoker_id',
        'creator_api_token_id' => 'creator_api_token_id',
        'revoker_api_token_id' => 'revoker_api_token_id',
        'tags' => 'tags',
        'ordering' => 'ordering',
        'show_token' => 'show_token',
    ];
    protected const HEADER_PARAMS = [
        'X-Privacy-Mode' => 'x_privacy_mode',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
