<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Deletes an Integration for a Broker connection.
 *
 * Maps to the official Snyk endpoint delete /tenants/{tenant_id}/brokers/connections/{connection_id}/orgs/{org_id}/integrations/{integration_id}.
 */
class SnykDeleteBrokerConnectionIntegration extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_broker_connection_integration';
    protected const DESCRIPTION = 'Deletes an Integration for a Broker connection

Official Snyk endpoint: DELETE /tenants/{tenant_id}/brokers/connections/{connection_id}/orgs/{org_id}/integrations/{integration_id}

Deletes an existing Broker connection for an deployment #### Required permissions - `View Tenant Details (tenant.read)`';
    protected const PARAMETERS = array (
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. Tenant ID',
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connection_id` from the official Snyk API operation. Connection ID',
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
    protected const PATH = '/tenants/{tenant_id}/brokers/connections/{connection_id}/orgs/{org_id}/integrations/{integration_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'connection_id' => 'connection_id',
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
