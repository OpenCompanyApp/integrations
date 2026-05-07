<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get integration settings (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/integrations/{integration_id}/settings.
 */
class SnykGetIntegrationSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_integration_settings';
    protected const DESCRIPTION = 'Get integration settings (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/integrations/{integration_id}/settings

Get the settings for a specific integration. #### Required permissions - `View integrations (org.integration.read)`';
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
    protected const PATH = '/orgs/{org_id}/integrations/{integration_id}/settings';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'integration_id' => 'integration_id',
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
