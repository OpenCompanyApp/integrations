<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Creates Broker connection Integration Configuration.
 *
 * Maps to the official Snyk endpoint post /tenants/{tenant_id}/brokers/connections/{connection_id}/orgs/{org_id}/integration.
 */
class SnykCreateBrokerConnectionIntegration extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_broker_connection_integration';
    protected const DESCRIPTION = 'Creates Broker connection Integration Configuration

Official Snyk endpoint: POST /tenants/{tenant_id}/brokers/connections/{connection_id}/orgs/{org_id}/integration

Configures integrations to use the Broker connection for an deployment #### Required permissions - `View Tenant Details (tenant.read)`';
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
    protected const PATH = '/tenants/{tenant_id}/brokers/connections/{connection_id}/orgs/{org_id}/integration';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'connection_id' => 'connection_id',
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
