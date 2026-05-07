<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update tenant membership (Early Access).
 *
 * Maps to the official Snyk endpoint patch /tenants/{tenant_id}/memberships/{membership_id}.
 */
class SnykUpdateTenantMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_tenant_membership';
    protected const DESCRIPTION = 'Update tenant membership (Early Access)

Official Snyk endpoint: PATCH /tenants/{tenant_id}/memberships/{membership_id}

Update the tenant membership with the new role #### Required permissions - `View Tenant Details (tenant.read)` - `View Tenant Memberships (tenant.membership.read)` - `Edit Tenant Memberships (tenant.membership.edit)`';
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
  'membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `membership_id` from the official Snyk API operation. Unique identifier of the tenant membership.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/tenants/{tenant_id}/memberships/{membership_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'membership_id' => 'membership_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
