<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Return a specific role by its id and its tenant id. (Early Access).
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/roles/{role_id}.
 */
class SnykGetTenantRole extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_tenant_role';
    protected const DESCRIPTION = 'Return a specific role by its id and its tenant id. (Early Access)

Official Snyk endpoint: GET /tenants/{tenant_id}/roles/{role_id}

Return a role from a tenant by the tenant and role id with its details and permissions. #### Required permissions - `View Tenant Roles (tenant.roles.read)`';
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
  'has_users_assigned' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `has_users_assigned` from the official Snyk API operation. returns current memberships of the role in the meta relationships section',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/roles/{role_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'role_id' => 'role_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'has_users_assigned' => 'has_users_assigned',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
