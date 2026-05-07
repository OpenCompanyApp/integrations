<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a single Tenant by ID.
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}.
 */
class SnykGetTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_tenant';
    protected const DESCRIPTION = 'Get a single Tenant by ID

Official Snyk endpoint: GET /tenants/{tenant_id}

Get the full details of a Tenant. #### Required permissions - `View Tenant Details (tenant.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. Unique identifier for tenant',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
