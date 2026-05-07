<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Get scan details.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentId}/scan/{scanId}.
 */
class SemgrepScansServiceGetScan extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_scans_service_get_scan';
    protected const DESCRIPTION = 'Get scan details

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/scan/{scanId}

Request the details of a scan including the associated deployment, repository, and commit information.';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
  'scan_id' =>
  array (
    'type' => 'string',
    'description' => 'scanId parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments/{deploymentId}/scan/{scanId}';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
  'scanId' => 'scan_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
