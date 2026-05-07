<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a dry run job for a container registry import policy.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/container_import/{integration_id}/policy/dry_run.
 */
class SnykCreateContainerRegistryImportPolicyDryRun extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_container_registry_import_policy_dry_run';
    protected const DESCRIPTION = 'Create a dry run job for a container registry import policy

Official Snyk endpoint: POST /orgs/{org_id}/container_import/{integration_id}/policy/dry_run

Creates an asynchronous dry run job to test a container registry import policy #### Required permissions - `Edit integrations (org.integration.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/container_import/{integration_id}/policy/dry_run';
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
