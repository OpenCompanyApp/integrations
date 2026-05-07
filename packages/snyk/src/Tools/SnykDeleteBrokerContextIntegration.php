<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Deletes the Broker context association with an Integration.
 *
 * Maps to the official Snyk endpoint delete /tenants/{tenant_id}/brokers/installs/{install_id}/contexts/{context_id}/integrations/{integration_id}.
 */
class SnykDeleteBrokerContextIntegration extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_broker_context_integration';
    protected const DESCRIPTION = 'Deletes the Broker context association with an Integration

Official Snyk endpoint: DELETE /tenants/{tenant_id}/brokers/installs/{install_id}/contexts/{context_id}/integrations/{integration_id}

Deletes an existing Broker context association for an integration #### Required permissions - `View Tenant Details (tenant.read)` - `Edit Tenant Details (tenant.edit)`';
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
  'context_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `context_id` from the official Snyk API operation. Context ID',
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integration_id` from the official Snyk API operation. Integration ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/tenants/{tenant_id}/brokers/installs/{install_id}/contexts/{context_id}/integrations/{integration_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'install_id' => 'install_id',
  'context_id' => 'context_id',
  'integration_id' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
