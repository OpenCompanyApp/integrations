<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Updates Broker Context.
 *
 * Maps to the official Snyk endpoint patch /tenants/{tenant_id}/brokers/installs/{install_id}/contexts/{context_id}.
 */
class SnykUpdateBrokerContext extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_broker_context';
    protected const DESCRIPTION = 'Updates Broker Context

Official Snyk endpoint: PATCH /tenants/{tenant_id}/brokers/installs/{install_id}/contexts/{context_id}

Updates a Broker Context for an deployment #### Required permissions - `View Tenant Details (tenant.read)` - `Edit Tenant Details (tenant.edit)`';
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
    protected const METHOD = 'patch';
    protected const PATH = '/tenants/{tenant_id}/brokers/installs/{install_id}/contexts/{context_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'install_id' => 'install_id',
  'context_id' => 'context_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
