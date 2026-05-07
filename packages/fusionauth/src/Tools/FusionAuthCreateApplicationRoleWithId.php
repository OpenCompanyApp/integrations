<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Application Role With Id.
 *
 * Maps to POST /api/application/{applicationId}/role/{roleId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateApplicationRoleWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_application_role_with_id',
  'class' => 'FusionAuthCreateApplicationRoleWithId',
  'method' => 'POST',
  'path' => '/api/application/{applicationId}/role/{roleId}',
  'operation_id' => 'createApplicationRoleWithId',
  'summary' => 'create Application Role With Id',
  'description' => 'Creates a new role for an application. You must specify the Id of the application you are creating the role for. You can optionally specify an Id for the role inside the ApplicationRole object itself, if not provided one will be generated.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application to create the role on.',
    ),
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the role. If not provided a secure random UUID will be generated.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
