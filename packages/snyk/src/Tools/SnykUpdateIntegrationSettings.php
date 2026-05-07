<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update integration settings (Early Access).
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/integrations/{integration_id}/settings.
 */
class SnykUpdateIntegrationSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_integration_settings';
    protected const DESCRIPTION = 'Update integration settings (Early Access)

Official Snyk endpoint: PATCH /orgs/{org_id}/integrations/{integration_id}/settings

Update the settings for a specific integration. Supports partial updates. **Updateable fields:** - `container_app_scan_enabled`: Enable or disable container application scanning (only applicable to container registry integrations) #### Required permissions - `Edit integrations (org.integration.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/integrations/{integration_id}/settings';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'integration_id' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
