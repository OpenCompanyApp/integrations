<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update a specific tenant role by its id and its tenant id. (Early Access).
 *
 * Maps to the official Snyk endpoint patch /tenants/{tenant_id}/roles/{role_id}.
 */
class SnykUpdateTenantRole extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_tenant_role';
    protected const DESCRIPTION = 'Update a specific tenant role by its id and its tenant id. (Early Access)

Official Snyk endpoint: PATCH /tenants/{tenant_id}/roles/{role_id}

Update attributes of a custom tenant role in a given tenant #### Required permissions - `View Tenant Roles (tenant.roles.read)` - `Edit Tenant Roles (tenant.roles.edit)`';
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
  'role_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `role_id` from the official Snyk API operation. Unique identifier of the role.',
  ),
  'force' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `force` from the official Snyk API operation. flag to force the update of a role, required if users are assigned to the role',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/tenants/{tenant_id}/roles/{role_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'role_id' => 'role_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'force' => 'force',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
