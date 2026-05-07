<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create Scan (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/cloud/scans.
 */
class SnykCreateScan extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_scan';
    protected const DESCRIPTION = 'Create Scan (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/cloud/scans

Create and trigger a new scan for an environment #### Required permissions - `Create scans (org.cloud_scans.create)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Organization ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/cloud/scans';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
