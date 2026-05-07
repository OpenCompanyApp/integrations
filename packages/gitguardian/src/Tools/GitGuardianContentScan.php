<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Content scan.
 *
 * Maps to the official GitGuardian endpoint POST /v1/scan.
 */
class GitGuardianContentScan extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_content_scan';
    protected const DESCRIPTION = 'Scan provided document content for policy breaks. Request body shouldn\'t exceed 1MB. This endpoint is stateless and as such will not store in our servers neither the documents nor the secrets found.

Official GitGuardian endpoint: POST /v1/scan.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/scan';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
