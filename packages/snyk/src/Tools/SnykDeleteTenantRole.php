<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a specific tenant role by its id and its tenant id. (Early Access).
 *
 * Maps to the official Snyk endpoint delete /tenants/{tenant_id}/roles/{role_id}.
 */
class SnykDeleteTenantRole extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_tenant_role';
    protected const DESCRIPTION = 'Delete a specific tenant role by its id and its tenant id. (Early Access)

Official Snyk endpoint: DELETE /tenants/{tenant_id}/roles/{role_id}

Delete a custom tenant role in a given tenant #### Required permissions - `View Tenant Roles (tenant.roles.read)` - `Delete Tenant Roles (tenant.roles.delete)`';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/tenants/{tenant_id}/roles/{role_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'role_id' => 'role_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
