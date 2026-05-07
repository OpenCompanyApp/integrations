<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete an integration (Early Access).
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/integrations/{integration_id}.
 */
class SnykDeleteIntegration extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_integration';
    protected const DESCRIPTION = 'Delete an integration (Early Access)

Official Snyk endpoint: DELETE /orgs/{org_id}/integrations/{integration_id}

Permanently delete a container registry integration from an organization. Brokered integrations must have broker mode disabled via the V1 API first. NOTE: This endpoint performs a hard delete of the integration. The integration will be permanently removed from the database and all associated targets and projects will be orphaned and need to be manually removed. #### Required permissions - `Edit integrations (org.integration.edit)`';
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
    protected const METHOD = 'delete';
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
