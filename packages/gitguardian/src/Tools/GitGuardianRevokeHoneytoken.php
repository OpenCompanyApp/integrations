<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Revoke the honeytoken.
 *
 * Maps to the official GitGuardian endpoint POST /v1/honeytokens/{honeytoken_id}/revoke.
 */
class GitGuardianRevokeHoneytoken extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_revoke_honeytoken';
    protected const DESCRIPTION = 'Revokes an active or triggered honeytoken. All the associated events will be closed.

Official GitGuardian endpoint: POST /v1/honeytokens/{honeytoken_id}/revoke.';
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
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/honeytokens/{honeytoken_id}/revoke';
    protected const PATH_PARAMS = [
        'honeytoken_id' => 'honeytoken_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'X-Privacy-Mode' => 'x_privacy_mode',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
