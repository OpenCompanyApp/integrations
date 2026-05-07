<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Scan content and create incidents.
 *
 * Maps to the official GitGuardian endpoint POST /v1/scan/create-incidents.
 */
class GitGuardianScanCreateIncidents extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scan_create_incidents';
    protected const DESCRIPTION = 'Scan content and create incidents

Official GitGuardian endpoint: POST /v1/scan/create-incidents.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/scan/create-incidents';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
