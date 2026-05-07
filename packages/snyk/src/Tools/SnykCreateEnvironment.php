<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create New Environment (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/cloud/environments.
 */
class SnykCreateEnvironment extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_environment';
    protected const DESCRIPTION = 'Create New Environment (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/cloud/environments

Create a new environment and run a scan #### Required permissions - `Create environments (org.cloud_environments.create)`';
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
    protected const PATH = '/orgs/{org_id}/cloud/environments';
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
