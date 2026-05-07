<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create custom source.
 *
 * Maps to the official GitGuardian endpoint POST /v1/sources/custom-sources.
 */
class GitGuardianCreateCustomSource extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_custom_source';
    protected const DESCRIPTION = 'Create a new custom source for the authenticated account. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: POST /v1/sources/custom-sources.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/sources/custom-sources';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
