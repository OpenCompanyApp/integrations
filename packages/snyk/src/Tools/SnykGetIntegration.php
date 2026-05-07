<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a specific integration (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/integrations/{integration_id}.
 */
class SnykGetIntegration extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_integration';
    protected const DESCRIPTION = 'Get a specific integration (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/integrations/{integration_id}

Retrieve details for a single integration by its ID #### Required permissions - `View integrations (org.integration.read)`';
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
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integration_id` from the official Snyk API operation. The unique identifier for the integration',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/integrations/{integration_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'integration_id' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
