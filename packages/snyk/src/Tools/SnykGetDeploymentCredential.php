<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get Deployment credential.
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/credentials/{credential_id}.
 */
class SnykGetDeploymentCredential extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_deployment_credential';
    protected const DESCRIPTION = 'Get Deployment credential

Official Snyk endpoint: GET /tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/credentials/{credential_id}

Get all Deployment credential data for an deployment #### Required permissions - `View Tenant Details (tenant.read)`';
    protected const PARAMETERS = array (
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. Tenant ID',
  ),
  'install_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `install_id` from the official Snyk API operation. Install ID',
  ),
  'deployment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deployment_id` from the official Snyk API operation. Deployment ID',
  ),
  'credential_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `credential_id` from the official Snyk API operation. Credential ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/credentials/{credential_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'install_id' => 'install_id',
  'deployment_id' => 'deployment_id',
  'credential_id' => 'credential_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'ending_before' => 'ending_before',
  'starting_after' => 'starting_after',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
