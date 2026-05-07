<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a secret value.
 *
 * Maps to the official GitGuardian endpoint GET /v1/secrets/{secret_id}.
 */
class GitGuardianGetSecretDetail extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_secret_detail';
    protected const DESCRIPTION = 'Retrieve the information, including its clear text value, of a secret by its ID. **Prerequisites**: - This endpoint must be enabled in the workspace settings under Security by a workspace admin. - A valid API key with the secrets:read scope. This scope is available only for Personal Access Tokens (PATs).

Official GitGuardian endpoint: GET /v1/secrets/{secret_id}.';
    protected const PARAMETERS = [
        'secret_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The ID of the secret to retrieve',
        ],
        'x_privacy_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
            'enum' => ['true', 'false'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/secrets/{secret_id}';
    protected const PATH_PARAMS = [
        'secret_id' => 'secret_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'X-Privacy-Mode' => 'x_privacy_mode',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
