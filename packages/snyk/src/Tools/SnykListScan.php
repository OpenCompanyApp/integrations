<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List Scans (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/cloud/scans.
 */
class SnykListScan extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_scan';
    protected const DESCRIPTION = 'List Scans (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/cloud/scans

List scans for an organization #### Required permissions - `View scans (org.cloud_scans.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Organization ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/cloud/scans';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
