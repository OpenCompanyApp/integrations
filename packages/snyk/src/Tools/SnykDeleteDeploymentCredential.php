<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Deletes Deployment credential.
 *
 * Maps to the official Snyk endpoint delete /tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/credentials/{credential_id}.
 */
class SnykDeleteDeploymentCredential extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_deployment_credential';
    protected const DESCRIPTION = 'Deletes Deployment credential

Official Snyk endpoint: DELETE /tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/credentials/{credential_id}

Deletes an existing Deployment credential for an deployment #### Required permissions - `View Tenant Details (tenant.read)` - `Edit Tenant Details (tenant.edit)`';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/tenants/{tenant_id}/brokers/installs/{install_id}/deployments/{deployment_id}/credentials/{credential_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'install_id' => 'install_id',
  'deployment_id' => 'deployment_id',
  'credential_id' => 'credential_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
