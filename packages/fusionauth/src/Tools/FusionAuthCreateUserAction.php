<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Action.
 *
 * Maps to POST /api/user-action in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserAction extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_action',
  'class' => 'FusionAuthCreateUserAction',
  'method' => 'POST',
  'path' => '/api/user-action',
  'operation_id' => 'createUserAction',
  'summary' => 'create User Action',
  'description' => 'Creates a user action. This action cannot be taken on a user until this call successfully returns. Anytime after that the user action can be applied to any user.',
  'parameters' =>
  array (
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
