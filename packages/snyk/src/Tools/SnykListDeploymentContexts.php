<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List Deployment contexts.
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/contexts.
 */
class SnykListDeploymentContexts extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_deployment_contexts';
    protected const DESCRIPTION = 'List Deployment contexts

Official Snyk endpoint: GET /tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/contexts

List Deployment contexts for a given deployment ID #### Required permissions - `View Tenant Details (tenant.read)`';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/contexts';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'install_id' => 'install_id',
  'deployment_id' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
  'ending_before' => 'ending_before',
  'starting_after' => 'starting_after',
  'limit' => 'limit',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
