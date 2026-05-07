<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create an integration for an organization (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/integrations.
 */
class SnykCreateIntegration extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_integration';
    protected const DESCRIPTION = 'Create an integration for an organization (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/integrations

Create a new integration with specified credentials and profile name #### Required permissions - `Edit integrations (org.integration.edit)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The organization public ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/integrations';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
