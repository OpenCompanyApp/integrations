<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create a JSON Web Token..
 *
 * Maps to the official GitGuardian endpoint POST /v1/auth/jwt.
 */
class GitGuardianPublicJwtCreate extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_public_jwt_create';
    protected const DESCRIPTION = 'Create a short lived JWT for authentication to specific GitGuardian services, including HasMySecretLeaked.

Official GitGuardian endpoint: POST /v1/auth/jwt.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/auth/jwt';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
