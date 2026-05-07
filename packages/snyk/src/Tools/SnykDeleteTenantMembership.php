<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete an individual tenant membership for a single user. (Early Access).
 *
 * Maps to the official Snyk endpoint delete /tenants/{tenant_id}/memberships/{membership_id}.
 */
class SnykDeleteTenantMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_tenant_membership';
    protected const DESCRIPTION = 'Delete an individual tenant membership for a single user. (Early Access)

Official Snyk endpoint: DELETE /tenants/{tenant_id}/memberships/{membership_id}

Delete an individual tenant membership for a single user. #### Required permissions - `View Tenant Memberships (tenant.membership.read)` - `Delete Tenant Memberships (tenant.membership.delete)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `membership_id` from the official Snyk API operation. Unique identifier of the tenant membership.',
  ),
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. Unique identifier of the tenant.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/tenants/{tenant_id}/memberships/{membership_id}';
    protected const PATH_PARAMS = array (
  'membership_id' => 'membership_id',
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
