<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List scans (beta).
 *
 * Maps to the official Semgrep Web API endpoint post /api/v1/deployments/{deploymentId}/scans/search.
 */
class SemgrepScansServiceSearchScans extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_scans_service_search_scans';
    protected const DESCRIPTION = 'List scans (beta)

Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/scans/search

List the scans associated with a particular repository over the past 30 days.';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Semgrep Web API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/deployments/{deploymentId}/scans/search';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
