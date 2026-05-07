<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update tenant.
 *
 * Maps to the official Snyk endpoint patch /tenants/{tenant_id}.
 */
class SnykUpdateTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_tenant';
    protected const DESCRIPTION = 'Update tenant

Official Snyk endpoint: PATCH /tenants/{tenant_id}

Update the details of a tenant #### Required permissions - `Edit Tenant Details (tenant.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
