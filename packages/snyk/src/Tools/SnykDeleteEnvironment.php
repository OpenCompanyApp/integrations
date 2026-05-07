<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete Environment (Early Access).
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/cloud/environments/{environment_id}.
 */
class SnykDeleteEnvironment extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_environment';
    protected const DESCRIPTION = 'Delete Environment (Early Access)

Official Snyk endpoint: DELETE /orgs/{org_id}/cloud/environments/{environment_id}

Delete an environment #### Required permissions - `Delete environments (org.cloud_environments.delete)`';
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
);
    protected const METHOD = 'delete';
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
