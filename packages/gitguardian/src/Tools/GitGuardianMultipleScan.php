<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Multiple content scan.
 *
 * Maps to the official GitGuardian endpoint POST /v1/multiscan.
 */
class GitGuardianMultipleScan extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_multiple_scan';
    protected const DESCRIPTION = 'Multiple content scan

Official GitGuardian endpoint: POST /v1/multiscan.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/multiscan';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
