<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create a honeytoken within a context.
 *
 * Maps to the official GitGuardian endpoint POST /v1/honeytokens/with-context.
 */
class GitGuardianCreateHoneytokenWithContext extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_honeytoken_with_context';
    protected const DESCRIPTION = 'This endpoint allows you to create a honeytoken of a given type within a context. The context is a realistic file in which your honeytoken is inserted. If `language`, `project_extensions` and `filename` are not provided, a random context will be generated.

Official GitGuardian endpoint: POST /v1/honeytokens/with-context.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/honeytokens/with-context';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
