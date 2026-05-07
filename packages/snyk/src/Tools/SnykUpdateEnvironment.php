<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update Environment (Early Access).
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/cloud/environments/{environment_id}.
 */
class SnykUpdateEnvironment extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_environment';
    protected const DESCRIPTION = 'Update Environment (Early Access)

Official Snyk endpoint: PATCH /orgs/{org_id}/cloud/environments/{environment_id}

Update an environment #### Required permissions - `Update environments (org.cloud_environments.edit)`';
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
  'environment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `environment_id` from the official Snyk API operation. Unique identifier for an environment',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/cloud/environments/{environment_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'environment_id' => 'environment_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
