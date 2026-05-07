<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get scan (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/cloud/scans/{scan_id}.
 */
class SnykGetScan extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_scan';
    protected const DESCRIPTION = 'Get scan (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/cloud/scans/{scan_id}

Get a single scan for an organization #### Required permissions - `View scans (org.cloud_scans.read)`';
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
  'scan_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scan_id` from the official Snyk API operation. Scan ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/cloud/scans/{scan_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'scan_id' => 'scan_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
