<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Creates Broker Deployment.
 *
 * Maps to the official Snyk endpoint post /tenants/{tenant_id}/brokers/installs/{install_id}/deployments.
 */
class SnykCreateBrokerDeployment extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_broker_deployment';
    protected const DESCRIPTION = 'Creates Broker Deployment

Official Snyk endpoint: POST /tenants/{tenant_id}/brokers/installs/{install_id}/deployments

Creates a new Broker Deployment for an installation #### Required permissions - `View Tenant Details (tenant.read)` - `Edit Tenant Details (tenant.edit)`';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tenants/{tenant_id}/brokers/installs/{install_id}/deployments';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'install_id' => 'install_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
