<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a honeytoken.
 *
 * Maps to the official GitGuardian endpoint GET /v1/honeytokens/{honeytoken_id}.
 */
class GitGuardianRetrieveHoneytoken extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_honeytoken';
    protected const DESCRIPTION = 'Retrieve an existing honeytoken. If you are using a personal access token, you need to have an access level greater or equal to `manager`.

Official GitGuardian endpoint: GET /v1/honeytokens/{honeytoken_id}.';
    protected const PARAMETERS = [
        'honeytoken_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the honeytoken to retrieve',
        ],
        'x_privacy_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
            'enum' => ['true', 'false'],
        ],
        'show_token' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'show_token',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/honeytokens/{honeytoken_id}';
    protected const PATH_PARAMS = [
        'honeytoken_id' => 'honeytoken_id',
    ];
    protected const QUERY_PARAMS = [
        'show_token' => 'show_token',
    ];
    protected const HEADER_PARAMS = [
        'X-Privacy-Mode' => 'x_privacy_mode',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
