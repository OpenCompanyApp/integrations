<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a list of Snyk Apps installed for an Organization.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/apps/installs.
 */
class SnykGetAppInstallsForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_app_installs_for_org';
    protected const DESCRIPTION = 'Get a list of Snyk Apps installed for an Organization

Official Snyk endpoint: GET /orgs/{org_id}/apps/installs

Get a list of Snyk Apps installed for an Organization #### Required permissions - `View Apps (org.app.read)`';
    protected const PARAMETERS = array (
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand` from the official Snyk API operation. Expand relationships.',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Organization ID',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/apps/installs';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'expand' => 'expand',
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
