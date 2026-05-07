<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Revoke an API token..
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/api_tokens/{token_id}.
 */
class GitGuardianDeleteApiToken extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_api_token';
    protected const DESCRIPTION = 'Revoke an API token.

Official GitGuardian endpoint: DELETE /v1/api_tokens/{token_id}.';
    protected const PARAMETERS = [
        'token_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Id of the token.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/api_tokens/{token_id}';
    protected const PATH_PARAMS = [
        'token_id' => 'token_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
