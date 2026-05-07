<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Application Role.
 *
 * Maps to POST /api/application/{applicationId}/role in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateApplicationRole extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_application_role',
  'class' => 'FusionAuthCreateApplicationRole',
  'method' => 'POST',
  'path' => '/api/application/{applicationId}/role',
  'operation_id' => 'createApplicationRole',
  'summary' => 'create Application Role',
  'description' => 'Creates a new role for an application. You must specify the Id of the application you are creating the role for. You can optionally specify an Id for the role inside the ApplicationRole object itself, if not provided one will be generated.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application to create the role on.',
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
