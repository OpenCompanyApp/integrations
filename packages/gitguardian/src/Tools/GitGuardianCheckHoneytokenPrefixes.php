<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Bulk prefix lookup for honeytoken HMSL hashes.
 *
 * Maps to the official GitGuardian endpoint POST /v1/honeytokens/prefixes.
 */
class GitGuardianCheckHoneytokenPrefixes extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_check_honeytoken_prefixes';
    protected const DESCRIPTION = 'Bulk prefix lookup for honeytoken HMSL hashes

Official GitGuardian endpoint: POST /v1/honeytokens/prefixes.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/honeytokens/prefixes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
