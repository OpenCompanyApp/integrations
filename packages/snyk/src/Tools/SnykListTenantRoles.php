<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List all available roles for a given tenant (Early Access).
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/roles.
 */
class SnykListTenantRoles extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_tenant_roles';
    protected const DESCRIPTION = 'List all available roles for a given tenant (Early Access)

Official Snyk endpoint: GET /tenants/{tenant_id}/roles

List all available roles for a given tenant. #### Required permissions - `View Tenant Roles (tenant.roles.read)`';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Snyk API operation. Role name filter.',
  ),
  'custom' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `custom` from the official Snyk API operation. Whether role is custom or not.',
  ),
  'assignable_by_me' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `assignable_by_me` from the official Snyk API operation. When true, only return roles that the current user can assign to others in the tenant.',
  ),
  'expand_permissions' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `expand_permissions` from the official Snyk API operation. option to show all permission types',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/roles';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'name' => 'name',
  'custom' => 'custom',
  'assignable_by_me' => 'assignable_by_me',
  'expand_permissions' => 'expand_permissions',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
