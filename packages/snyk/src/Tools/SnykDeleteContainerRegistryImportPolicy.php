<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a container registry import policy.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/container_import/{integration_id}/policy.
 */
class SnykDeleteContainerRegistryImportPolicy extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_container_registry_import_policy';
    protected const DESCRIPTION = 'Delete a container registry import policy

Official Snyk endpoint: DELETE /orgs/{org_id}/container_import/{integration_id}/policy

Delete a container registry import policy #### Required permissions - `Edit integrations (org.integration.edit)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integration_id` from the official Snyk API operation. Container Registry Integration ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/container_import/{integration_id}/policy';
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
