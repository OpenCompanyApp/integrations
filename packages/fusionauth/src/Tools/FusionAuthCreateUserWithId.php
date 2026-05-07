<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User With Id.
 *
 * Maps to POST /api/user/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_with_id',
  'class' => 'FusionAuthCreateUserWithId',
  'method' => 'POST',
  'path' => '/api/user/{userId}',
  'operation_id' => 'createUserWithId',
  'summary' => 'create User With Id',
  'description' => 'Creates a user. You can optionally specify an Id for the user, if not provided one will be generated.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the user. If not provided a secure random UUID will be generated.',
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
    'userId' => 'user_id',
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
