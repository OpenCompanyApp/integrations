<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create an IP allowlist rule.
 *
 * Maps to the official GitGuardian endpoint POST /v1/ip-allowlist.
 */
class GitGuardianCreateIpAllowlist extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_ip_allowlist';
    protected const DESCRIPTION = 'This endpoint allows you to create an IP allowlist rule. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: POST /v1/ip-allowlist.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/ip-allowlist';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
