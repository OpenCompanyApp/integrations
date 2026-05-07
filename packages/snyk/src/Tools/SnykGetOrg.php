<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get organization.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}.
 */
class SnykGetOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_org';
    protected const DESCRIPTION = 'Get organization

Official Snyk endpoint: GET /orgs/{org_id}

Get the full details of an organization. #### Required permissions - `View Organization (org.read)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Unique identifier for org',
  ),
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand` from the official Snyk API operation. Expand the specified related resources in the response to include their attributes.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'expand' => 'expand',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
