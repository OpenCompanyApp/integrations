<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a custom tenant role for a given tenant (Early Access).
 *
 * Maps to the official Snyk endpoint post /tenants/{tenant_id}/roles.
 */
class SnykCreateTenantRole extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_tenant_role';
    protected const DESCRIPTION = 'Create a custom tenant role for a given tenant (Early Access)

Official Snyk endpoint: POST /tenants/{tenant_id}/roles

Create a custom tenant role for a given tenant. #### Required permissions - `View Tenant Roles (tenant.roles.read)` - `Create Tenant Roles (tenant.roles.create)`';
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
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. Unique identifier of the tenant.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tenants/{tenant_id}/roles';
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
