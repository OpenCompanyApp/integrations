<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Application Role With Id.
 *
 * Maps to DELETE /api/application/{applicationId}/role/{roleId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteApplicationRoleWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_application_role_with_id',
  'class' => 'FusionAuthDeleteApplicationRoleWithId',
  'method' => 'DELETE',
  'path' => '/api/application/{applicationId}/role/{roleId}',
  'operation_id' => 'deleteApplicationRoleWithId',
  'summary' => 'delete Application Role With Id',
  'description' => 'Hard deletes an application role. This is a dangerous operation and should not be used in most circumstances. This permanently removes the given role from all users that had it.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application that the role belongs to.',
    ),
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the role to delete.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
    'roleId' => 'role_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
