<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update organization.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}.
 */
class SnykUpdateOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org';
    protected const DESCRIPTION = 'Update organization

Official Snyk endpoint: PATCH /orgs/{org_id}

Update the details of an organization #### Required permissions - `Edit Organization (org.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}';
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
