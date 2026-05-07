<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove organization JIT default role.
 *
 * Maps to DELETE /api/organizations/{id}/jit/roles/{organizationRoleId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationJitRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_jit_role',
  'class' => 'LogtoDeleteOrganizationJitRole',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}/jit/roles/{organizationRoleId}',
  'operation_id' => 'DeleteOrganizationJitRole',
  'summary' => 'Remove organization JIT default role',
  'description' => 'Remove an organization role that will be assigned to users during just-in-time provisioning.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'organization_role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'organizationRoleId' => 'organization_role_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
