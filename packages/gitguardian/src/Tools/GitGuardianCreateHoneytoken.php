<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create a honeytoken.
 *
 * Maps to the official GitGuardian endpoint POST /v1/honeytokens.
 */
class GitGuardianCreateHoneytoken extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_honeytoken';
    protected const DESCRIPTION = 'This endpoint allows you to create a honeytoken of a type. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: POST /v1/honeytokens.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/honeytokens';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
